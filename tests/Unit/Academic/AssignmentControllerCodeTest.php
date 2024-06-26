<?php

use App\Models\Assignment;
use App\Models\Subject;
use App\Models\TeacherSubject;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Inertia\Testing\AssertableInertia;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class AssignmentControllerCodeTest extends TestCase
{
    use RefreshDatabase;

    public function test_teacher_can_view_assignment_index_page()
    {
        // Set up role permissions
        $this->rolePermission();

        // Create a new Teacher user
        $user = User::factory()->create([
            'role' => 'Teacher',
        ]);

        // Authenticate the user
        $this->actingAs($user);

        // Seed the database with courses
        $this->seed([CourseSeeder::class]);

        // Create a new subject under the Math course
        Subject::create(['course_id' => 1, 'Name' => 'Math']);

        // Associate the teacher with the Math subject
        TeacherSubject::create(['teacher_id' => 1, 'subject_id' => 1]);

        // Create 20 assignments for the Math subject and course
        Assignment::factory()->count(20)->create(['subject_id' => 1, 'course_id' => 1]);

        // Send a GET request to the assignment index route
        $response = $this->get(route('assignment.index'));

        // Assert that the response has a status code of 200 (successful)
        $response->assertStatus(200);

        // Assert that the response is an Inertia response with specific page components and data
        $response->assertInertia(function (AssertableInertia $page) {
            // Assert the page component
            $page->component('Teacher/Assignment/Index')

            // Assert that the page has 'classes.0', indicating at least one class is present
                ->tap(function ($page) {
                    $page->has('classes.0');
                })

            // Assert that the page is missing 'classes.1', indicating only one class is present
                ->tap(function ($page) {
                    $page->missing('classes.1');
                })

            // Assert that the page has at least one ongoing assignment in 'assignments.data.Ongoing Assignment'
                ->tap(function ($page) {
                    $page->has('assignments.data.Ongoing Assignment.0');
                })

            // Assert that the page has at least one completed assignment in 'assignments.data.Completed Assignment'
                ->tap(function ($page) {
                    $page->has('assignments.data.Completed Assignment.0');
                })

            // Assert that the page has 'subjects.0', indicating at least one subject is present
                ->tap(function ($page) {
                    $page->has('subjects.0');
                })

            // Assert that the page is missing 'subjects.1', indicating only one subject is present
                ->tap(function ($page) {
                    $page->missing('subjects.1');
                })

            // Assert that the page has 'request_data', which likely contains additional request-related data
                ->tap(function ($page) {
                    $page->has('request_data');
                });
        });
    }

    public function test_teacher_can_search_assignments()
    {
        // Set up role permissions
        $this->rolePermission();

        // Create a new Teacher user
        $user = User::factory()->create([
            'role' => 'Teacher',
        ]);

        // Authenticate the user
        $this->actingAs($user);

        // Seed the database with courses
        $this->seed([CourseSeeder::class]);

        // Create a new subject under the Math course
        Subject::create(['course_id' => 1, 'Name' => 'Math']);

        // Associate the teacher with the Math subject
        TeacherSubject::create(['teacher_id' => 1, 'subject_id' => 1]);

        // Create 20 assignments for the Math subject and course
        Assignment::factory()->count(20)->create(['subject_id' => 1, 'course_id' => 1]);

        // Define search parameters
        $data = [
            'keyword' => null,
            'status' => 'Due',
            'subject_id' => '1',
        ];

        // Build the query string
        $queryString = http_build_query($data);

        // Send a GET request to the assignment search route with the query string
        $response = $this->get('assignment?'.$queryString);

        // Assert that the response has a status code of 200 (successful)
        $response->assertStatus(200);

        // Assert that the response is an Inertia response with specific page components and data
        $response->assertInertia(function (AssertableInertia $page) {
            // Assert the page component
            $page->component('Teacher/Assignment/Index')

            // Assert that the page has 'classes.0', indicating at least one class is present
                ->tap(function ($page) {
                    $page->has('classes.0');
                })

            // Assert that the page is missing 'classes.1', indicating only one class is present
                ->tap(function ($page) {
                    $page->missing('classes.1');
                })

            // Assert that the page has at least one ongoing assignment in 'assignments.data.Ongoing Assignment'
                ->tap(function ($page) {
                    $page->has('assignments.data.Ongoing Assignment.0');
                })

            // Assert that the page is missing completed assignments in 'assignments.data.Completed Assignment'
                ->tap(function ($page) {
                    $page->missing('assignments.data.Completed Assignment.0');
                })

            // Assert that the page has 'subjects.0', indicating at least one subject is present
                ->tap(function ($page) {
                    $page->has('subjects.0');
                })

            // Assert that the page is missing 'subjects.1', indicating only one subject is present
                ->tap(function ($page) {
                    $page->missing('subjects.1');
                })

            // Assert that the page has 'request_data', which likely contains additional request-related data
                ->tap(function ($page) {
                    $page->has('request_data');
                });
        });
    }

    public function test_teacher_can_generate_new_assignment()
    {
        // Set up role permissions
        $this->rolePermission();

        // Create a new Teacher user
        $user = User::factory()->create([
            'role' => 'Teacher',
        ]);

        // Authenticate the user
        $this->actingAs($user);

        // Seed the database with courses
        $this->seed([CourseSeeder::class]);

        // Create a new subject under the Math course
        Subject::create(['course_id' => 1, 'Name' => 'Math']);

        // Associate the teacher with the Math subject
        TeacherSubject::create(['teacher_id' => 1, 'subject_id' => 1]);

        // Define assignment data
        $data = [
            'teacher' => 1,
            'subject' => 1,
            'class' => 1,
            'title' => 'Lomeyo',
            'date' => ['12-12-2025', '01-01-2026'],
            'date2' => ['12-12-2025', '01-01-2026'],
            'mark' => '100',
            'description' => 'Good Description',
        ];

        // Send a POST request to the assignment store route with the assignment data
        $response = $this->post(route('assignment.store'), $data);

        // Assert that the response has a status code of 302 (redirect)
        $response->assertStatus(302);

        // Assert that there is one Assignment record created in the database
        expect(Assignment::count())->toBe(1);
    }

    public function test_teacher_will_fail_to_generate_new_assignment_for_validation()
    {
        // Set up role permissions
        $this->rolePermission();

        // Create a new Teacher user
        $user = User::factory()->create([
            'role' => 'Teacher',
        ]);

        // Authenticate the user
        $this->actingAs($user);

        // Seed the database with courses
        $this->seed([CourseSeeder::class]);

        // Create a new subject under the Math course
        Subject::create(['course_id' => 1, 'Name' => 'Math']);

        // Associate the teacher with the Math subject
        TeacherSubject::create(['teacher_id' => 1, 'subject_id' => 1]);

        // Define assignment data with missing required fields and invalid values
        $data = [
            'teacher' => 1,
            'subject' => '',
            'class' => '',
            'title' => '',
            'date' => '',
            'date2' => '',
            'mark' => '',
            'description' => 'Good Description',
        ];

        // Send a POST request to the assignment store route with the invalid assignment data
        $response = $this->post(route('assignment.store'), $data)
            ->assertSessionHasErrors(['title', 'subject', 'class', 'date', 'mark']);

        // Assert that the response has a status code of 302 (redirect)
        $response->assertStatus(302);

        // Assert that no Assignment records are created in the database
        expect(Assignment::count())->toBe(0);
    }

    public function test_teacher_can_update_assignment_data()
    {
        // Set up role permissions
        $this->rolePermission();

        // Create a new Teacher user
        $user = User::factory()->create([
            'role' => 'Teacher',
        ]);

        // Authenticate the user
        $this->actingAs($user);

        // Seed the database with courses
        $this->seed([CourseSeeder::class]);

        // Create a new subject under the Math course
        Subject::create(['course_id' => 1, 'Name' => 'Math']);

        // Associate the teacher with the Math subject
        TeacherSubject::create(['teacher_id' => 1, 'subject_id' => 1]);

        // Create an assignment for the Math subject and course
        Assignment::factory()->create(['subject_id' => 1, 'course_id' => 1]);

        // Define updated assignment data
        $data = [
            'teacher' => 1,
            'subject' => 1,
            'class' => 1,
            'title' => 'Lomeyo',
            'date' => ['12-12-2025', '01-01-2026'],
            'date2' => ['12-12-2025', '01-01-2026'],
            'mark' => '100',
            'description' => 'Good Description',
        ];

        // Send a PUT request to update the assignment with ID 1
        $response = $this->put(route('assignment.update', 1), $data);

        // Assert that the response has a status code of 302 (redirect)
        $response->assertStatus(302);

        // Assert that the updated assignment data is stored in the database
        $this->assertDatabaseHas('assignments', [
            'title' => 'Lomeyo',
        ]);
    }

    public function test_teacher_will_fail_to_update_assignment_data_for_validation()
    {
        // Set up role permissions
        $this->rolePermission();

        // Create a new Teacher user
        $user = User::factory()->create([
            'role' => 'Teacher',
        ]);

        // Authenticate the user
        $this->actingAs($user);

        // Seed the database with courses
        $this->seed([CourseSeeder::class]);

        // Create a new subject under the Math course
        Subject::create(['course_id' => 1, 'Name' => 'Math']);

        // Associate the teacher with the Math subject
        TeacherSubject::create(['teacher_id' => 1, 'subject_id' => 1]);

        // Create an assignment for the Math subject and course
        Assignment::factory()->create(['subject_id' => 1, 'course_id' => 1]);

        // Define updated assignment data with missing required fields and invalid values
        $data = [
            'teacher' => 1,
            'subject' => '',
            'class' => '',
            'title' => '',
            'date' => '',
            'date2' => '',
            'mark' => '',
            'description' => 'Good Description',
        ];

        // Send a PUT request to update the assignment with ID 1 using the invalid assignment data
        $response = $this->put(route('assignment.update', 1), $data)
            ->assertSessionHasErrors(['title', 'subject', 'class', 'date', 'mark']);

        // Assert that the response has a status code of 302 (redirect)
        $response->assertStatus(302);

        // Assert that the updated assignment data is not stored in the database
        $this->assertDatabaseMissing('assignments', [
            'description' => 'Good Description',
        ]);
    }

    public function test_teacher_can_delete_assignment()
    {
        // Set up role permissions
        $this->rolePermission();

        // Create a new Teacher user
        $user = User::factory()->create([
            'role' => 'Teacher',
        ]);

        // Authenticate the user
        $this->actingAs($user);

        // Seed the database with courses
        $this->seed([CourseSeeder::class]);

        // Create a new subject under the Math course
        Subject::create(['course_id' => 1, 'Name' => 'Math']);

        // Associate the teacher with the Math subject
        TeacherSubject::create(['teacher_id' => 1, 'subject_id' => 1]);

        // Create an assignment for the Math subject and course
        Assignment::factory()->create(['subject_id' => 1, 'course_id' => 1]);

        // Send a DELETE request to delete the assignment with ID 1
        $response = $this->delete(route('assignment.destroy', 1));

        // Assert that the response has a status code of 302 (redirect)
        $response->assertStatus(302);

        // Assert that no Assignment records exist in the database
        expect(Assignment::count())->toBe(0);
    }

    public function rolePermission()
    {
        //  Create roles
        Role::create([
            'name' => 'Admin',
            'description' => 'This is Admin Admin',
        ]);
        $roleTeacher = Role::create([
            'name' => 'Teacher',
            'description' => 'This is Admin Teacher',
        ]);
        Role::create([
            'name' => 'Parent',
            'description' => 'This is Admin Parent',
        ]);
        Role::create([
            'name' => 'Student',
            'description' => 'This is Admin Student',
        ]);
        Role::create([
            'name' => 'Accountant',
            'description' => 'This is Admin Accountant',
        ]);

        $teacher_permissions = [
            [
                'group_name' => 'assignment',
                'permissions' => [
                    'assignment.index',
                    'assignment.create',
                    'assignment.store',
                    'assignment.show',
                    'assignment.edit',
                    'assignment.update',
                    'assignment.destroy',
                ],
            ],

        ];

        for ($i = 0; $i < count($teacher_permissions); $i++) {
            $permissionGroup = $teacher_permissions[$i]['group_name'];

            for ($j = 0; $j < count($teacher_permissions[$i]['permissions']); $j++) {
                // Create Permission
                $permission = Permission::create([
                    'name' => $teacher_permissions[$i]['permissions'][$j],
                    'group_name' => $permissionGroup,
                ]);

                $roleTeacher->givePermissionTo($permission);
            }
        }
    }
}
