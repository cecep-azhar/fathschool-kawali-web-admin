<?php

use App\Models\TeacherSubject;
use App\Models\User;
use Database\Seeders\AssignmentSeeder;
use Database\Seeders\CourseSeeder;
use Database\Seeders\DepartmentSeeder;
use Database\Seeders\LeaveSeeder;
use Database\Seeders\LeaveTypeSeeder;
use Database\Seeders\OnlineClassSeeder;
use Database\Seeders\SubjectSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Inertia\Testing\AssertableInertia;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class TeacherControllerCodeTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_visit_teacher_index_page()
    {
        $this->rolePermission();

        // Create an admin user
        $user = User::factory()->create([
            'role' => 'Admin',
        ]);

        // Act as the admin user
        $this->actingAs($user);

        // Create 20 users as teacher and seeding database
        $this->seed(DepartmentSeeder::class);
        User::factory()->count(5)->create(['role' => 'Teacher']);

        // Visit the user index page
        $response = $this->get(route('teachers.index'));

        // Assert that the response status is 200 (OK)
        $response->assertStatus(200);

        // Assert the inertia page content
        $response->assertInertia(function (AssertableInertia $page) {
            $page->component('Admin/Teacher/Index')
                ->tap(function ($page) {
                    // Assert specific data on the page
                    $page->has('users.data.4');
                    $page->has('departments.0');
                });
        });
    }

    public function test_admin_can_search_in_teacher_index_page()
    {
        $this->rolePermission();

        // Create an admin user
        $user = User::factory()->create([
            'role' => 'Admin',
        ]);

        // Act as the admin user
        $this->actingAs($user);

        // Create 200 users as teacher
        $this->seed(DepartmentSeeder::class);
        User::factory()->count(200)->create(['role' => 'Teacher']);

        $data = [
            'keyword' => null,
            'course' => null,
            'department' => 'commerce',
        ];
        $queryString = http_build_query($data);

        // Visit the user index page
        $response = $this->get('teachers?'.$queryString);

        // Assert that the response status is 200 (OK)
        $response->assertStatus(200);

        // Assert the inertia page content
        $response->assertInertia(function (AssertableInertia $page) {
            $page->component('Admin/Teacher/Index')
                ->tap(function ($page) {
                    // Assert specific data on the page
                    $page->has('users.data.0');
                    $page->has('departments.0');
                    $page->has('filter_data.department');
                });
        });
    }

    public function test_admin_can_visit_in_teacher_edit_page()
    {
        $this->rolePermission();

        // Create an admin user
        $user = User::factory()->create([
            'role' => 'Admin',
        ]);

        // Act as the admin user
        $this->actingAs($user);

        // Create 200 users as teacher
        $this->seed([DepartmentSeeder::class, CourseSeeder::class, SubjectSeeder::class]);
        User::factory()->create(['role' => 'Teacher']);

        // Visit the user index page
        $response = $this->get(route('teachers.edit', 2));

        // Assert that the response status is 200 (OK)
        $response->assertStatus(200);

        // Assert the inertia page content
        $response->assertInertia(function (AssertableInertia $page) {
            $page->component('Admin/Teacher/Form')
                ->tap(function ($page) {
                    // Assert specific data on the page
                    $page->has('teacher.id');
                    $page->has('departments.0');
                    $page->has('nationalities.192');
                });
        });
    }

    public function test_admin_can_visit_in_teacher_class_page()
    {
        // Set up the necessary role permission
        $this->rolePermission();

        // Create an admin user
        $user = User::factory()->create([
            'role' => 'Admin',
        ]);

        // Act as the admin user
        $this->actingAs($user);

        // Create a users as teachers
        $this->seed([DepartmentSeeder::class, CourseSeeder::class, SubjectSeeder::class]);
        User::factory()->create(['role' => 'Teacher']);
        TeacherSubject::create([
            'teacher_id' => 2,
            'subject_id' => 2,
        ]);

        // Visit the teacher class page for user with ID 2
        $response = $this->get(route('teacher.classes', 2));

        // Assert that the response status is 200 (OK)
        $response->assertStatus(200);

        // Assert the Inertia page content
        $response->assertInertia(function (AssertableInertia $page) {
            $page->component('Admin/Teacher/Class/Index')
                ->tap(function ($page) {
                    // Assert specific data on the page
                    $page->has('teacher.id');
                    $page->has('courses.0');
                });
        });
    }

    public function test_admin_can_assign_class()
    {
        // Set up the necessary role permission
        $this->rolePermission();

        // Create an admin user
        $user = User::factory()->create([
            'role' => 'Admin',
        ]);

        // Act as the admin user
        $this->actingAs($user);

        // Create users as teachers
        $this->seed([DepartmentSeeder::class, CourseSeeder::class, SubjectSeeder::class]);
        User::factory()->create(['role' => 'Teacher']);

        // Prepare the data for class assignment
        $data = [
            'subjects' => [
                0 => 1,
                1 => 2,
                2 => 3,
            ],
            'teacher' => 2,
            'destroy' => false,
        ];

        // Send a POST request to assign the class
        $response = $this->post(route('teacher.class.assign'), $data);

        // Assert that the response status is 302 (redirect)
        $response->assertStatus(302);

        // Expect that the TeacherSubject relationship for the assigned teacher contains 3 subjects
        expect(TeacherSubject::where('teacher_id', 2)->count())->toBe(3);
    }

    public function test_admin_can_visit_in_teacher_details_page()
    {
        // Set up the necessary role permission
        $this->rolePermission();

        // Create an admin user
        $user = User::factory()->create([
            'role' => 'Admin',
        ]);

        // Act as the admin user
        $this->actingAs($user);

        // Create a users as teachers
        $this->seed([
            DepartmentSeeder::class,
            CourseSeeder::class,
            SubjectSeeder::class,
        ]);
        User::factory()->create(['role' => 'Teacher']);
        TeacherSubject::create([
            'teacher_id' => 2,
            'subject_id' => 2,
        ]);
        $this->seed([
            AssignmentSeeder::class,
            OnlineClassSeeder::class,
            LeaveTypeSeeder::class,
            LeaveSeeder::class,
        ]);

        // Visit the teacher class page for user with ID 2
        $response = $this->get(route('teacher.show', 2));

        // Assert that the response status is 200 (OK)
        $response->assertStatus(200);

        // Assert the Inertia page content
        $response->assertInertia(function (AssertableInertia $page) {
            $page->component('Admin/Teacher/Show')
                ->tap(function ($page) {
                    // Assert specific data on the page
                    $page->has('teacher.id');
                    $page->has('leaves.data.0');
                });
        });
    }

    public function rolePermission()
    {
        $roleAdmin = Role::create([
            'name' => 'Admin',
            'description' => 'This is Admin',
        ]);
        $permissions = [
            [
                'group_name' => 'users',
                'permissions' => [
                    'teacher.list',
                    'users.show',
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
            'teacher.list',
            'users.show',
        ]);
    }
}
