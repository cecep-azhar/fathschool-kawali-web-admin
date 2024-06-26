<?php

use App\Models\Department;
use App\Models\User;
use Database\Seeders\DepartmentSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Inertia\Testing\AssertableInertia;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class DepartmentControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_visit_department_index_page()
    {
        // Set up role permissions
        $this->rolePermission();

        // Create a new Admin user
        $user = User::factory()->create([
            'role' => 'Admin',
        ]);

        // Authenticate the admin user
        $this->actingAs($user);

        // Seed the DepartmentSeeder to create department data
        $this->seed(DepartmentSeeder::class);

        // Send a GET request to the department index page
        $response = $this->get(route('departments.index'));

        // Assert that the response has a status code of 200 (OK)
        $response->assertStatus(200);

        // Assert that the response contains the expected Inertia component and data
        $response->assertInertia(function (AssertableInertia $page) {
            $page->component('Admin/Department/Index')
                ->tap(function ($page) {
                    $page->has('departments.data.0');
                });
        });
    }

    public function test_admin_can_generate_new_department()
    {
        // Set up role permissions
        $this->rolePermission();

        // Create a new Admin user
        $user = User::factory()->create([
            'role' => 'Admin',
        ]);

        // Authenticate the admin user
        $this->actingAs($user);

        // Define the data for the new department
        $data = [
            'name' => 'History of Bangladesh',
        ];

        // Send a POST request to create a new department
        $response = $this->post(route('departments.store'), $data);

        // Assert that the response has a status code of 302 (Found/Redirect)
        $response->assertStatus(302);

        // Assert that the department count is now 1
        expect(Department::count())->toBe(1);
    }

    public function test_admin_fails_to_generate_new_department_for_validation()
    {
        // Set up role permissions
        $this->rolePermission();

        // Create a new Admin user
        $user = User::factory()->create([
            'role' => 'Admin',
        ]);

        // Authenticate the admin user
        $this->actingAs($user);

        // Define empty data for the new department (to trigger validation error)
        $data = [];

        // Send a POST request with empty data
        $response = $this->post(route('departments.store'), $data)
            ->assertSessionHasErrors(['name']);

        // Assert that the response has a status code of 302 (Found/Redirect)
        $response->assertStatus(302);

        // Assert that the department count is still 0
        expect(Department::count())->toBe(0);
    }

    public function test_admin_can_update_department()
    {
        // Set up role permissions
        $this->rolePermission();

        // Create a new Admin user
        $user = User::factory()->create([
            'role' => 'Admin',
        ]);

        // Authenticate the admin user
        $this->actingAs($user);

        // Create a new department with a different name
        Department::create(['name' => 'History of Bhutan']);

        // Define the data for the updated department
        $data = [
            'name' => 'History of Bangladesh',
        ];

        // Send a PUT request to update the department
        $response = $this->put(route('departments.update', 1), $data);

        // Assert that the response has a status code of 302 (Found/Redirect)
        $response->assertStatus(302);

        // Assert that the name of the first department is now 'History of Bangladesh'
        expect(Department::first()->name)->toBe('History of Bangladesh');
    }

    public function test_admin_fails_to_update_department_for_validation()
    {
        // Set up role permissions
        $this->rolePermission();

        // Create a new Admin user
        $user = User::factory()->create([
            'role' => 'Admin',
        ]);

        // Authenticate the admin user
        $this->actingAs($user);

        // Create a new department with a specific name
        Department::create(['name' => 'History of Bhutan']);

        // Define empty data for the updated department (to trigger validation error)
        $data = [];

        // Send a PUT request with empty data
        $response = $this->put(route('departments.update', 1), $data)
            ->assertSessionHasErrors(['name']);

        // Assert that the response has a status code of 302 (Found/Redirect)
        $response->assertStatus(302);

        // Assert that the name of the first department is still 'History of Bhutan'
        expect(Department::first()->name)->toBe('History of Bhutan');
    }

    public function test_admin_can_delete_department()
    {
        // Set up role permissions
        $this->rolePermission();

        // Create a new Admin user
        $user = User::factory()->create([
            'role' => 'Admin',
        ]);

        // Authenticate the admin user
        $this->actingAs($user);

        // Create a new department with a specific name
        Department::create(['name' => 'History of Bhutan']);

        // Send a DELETE request to delete the department
        $response = $this->delete(route('departments.destroy', 1));

        // Assert that the response has a status code of 302 (Found/Redirect)
        $response->assertStatus(302);
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
