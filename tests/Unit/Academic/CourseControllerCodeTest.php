<?php

use App\Models\Course;
use App\Models\User;
use Database\Seeders\CourseSeeder;
use Database\Seeders\CurrencySeeder;
use Database\Seeders\PlanSeeder;
use Database\Seeders\SubjectSeeder;
use Database\Seeders\UserCourseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Inertia\Testing\AssertableInertia;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class CourseControllerCodeTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_visit_course_index_page()
    {
        // Set up role permissions
        $this->rolePermission();

        // Create a new Admin user
        $user = User::factory()->create([
            'role' => 'Admin',
        ]);

        // Authenticate the admin user
        $this->actingAs($user);

        // Seed the database with courses, subjects,currency, plans, and student users
        $this->seed(CourseSeeder::class);
        $this->seed(SubjectSeeder::class);
        User::factory()->count(10)->create(['role' => 'Student']);
        $this->seed(UserCourseSeeder::class);

        // Send a GET request to the course index page
        $response = $this->get(route('course.index'));

        // Assert that the response has a status code of 200
        $response->assertStatus(200);

        // Assert that the response contains the expected Inertia component and data
        $response->assertInertia(function (AssertableInertia $page) {
            $page->component('Admin/Course/Index')
                ->tap(function ($page) {
                    $page->has('courses.0');
                    $page->has('courses.0.students');
                });
        });
    }

    public function test_admin_can_generate_new_course()
    {
        // Set up role permissions
        $this->rolePermission();

        // Create a new Admin user
        $user = User::factory()->create([
            'role' => 'Admin',
        ]);

        // Authenticate the admin user
        $this->actingAs($user);

        // Define the data for the new course
        $data = [
            'name' => 'opu',
            'has_multiple_subject' => true,
            'subjects' => [
                0 => [
                    'name' => 'bangla',
                    'color' => '#FFFFFF',
                ],
                1 => [
                    'name' => 'english',
                    'color' => '#000000',
                ],
            ],
        ];

        // Send a POST request to create a new course
        $response = $this->post(route('course.store'), $data);

        // Assert that the response has a status code of 302 (redirect)
        $response->assertStatus(302);

        // Assert that a new course has been created
        expect(Course::count())->toBe(1);
    }

    public function test_admin_fails_to_generate_new_course_for_validation()
    {
        // Set up role permissions
        $this->rolePermission();

        // Create a new Admin user
        $user = User::factory()->create([
            'role' => 'Admin',
        ]);

        // Authenticate the admin user
        $this->actingAs($user);

        // Send a POST request to create a new course without providing the required data
        $response = $this->post(route('course.store'), [])
            ->assertSessionHasErrors(['name']);

        // Assert that the response has a status code of 302 (redirect)
        $response->assertStatus(302);

        // Assert that no course has been created
        expect(Course::count())->toBe(0);
    }

    public function test_admin_can_update_course()
    {
        // Set up role permissions
        $this->rolePermission();

        // Create a new Admin user
        $user = User::factory()->create([
            'role' => 'Admin',
        ]);

        // Authenticate the admin user
        $this->actingAs($user);

        // Create a course with the name 'Math'
        Course::create([
            'name' => 'Math',
        ]);

        // Prepare the updated data for the course
        $data = [
            'name' => 'Physics',
            'has_multiple_subject' => true,
            'subjects' => [
                0 => [
                    'name' => 'bangla',
                    'color' => '#FFFFFF',
                ],
                1 => [
                    'name' => 'english',
                    'color' => '#000000',
                ],
            ],
        ];

        // Send a PUT request to update the course with ID 1
        $response = $this->put(route('course.update', 1), $data);

        // Assert that the response has a status code of 302 (redirect)
        $response->assertStatus(302);

        // Assert that the name of the first course is now 'Physics'
        expect(Course::first()->name)->toBe('Physics');
    }

    public function test_admin_fails_to_update_course_for_validation()
    {
        // Set up role permissions
        $this->rolePermission();

        // Create a new Admin user
        $user = User::factory()->create([
            'role' => 'Admin',
        ]);

        // Authenticate the admin user
        $this->actingAs($user);

        // Create a course with the name 'Math'
        Course::create([
            'name' => 'Math',
        ]);

        // Send a PUT request to update the course with ID 1 with empty data
        $response = $this->put(route('course.update', 1), [])
            ->assertSessionHasErrors(['name']);

        // Assert that the response has a status code of 302 (redirect)
        $response->assertStatus(302);

        // Assert that the name of the first course is still 'Math'
        expect(Course::first()->name)->toBe('Math');
    }

    public function test_admin_can_delete_course()
    {
        // Set up role permissions
        $this->rolePermission();

        // Create a new Admin user
        $user = User::factory()->create([
            'role' => 'Admin',
        ]);

        // Authenticate the admin user
        $this->actingAs($user);

        // Create a course with the name 'Math'
        Course::create([
            'name' => 'Math',
        ]);

        // Send a DELETE request to delete the course with ID 1
        $response = $this->delete(route('course.destroy', 1));

        // Assert that the response has a status code of 302 (redirect)
        $response->assertStatus(302);

        // Assert that there are no courses in the database
        expect(Course::count())->toBe(0);
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
