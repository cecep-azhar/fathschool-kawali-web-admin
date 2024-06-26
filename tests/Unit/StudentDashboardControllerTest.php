<?php

use App\Mail\StudentMail;
use App\Models\Assignment;
use App\Models\Course;
use App\Models\Exam;
use App\Models\ExamResult;
use App\Models\OnlineClass;
use App\Models\Subject;
use App\Models\Transaction;
use App\Models\TransactionType;
use App\Models\User;
use App\Models\UserCourse;
use App\Notifications\NewAssignmentAvailableForReviewNotification;
use App\Services\Student\DashboardService;
use Database\Seeders\ClassRoutineSeeder;
use Database\Seeders\CourseSeeder;
use Database\Seeders\GradeSeeder;
use Database\Seeders\StudentAttendanceSeeder;
use Database\Seeders\SubjectSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;
use Inertia\Testing\AssertableInertia;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class StudentDashboardControllerTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    public function setUp(): void
    {
        parent::setUp();
        $this->rolePermission();
    }

    public function test_my_courses_index_page()
    {
        // Seed the necessary data
        $this->seed(CourseSeeder::class);
        $this->seed(SubjectSeeder::class);

        // Create a student user and authenticate
        $user = User::factory()->create([
            'role' => 'Student',
        ]);
        $this->actingAs($user);

        // Create user courses for the student
        UserCourse::create([
            'user_id' => $user->id,
            'course_id' => 1,
            'is_passed' => 0,
        ]);
        UserCourse::create([
            'user_id' => $user->id,
            'course_id' => 2,
            'is_passed' => 0,
        ]);

        // Send a GET request to the "My Courses" index page and assert for success
        $response = $this->get(route('my.courses'));
        $response->assertStatus(200);

        // Assert that the Inertia component used in the response is 'Student/MyCourses'
        // and check if the courses are present
        $response->assertInertia(function (AssertableInertia $page) {
            $page->component('Student/MyCourses')
                ->tap(function ($page) {
                    $page->has('courses.1');
                });
        });
    }

    public function test_my_assignment_index_page()
    {
        // Create student and teacher users
        $studentUser = User::factory()->create([
            'role' => 'Student',
        ]);
        $teacherUser = User::factory()->create([
            'role' => 'Teacher',
        ]);

        // Authenticate the student user
        $this->actingAs($studentUser);

        // Seed the necessary data
        $this->seed(CourseSeeder::class);
        $this->seed(SubjectSeeder::class);

        // Create assignments for the teacher user
        Assignment::factory()->count(20)->create([
            'user_id' => $teacherUser->id,
            'subject_id' => Subject::inRandomOrder()->value('id'),
            'course_id' => Course::inRandomOrder()->value('id'),
        ]);

        // Mock the DashboardService and define its behavior
        $dashboardService = $this->mock(DashboardService::class);
        $dashboardService->shouldReceive('assignmentList')
            ->once()
            ->andReturn([]);

        // Send a GET request to the assignment list page and assert for success
        $response = $this->get(route('assignment.list'));
        $response->assertStatus(200);

        // Assert that the Inertia component used in the response is 'Student/Assignment'
        $response->assertInertia(function (AssertableInertia $page) {
            $page->component('Student/Assignment');
        });
    }

    public function test_my_assignment_submit()
    {
        // Create student and teacher users
        $studentUser = User::factory()->create([
            'role' => 'Student',
        ]);
        $teacherUser = User::factory()->create([
            'role' => 'Teacher',
        ]);

        // Authenticate the student user
        $this->actingAs($studentUser);

        // Seed the necessary data
        $this->seed(CourseSeeder::class);
        $this->seed(SubjectSeeder::class);

        // Create assignments for the teacher user
        Assignment::factory()->count(20)->create([
            'user_id' => $teacherUser->id,
            'subject_id' => Subject::inRandomOrder()->value('id'),
            'course_id' => Course::inRandomOrder()->value('id'),
        ]);

        // Prepare the data for assignment submission
        $data = [
            'assignment' => '1',
            'description' => 'description of my submission',
            'file' => UploadedFile::fake()->create('fake.jpg', 1024),
        ];

        // Mock the Notification facade
        Notification::fake();

        // Send a POST request to submit the assignment and assert for success
        $response = $this->post(route('assignment.submit'), $data);
        $response->assertStatus(302);

        // Assert that the submitted assignment is stored in the database
        $this->assertDatabaseHas('submitted_assignments', [
            'student_id' => $studentUser->id,
            'assignment_id' => $data['assignment'],
            'description' => $data['description'],
        ]);

        // Assert that the notification is sent to the teacher user
        Notification::assertSentTo(
            User::where('role', 'Teacher')->first(),
            NewAssignmentAvailableForReviewNotification::class
        );
    }

    public function test_assignment_submit_file_validation()
    {
        // Create a student user and authenticate
        $user = User::factory()->create([
            'role' => 'Student',
        ]);
        $this->actingAs($user);

        // Prepare the data without the 'file' field
        $data = [
            'assignment' => '1',
            'description' => 'description of my submission',
        ];

        // Send a POST request to submit the assignment and assert for file validation error
        $response = $this->post(route('assignment.submit'), $data);
        $response->assertSessionHasErrors(['file']);

        // Assert that no assignments are stored in the database
        expect(Assignment::count())->toBe(0);
    }

    public function test_assignment_submit_wrong_extension_file_validation()
    {
        // Create a student user and authenticate
        $user = User::factory()->create([
            'role' => 'Student',
        ]);
        $this->actingAs($user);

        // Prepare the data with a file that has the wrong extension ('txt')
        $data = [
            'assignment' => '1',
            'description' => 'description of my submission',
            'file' => UploadedFile::fake()->create('fake.txt', 1024),
        ];

        // Send a POST request to submit the assignment and assert for file validation error
        $response = $this->post(route('assignment.submit'), $data);
        $response->assertSessionHasErrors(['file']);

        // Assert that no assignments are stored in the database
        expect(Assignment::count())->toBe(0);
    }

    public function test_student_online_class_page()
    {
        // Create a student and teacher user
        $studentUser = User::factory()->create([
            'role' => 'Student',
        ]);
        User::factory()->create([
            'role' => 'Teacher',
        ]);

        // Authenticate the student user
        $this->actingAs($studentUser);

        // Seed the necessary data
        $this->seed(CourseSeeder::class);
        $this->seed(SubjectSeeder::class);

        // Create a user-course relationship for the student
        UserCourse::create(['user_id' => $studentUser->id, 'course_id' => 1]);

        // Create online classes for the course
        OnlineClass::factory()->count(10)->create(['course_id' => 1]);

        // Mock the DashboardService to return an empty array for online classes
        $this->mock(DashboardService::class, function ($mock) {
            $mock->shouldReceive('onlineClasses')
                ->once()->andReturn([]);
        });

        // Send a GET request to the online classes page and assert for success
        $response = $this->get(route('online.classes'));
        $response->assertStatus(200);

        // Assert that the response has the expected Inertia component
        $response->assertInertia(function (AssertableInertia $page) {
            $page->component('Student/OnlineClass');
        });
    }

    public function test_student_attendance_page()
    {
        // Create a student and teacher user
        $studentUser = User::factory()->create([
            'role' => 'Student',
        ]);
        User::factory()->create([
            'role' => 'Teacher',
        ]);

        // Authenticate the student user
        $this->actingAs($studentUser);

        // Seed the necessary data
        $this->seed(CourseSeeder::class);
        $this->seed(SubjectSeeder::class);
        $this->seed(StudentAttendanceSeeder::class);

        // Mock the DashboardService to return an empty array for attendances
        $this->mock(DashboardService::class, function ($mock) {
            $mock->shouldReceive('attendances')
                ->once()->andReturn([]);
        });

        // Send a GET request to the attendance page and assert for success
        $response = $this->get(route('my.attendance'));
        $response->assertStatus(200);

        // Assert that the response has the expected Inertia component
        $response->assertInertia(function (AssertableInertia $page) {
            $page->component('Student/Attendance');
        });
    }

    public function test_student_class_routine_page()
    {
        // Create a student and teacher user
        $studentUser = User::factory()->create([
            'role' => 'Student',
        ]);
        User::factory()->create([
            'role' => 'Teacher',
        ]);

        // Authenticate the student user
        $this->actingAs($studentUser);

        // Seed the necessary data
        $this->seed(CourseSeeder::class);
        $this->seed(SubjectSeeder::class);
        $this->seed(ClassRoutineSeeder::class);

        // Create a user-course relationship for the student
        UserCourse::create(['user_id' => $studentUser->id, 'course_id' => 1]);

        // Send a GET request to the class routine page and assert for success
        $response = $this->get(route('class.routine'));
        $response->assertStatus(200);

        // Assert that the response has the expected Inertia component
        $response->assertInertia(function (AssertableInertia $page) {
            $page->component('Student/ClassRoutine');
        });
    }

    public function test_student_result_page()
    {
        // Create a student user
        $studentUser = User::factory()->create([
            'role' => 'Student',
        ]);

        // Authenticate the student user
        $this->actingAs($studentUser);

        // Seed the necessary data
        $this->seed(CourseSeeder::class);
        $this->seed(GradeSeeder::class);
        Exam::factory()->create(['course_id' => 1]);
        UserCourse::create(['user_id' => $studentUser->id, 'course_id' => 1]);
        ExamResult::create(['exam_id' => 1, 'attachment' => 'files/result.xlsx']);

        // Send a GET request to the result page and assert for success
        $response = $this->get(route('result.index'));
        $response->assertStatus(200);

        // Assert that the response has the expected Inertia component
        $response->assertInertia(function (AssertableInertia $page) {
            $page->component('Student/Results')
                ->tap(function ($component) {
                    $component->has('results.0');
                });
        });
    }

    // public function test_student_mail()
    // {

    //     $user = User::factory()->create([
    //         'role' => 'Student',
    //     ]);
    //     $this->actingAs($user);

    //     Mail::fake();

    //     $data = [
    //         'subject' => 'Test Subject',
    //         'description' => 'Test Description',
    //         'email' => 'sahaapo@gmail.com',
    //     ];

    //     $response = $this->post(route('student.send.mail'), $data);

    //     $response->assertStatus(302);

    //     Mail::assertSent(StudentMail::class, function ($mail) use ($data) {
    //         return $mail->subject === $data['subject'] && $mail->hasTo($data['email']);
    //     });
    // }

    public function rolePermission()
    {
        $roleStudent = Role::create([
            'name' => 'Student',
            'description' => 'This is Admin Student',
        ]);

        $roleParent = Role::create([
            'name' => 'Parent',
            'description' => 'This is parent',
        ]);

        //  permission List as array
        $permissions = [
            [
                'group_name' => 'Exam Result',
                'permissions' => [
                    'exam-result.index',
                ],
            ],
            [
                'group_name' => 'attendance',
                'permissions' => [
                    'attendance.index',

                ],
            ],
            [
                'group_name' => 'assignment',
                'permissions' => [
                    'assignment.index',
                ],
            ],
            [
                'group_name' => 'transaction',
                'permissions' => [
                    'transaction.index',

                ],
            ],

        ];

        for ($i = 0; $i < count($permissions); $i++) {
            $permissionGroup = $permissions[$i]['group_name'];

            for ($j = 0; $j < count($permissions[$i]['permissions']); $j++) {
                // Create Permission
                Permission::create([
                    'name' => $permissions[$i]['permissions'][$j],
                    'group_name' => $permissionGroup,
                ]);
            }
        }

        $roleStudent->givePermissionTo([
            'transaction.index',
            'attendance.index',
            'exam-result.index',
            'assignment.index',
        ]);

        $roleParent->givePermissionTo([
            'transaction.index',
            'attendance.index',
            'exam-result.index',
            'assignment.index',
        ]);
    }
}
