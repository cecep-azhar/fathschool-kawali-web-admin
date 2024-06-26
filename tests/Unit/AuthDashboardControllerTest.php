<?php

use App\Models\Subject;
use App\Models\TeacherSubject;
use App\Models\User;
use App\Models\UserProfile;
use Database\Seeders\AssignmentSeeder;
use Database\Seeders\ClassRoutineSeeder;
use Database\Seeders\CourseSeeder;
use Database\Seeders\CurrencySeeder;
use Database\Seeders\EventSeeder;
use Database\Seeders\ExamSeeder;
use Database\Seeders\GradeSeeder;
use Database\Seeders\HolidaySeeder;
use Database\Seeders\LeaveSeeder;
use Database\Seeders\LeaveTypeSeeder;
use Database\Seeders\OnlineClassSeeder;
use Database\Seeders\PlanSeeder;
use Database\Seeders\StudentAttendanceSeeder;
use Database\Seeders\SubjectSeeder;
use Database\Seeders\TransactionSeeder;
use Database\Seeders\TransactionTypeSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Inertia\Testing\AssertableInertia;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

/**
 * AuthDashboardControllerTest is responsible for testing the authentication dashboard controller.
 */
class AuthDashboardControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Prepare for the test by setting up the role permission and acting as the user with the specified role.
     *
     * @param  string  $role The role of the user
     * @return void
     */
    private function prepareTest($role)
    {
        $this->rolePermission();
        $user = User::factory()->create([
            'role' => $role,
        ]);
        $this->actingAs($user);
    }

    public function test_accountant_dashboard()
    {
        $this->prepareTest('Accountant');

        // Seed the necessary data for testing the dashboard.
        $this->seed([
            TransactionTypeSeeder::class,
            TransactionSeeder::class,
        ]);

        // Make a GET request to the dashboard route.
        $response = $this->get(route('dashboard'));
        $response->assertStatus(200);

        // Assert specific data using Inertia.
        $response->assertInertia(function (AssertableInertia $page) {
            $page->component('Accountant/Dashboard')
                ->tap(function ($page) {
                    $page->has('week_data_label_income.0');  // Check if the 'week_data_label_income' data is present.
                    $page->has('week_data_value_income.0');  // Check if the 'week_data_value_income' data is present.
                    $page->has('week_data_value_expense.0');  // Check if the 'week_data_value_expense' data is present.
                    $page->has('pie_data.0');  // Check if the 'pie_data' data is present.
                    $page->has('total_transaction_amount');  // Check if the 'total_transaction_amount' data is present.
                    $page->has('total_paid_amount');  // Check if the 'total_paid_amount' data is present.
                    $page->has('five_transactions.0');  // Check if the 'five_transactions' data is present.
                    $page->has('five_chart_transactions.0');  // Check if the 'five_chart_transactions' data is present.
                    $page->missing('query.0');  // Check if the 'query' data is missing.
                    $page->missing('two_events.0');  // Check if the 'two_events' data is missing.
                });
        });
    }

    public function test_teacher_dashboard()
    {
        $this->prepareTest('Teacher');

        // Seed the necessary data for testing the dashboard.
        $this->seed([
            CourseSeeder::class,
            SubjectSeeder::class,
            LeaveTypeSeeder::class,
            LeaveSeeder::class,
            EventSeeder::class,
            ClassRoutineSeeder::class,
        ]);

        // Create TeacherSubject entries for each subject.
        $subjects = Subject::all();
        foreach ($subjects as $subject) {
            TeacherSubject::create([
                'teacher_id' => 1,
                'subject_id' => $subject->id,
            ]);
        }

        // Make a GET request to the dashboard route.
        $response = $this->get(route('dashboard'));
        $response->assertStatus(200);

        // Assert specific data using Inertia.
        $response->assertInertia(function (AssertableInertia $page) {
            $page->component('Teacher/Dashboard')
                ->tap(function ($page) {
                    $page->has('total_subjects');  // Check if the 'total_subjects' data is present.
                    $page->has('total_leaves');  // Check if the 'total_leaves' data is present.
                    $page->has('total_accepted_leaves');  // Check if the 'total_accepted_leaves' data is present.
                    $page->has('total_rejected_leaves');  // Check if the 'total_rejected_leaves' data is present.
                    $page->has('total_assignments');  // Check if the 'total_assignments' data is present.
                    $page->has('today_events');  // Check if the 'today_events' data is present.
                    $page->has('total_assignments');  // Check if the 'total_assignments' data is present.
                    $page->has('pending_assignments');  // Check if the 'pending_assignments' data is present.
                    $page->has('schedules');  // Check if the 'schedules' data is present.
                });
        });
    }

    public function test_student_dashboard()
    {
        $this->prepareTest('Student');

        // Create a teacher user.
        User::factory()->create([
            'role' => 'Teacher',
        ]);

        // Seed the necessary data for testing the dashboard.
        $this->seed([
            CourseSeeder::class,
            SubjectSeeder::class,
            UserCourseSeeder::class,
            EventSeeder::class,
            OnlineClassSeeder::class,
            TransactionTypeSeeder::class,
            TransactionSeeder::class,
            AssignmentSeeder::class,
            StudentAttendanceSeeder::class,
        ]);

        // Create TeacherSubject entries for each subject.
        $subjects = Subject::all();
        foreach ($subjects as $subject) {
            TeacherSubject::create([
                'teacher_id' => 1,
                'subject_id' => $subject->id,
            ]);
        }

        // Make a GET request to the dashboard route.
        $response = $this->get(route('dashboard'));
        $response->assertStatus(200);

        // Assert specific data using Inertia.
        $response->assertInertia(function (AssertableInertia $page) {
            $page->component('Student/Dashboard')
                ->tap(function ($page) {
                    $page->has('user_courses_name.0');  // Check if the 'user_courses_name' data is present.
                    $page->has('total_students');  // Check if the 'total_students' data is present.
                    $page->has('upcoming_events.0');  // Check if the 'upcoming_events' data is present.
                    $page->has('upcoming_classes');  // Check if the 'upcoming_classes' data is present.
                    $page->has('pending_assignments');  // Check if the 'pending_assignments' data is present.
                    $page->has('pending_fees');  // Check if the 'pending_fees' data is present.
                    $page->has('today_classes');  // Check if the 'today_classes' data is present.
                    $page->has('next_assignments.0');  // Check if the 'next_assignments' data is present.
                });
        });
    }

    public function test_parent_dashboard()
    {
        $this->prepareTest('Parent');

        // Create a student user.
        User::factory()->create([
            'role' => 'Student',
        ]);

        // Get the user and parent model instances.
        $user = User::find(2);
        $parent = User::find(1);

        // Attach the parent to the student.
        $user->parents()->attach($parent);

        // Seed the necessary data for testing the dashboard.
        $this->seed([
            CourseSeeder::class,
            SubjectSeeder::class,
            UserCourseSeeder::class,
            TransactionTypeSeeder::class,
            TransactionSeeder::class,
        ]);

        // Create TeacherSubject entries for each subject.
        $subjects = Subject::all();
        foreach ($subjects as $subject) {
            TeacherSubject::create([
                'teacher_id' => 1,
                'subject_id' => $subject->id,
            ]);
        }

        // Make a GET request to the dashboard route.
        $response = $this->get(route('dashboard'));
        $response->assertStatus(200);

        // Assert specific data using Inertia.
        $response->assertInertia(function (AssertableInertia $page) {
            $page->component('Parent/Dashboard')
                ->tap(function ($page) {
                    $page->has('all_childrens');  // Check if the 'all_childrens' data is present.
                    $page->has('unpaid_invoices');  // Check if the 'unpaid_invoices' data is present.
                });
        });
    }

    public function test_kid_dashboard()
    {
        $this->prepareTest('Parent');

        // Create a student user.
        User::factory()->create([
            'role' => 'Student',
        ]);

        // Seed the necessary data for testing the dashboard.
        $this->seed([
            CourseSeeder::class,
            SubjectSeeder::class,
            CurrencySeeder::class,
            PlanSeeder::class,
        ]);

        // Create a UserProfile entry for the student user.
        $data = [
            'user_id' => 2,
            'student_id' => 'STU001',
            'roll_no' => 'R001',
            'session' => '2023-2024',
            'plan_id' => '3',
            'note' => 'This is a sample note for user 2',
            'blood_group' => 'O+',
            'physical_disability' => 'None',
            'previous_school_name' => 'ABC High School',
            'previous_school_year_of_exist' => '2010-2021',
            'national_identification_number' => '1234567890',
            'bank_name' => 'XYZ Bank',
            'bank_account_number' => '9876543210',
            'highest_degree_name' => 'Bachelor of Science',
            'institute_name' => 'XYZ University',
            'passing_year' => '2022',
            'religion' => 'Hindu',
            'nationality' => 'Indian',
        ];

        UserProfile::create($data);

        // Get the user and parent model instances.
        $user = User::find(2);
        $parent = User::find(1);

        // Attach the parent to the student.
        $user->parents()->attach($parent);

        // Seed the necessary data for testing the dashboard.
        $this->seed([
            UserCourseSeeder::class,
            TransactionTypeSeeder::class,
            TransactionSeeder::class,
        ]);

        // Create TeacherSubject entries for each subject.
        $subjects = Subject::all();
        foreach ($subjects as $subject) {
            TeacherSubject::create([
                'teacher_id' => 1,
                'subject_id' => $subject->id,
            ]);
        }

        // Make a GET request to the dashboard route.
        $response = $this->get(route('dashboard'));
        $response->assertStatus(200);

        // Assert specific data using Inertia.
        $response->assertInertia(function (AssertableInertia $page) {
            $page->component('Parent/Dashboard')
                ->tap(function ($page) {
                    // Check if the 'all_childrens' data is present.
                    $page->has('all_childrens');

                    // Check if the 'unpaid_invoices' data is present.
                    $page->has('unpaid_invoices');
                });
        });
    }

    public function test_event_index_page_for_student()
    {
        $this->prepareTest('Student');

        // Seed events for testing.
        $this->seed(EventSeeder::class);

        // Make a GET request to the event index route.
        $response = $this->get(route('event.index'));
        $response->assertStatus(200);

        // Assert specific data using Inertia.
        $response->assertInertia(function (AssertableInertia $page) {
            $page->component('Admin/Event/Index')
                ->tap(function ($page) {
                    // Check if the first event is present in the 'all_events' data.
                    $page->has('all_events.data.0');

                    // Check if the eighth event is missing from the 'all_events' data.
                    $page->missing('all_events.data.8');
                });
        });
    }

    public function test_event_index_page_for_teacher()
    {
        $this->prepareTest('Teacher');

        // Seed events for testing.
        $this->seed(EventSeeder::class);

        // Make a GET request to the event index route.
        $response = $this->get(route('event.index'));
        $response->assertStatus(200);

        // Assert specific data using Inertia.
        $response->assertInertia(function (AssertableInertia $page) {
            $page->component('Admin/Event/Index')
                ->tap(function ($page) {
                    // Check if the first event is present in the 'all_events' data.
                    $page->has('all_events.data.0');

                    // Check if the eighth event is missing from the 'all_events' data.
                    $page->missing('all_events.data.8');
                });
        });
    }

    /**
     * Set up the role permissions.
     *
     * @return void
     */
    public function rolePermission()
    {
        $roleAdmin = Role::create([
            'name' => 'Admin',
            'description' => 'This is Admin',
        ]);

        $roleAccountant = Role::create([
            'name' => 'Accountant',
            'description' => 'This is Accountant',
        ]);

        $roleTeacher = Role::create([
            'name' => 'Teacher',
            'description' => 'This is Teacher',
        ]);

        $roleStudent = Role::create([
            'name' => 'Student',
            'description' => 'This is Student',
        ]);

        $roleParent = Role::create([
            'name' => 'Parent',
            'description' => 'This is Parent',
        ]);

        $permissions = [
            [
                'group_name' => 'event',
                'permissions' => [
                    'event.index',
                ],
            ],
            [
                'group_name' => 'dashboard',
                'permissions' => [
                    'admin.dashboard',
                    'teacher.dashboard',
                    'accountant.dashboard',
                    'parent.dashboard',
                    'student.dashboard',
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

        $roleAdmin->givePermissionTo([
            'admin.dashboard',
        ]);
        $roleAccountant->givePermissionTo([
            'accountant.dashboard',
        ]);
        $roleTeacher->givePermissionTo([
            'event.index',
            'teacher.dashboard',
        ]);
        $roleStudent->givePermissionTo([
            'event.index',
            'student.dashboard',
        ]);
        $roleParent->givePermissionTo([
            'parent.dashboard',
        ]);
    }
}
