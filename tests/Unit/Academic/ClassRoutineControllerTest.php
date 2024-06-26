<?php

use App\Models\ClassRoutine;
use App\Models\Course;
use App\Models\Subject;
use App\Models\TeacherSubject;
use App\Models\User;
use App\Models\WorkingDays;
use Database\Seeders\ClassRoutineSeeder;
use Database\Seeders\CourseSeeder;
use Database\Seeders\SubjectSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Inertia\Testing\AssertableInertia;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class ClassRoutineControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_visit_class_routine_index_page()
    {
        // Set up role permissions
        $this->rolePermission();

        // Create a new Admin user
        $user = User::factory()->create([
            'role' => 'Admin',
        ]);

        // Create a new Teacher user
        User::factory()->create([
            'role' => 'Teacher',
        ]);

        // Authenticate the admin user
        $this->actingAs($user);

        // Create a new course
        Course::create(['name' => 'Programming']);

        // Create a new subject under the Programming course
        Subject::create(['name' => 'Python', 'course_id' => 1]);

        // Associate the teacher with the Python subject
        TeacherSubject::create([
            'teacher_id' => 1,
            'subject_id' => 1,
        ]);

        // Seed the database with class routines
        $this->seed(ClassRoutineSeeder::class);

        // Send a GET request to visit the class routine index page
        $response = $this->get(route('routine.index'));

        // Assert that the response has a status code of 200 (OK)
        $response->assertStatus(200);

        // Assert that the response contains expected inertia data
        $response->assertInertia(function (AssertableInertia $page) {
            $page->component('Admin/Routine/Index')
                ->tap(function ($page) {
                    $page->has('routines.data.0');  // Assert that there is at least one routine in the data
                    $page->has('schedules.0');  // Assert that there is at least one schedule in the data
                    $page->has('classes.0');  // Assert that there is at least one class in the data
                    $page->has('teachers.0');  // Assert that there is at least one teacher in the data
                    $page->missing('query.course_id');  // Assert that the query parameter 'course_id' is missing
                });
        });
    }

    public function test_admin_can_search_exam_routine()
    {
        // Set up role permissions
        $this->rolePermission();

        // Create a new Admin user
        $user = User::factory()->create([
            'role' => 'Admin',
        ]);

        // Create a new Teacher user
        User::factory()->create([
            'role' => 'Teacher',
        ]);

        // Authenticate the admin user
        $this->actingAs($user);

        // Create a new course
        Course::create(['name' => 'Programming']);

        // Create a new subject under the Programming course
        Subject::create(['name' => 'Python', 'course_id' => 1]);

        // Associate the teacher with the Python subject
        TeacherSubject::create([
            'teacher_id' => 1,
            'subject_id' => 1,
        ]);

        // Seed the database with class routines
        $this->seed(ClassRoutineSeeder::class);

        // Prepare the search query data
        $data = [
            'course_id' => '1',
            'subject_id' => '1',
            'teacher_id' => '2',
        ];

        // Build the query string
        $queryString = http_build_query($data);

        // Send a GET request to search for exam routines with the given query
        $response = $this->get('routine?' . $queryString);

        // Assert that the response has a status code of 200 (OK)
        $response->assertStatus(200);

        // Assert that the response contains expected inertia data
        $response->assertInertia(function (AssertableInertia $page) {
            $page->component('Admin/Routine/Index')
                ->tap(function ($page) {
                    $page->has('routines.data.0');  // Assert that there is at least one routine in the data
                    $page->has('query.course_id');  // Assert that the query parameter 'course_id' is present
                });
        });
    }

    public function test_admin_can_visit_class_routine_create_page()
    {
        // Set up role permissions
        $this->rolePermission();

        // Create a new Admin user
        $user = User::factory()->create([
            'role' => 'Admin',
        ]);

        // Authenticate the admin user
        $this->actingAs($user);

        // Seed the database with courses
        $this->seed(CourseSeeder::class);

        // Seed the database with subjects
        $this->seed(SubjectSeeder::class);

        // Create 10 Teacher users
        User::factory()->count(10)->create(['role' => 'Teacher']);

        // Create working days
        WorkingDays::create();

        // Send a GET request to visit the class routine create page
        $response = $this->get(route('routine.create'));

        // Assert that the response has a status code of 200 (OK)
        $response->assertStatus(200);

        // Assert that the response contains expected inertia data
        $response->assertInertia(function (AssertableInertia $page) {
            $page->component('Admin/Routine/Form')
                ->tap(function ($page) {
                    $page->has('teachers.0');  // Assert that there is at least one teacher in the data
                    $page->has('courses.0');  // Assert that there is at least one course in the data
                    $page->has('subjects.0');  // Assert that there is at least one subject in the data
                    $page->has('workdays.6');  // Assert that there is a working day for Saturday (6th index)
                });
        });
    }

    public function test_admin_can_store_class_routine()
    {
        // Set up role permissions
        $this->rolePermission();

        // Create a new Admin user
        $user = User::factory()->create([
            'role' => 'Admin',
        ]);

        // Authenticate the admin user
        $this->actingAs($user);

        // Seed the database with courses
        $this->seed(CourseSeeder::class);

        // Create a subject for the course
        Subject::create([
            'course_id' => 1,
            'name' => 'Math',
        ]);

        // Create 5 Teacher users
        User::factory()->count(5)->create(['role' => 'Teacher']);

        // Create working days
        WorkingDays::create();

        // Prepare the data for the request
        $data = [
            'teacher' => 2,
            'class' => 1,
            'subject' => 1,
            'start_time' => '12:00',
            'end_time' => '13:00',
            'weekday' => '1',
        ];

        // Send a POST request to store the class routine
        $response = $this->post(route('routine.store'), $data);

        // Assert that the response has a status code of 302 (redirect)
        $response->assertStatus(302);

        // Assert that the class routine has been stored in the database
        expect(ClassRoutine::count())->toBe(1);
    }

    public function test_admin_fails_to_create_class_routine_for_validation()
    {
        // Set up role permissions
        $this->rolePermission();

        // Create a new Admin user
        $user = User::factory()->create([
            'role' => 'Admin',
        ]);

        // Authenticate the admin user
        $this->actingAs($user);

        // Seed the database with courses
        $this->seed(CourseSeeder::class);

        // Create a subject for the course
        Subject::create([
            'course_id' => 1,
            'name' => 'Math',
        ]);

        // Create 5 Teacher users
        User::factory()->count(5)->create(['role' => 'Teacher']);

        // Create working days
        WorkingDays::create();

        // Prepare empty data for the request
        $data = [];

        // Send a POST request to store the class routine and assert validation errors
        $response = $this->post(route('routine.store'), $data)
            ->assertSessionHasErrors(['class', 'teacher', 'subject', 'weekday', 'start_time', 'end_time']);

        // Assert that the response has a status code of 302 (redirect)
        $response->assertStatus(302);

        // Assert that no class routine has been stored in the database
        expect(ClassRoutine::count())->toBe(0);
    }

    public function test_admin_can_update_class_routine()
    {
        // Set up role permissions
        $this->rolePermission();

        // Create a new Admin user
        $user = User::factory()->create([
            'role' => 'Admin',
        ]);

        // Authenticate the admin user
        $this->actingAs($user);

        // Seed the database with courses
        $this->seed(CourseSeeder::class);

        // Create a subject for the course
        Subject::create([
            'course_id' => 1,
            'name' => 'Math',
        ]);

        // Create 5 Teacher users
        User::factory()->count(5)->create(['role' => 'Teacher']);

        // Create working days
        WorkingDays::create();

        // Create a class routine
        ClassRoutine::create([
            'teacher_id' => 2,
            'course_id' => 1,
            'subject_id' => 1,
            'start_time' => '12:00',
            'end_time' => '13:1',
            'weekday' => '1',
        ]);

        // Prepare data for the update request
        $data = [
            'teacher' => 2,
            'class' => 1,
            'subject' => 1,
            'start_time' => '13:00',
            'end_time' => '14:00',
            'weekday' => '1',
        ];

        // Send a PUT request to update the class routine
        $response = $this->put(route('routine.update', 1), $data);

        // Assert that the response has a status code of 302 (redirect)
        $response->assertStatus(302);

        // Assert that the start_time of the updated class routine is '13:00'
        expect(ClassRoutine::first()->start_time)->toBe('13:00');
    }

    public function test_admin_fails_to_update_class_routine_for_validation()
    {
        // Set up role permissions
        $this->rolePermission();

        // Create a new Admin user
        $user = User::factory()->create([
            'role' => 'Admin',
        ]);

        // Authenticate the admin user
        $this->actingAs($user);

        // Seed the database with courses
        $this->seed(CourseSeeder::class);

        // Create a subject for the course
        Subject::create([
            'course_id' => 1,
            'name' => 'Math',
        ]);

        // Create 5 Teacher users
        User::factory()->count(5)->create(['role' => 'Teacher']);

        // Create working days
        WorkingDays::create();

        // Create a class routine
        ClassRoutine::create([
            'teacher_id' => 2,
            'course_id' => 1,
            'subject_id' => 1,
            'start_time' => '12:00',
            'end_time' => '13:00',
            'weekday' => '1',
        ]);

        // Prepare empty data for the update request
        $data = [];

        // Send a PUT request to update the class routine with empty data
        $response = $this->put(route('routine.update', 1), $data)
            ->assertSessionHasErrors(['class', 'teacher', 'subject', 'weekday', 'start_time', 'end_time']);

        // Assert that the response has a status code of 302 (redirect)
        $response->assertStatus(302);

        // Assert that the start_time of the class routine is still '12:00' (not updated)
        expect(ClassRoutine::first()->start_time)->toBe('12:00');
    }

    public function test_admin_can_delete_class_routine()
    {
        // Set up role permissions
        $this->rolePermission();

        // Create a new Admin user
        $user = User::factory()->create([
            'role' => 'Admin',
        ]);

        // Authenticate the admin user
        $this->actingAs($user);

        // Seed the database with courses
        $this->seed(CourseSeeder::class);

        // Create a subject for the course
        Subject::create([
            'course_id' => 1,
            'name' => 'Math',
        ]);

        // Create 5 Teacher users
        User::factory()->count(5)->create(['role' => 'Teacher']);

        // Create working days
        WorkingDays::create();

        // Create a class routine
        $routine = ClassRoutine::create([
            'teacher_id' => 2,
            'course_id' => 1,
            'subject_id' => 1,
            'start_time' => '12:00',
            'end_time' => '13:1',
            'weekday' => '1',
        ]);

        // Send a DELETE request to delete the class routine
        $response = $this->delete(route('routine.destroy', $routine));

        // Assert that the response has a status code of 302 (redirect)
        $response->assertStatus(302);

        // Assert that the count of ClassRoutine records is 0 (deleted)
        expect(ClassRoutine::count())->toBe(0);
    }

    public function rolePermission()
    {
        $roleSuperAdmin = Role::create([
            'name' => 'Admin',
            'description' => 'This is Admin',
        ]);
        $permissions = [
            [
                'group_name' => 'Academic Management',
                'permissions' => [
                    'academic.management',
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
        $roleSuperAdmin->givePermissionTo([
            'academic.management',
        ]);
    }
}
