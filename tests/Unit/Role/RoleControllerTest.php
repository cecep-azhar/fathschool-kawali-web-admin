<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Inertia\Testing\AssertableInertia;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class RoleControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_visit_role_permission_page()
    {
        $this->rolePermission();

        // Create an admin user
        $user = User::factory()->create([
            'role' => 'Admin',
        ]);

        // Act as the admin user
        $this->actingAs($user);

        // Create some sample roles
        Role::create([
            'name' => 'Student',
            'description' => 'This is Student',
        ]);

        Role::create([
            'name' => 'Teacher',
            'description' => 'This is Teacher',
        ]);

        Role::create([
            'name' => 'Accountant',
            'description' => 'This is Accountant',
        ]);

        // Visit the setting roles index page
        $response = $this->get(route('roles.index'));

        // Assert that the response status is 200 (OK)
        $response->assertStatus(200);

        // Get the inertia page content
        $response->assertInertia(function (AssertableInertia $page) {
            $page->component('Admin/Settings/Role/Index')
                ->tap(function ($page) {
                    $page->has('roles.data.3');
                });
        });
    }

    public function test_admin_can_visit_createRole_permission_page()
    {
        $this->rolePermission();

        // Create an admin user
        $user = User::factory()->create([
            'role' => 'Admin',
        ]);

        // Act as the admin user
        $this->actingAs($user);

        // Create some sample roles
        Role::create([
            'name' => 'Student',
            'description' => 'This is Student',
        ]);

        Role::create([
            'name' => 'Teacher',
            'description' => 'This is Teacher',
        ]);

        Role::create([
            'name' => 'Accountant',
            'description' => 'This is Accountant',
        ]);

        // Visit the setting roles create page
        $response = $this->get(route('roles.create'));

        // Get the inertia page content
        $response->assertInertia(function (AssertableInertia $page) {
            $page->component('Admin/Settings/Role/Create')
                ->tap(function ($page) {
                    $page->has('permissions.roles.4');
                });
        });
    }

    public function test_admin_can_store_new_role()
    {
        $this->rolePermission();

        // Create an admin user
        $user = User::factory()->create([
            'role' => 'Admin',
        ]);

        // Act as the admin user
        $this->actingAs($user);

        // Test data
        $data = [
            'role_permissions' => [
                0 => 'roles.index',
                1 => 'roles.create',
                2 => 'roles.show',
            ],
            'name' => 'Librarian',
            'description' => 'This is for Librarian',
        ];

        // Send a POST request to the store method
        $response = $this->post(route('roles.store'), $data);

        // Assert the response status
        $response->assertStatus(302);

        // Assert the role is stored in the database
        $this->assertDatabaseHas('roles', [
            'name' => 'Librarian',
            'description' => 'This is for Librarian',
        ]);

        // Assert the role_permissions are stored in the database
        $this->assertDatabaseHas('role_has_permissions', [
            'role_id' => Role::where('name', 'Librarian')->first()->id,
            'permission_id' => Permission::where('name', 'roles.index')->first()->id,
        ]);
        $this->assertDatabaseHas('role_has_permissions', [
            'role_id' => Role::where('name', 'Librarian')->first()->id,
            'permission_id' => Permission::where('name', 'roles.create')->first()->id,
        ]);
        $this->assertDatabaseHas('role_has_permissions', [
            'role_id' => Role::where('name', 'Librarian')->first()->id,
            'permission_id' => Permission::where('name', 'roles.show')->first()->id,
        ]);
    }

    public function test_admin_store_validation_check()
    {
        $this->rolePermission();

        // Create an admin user
        $user = User::factory()->create([
            'role' => 'Admin',
        ]);

        // Act as the admin user
        $this->actingAs($user);

        // Test data
        $data = [
            'role_permissions' => [],
            'name' => '',
            'description' => 'This is Super Admin',
        ];

        // Send a POST request to the store method
        $response = $this->post(route('roles.store'), $data)
            ->assertSessionHasErrors(['name', 'role_permissions']);

        // Assert the response status
        $response->assertStatus(302);
    }

    public function rolePermission()
    {
        $roleAdmin = Role::create([
            'name' => 'Admin',
            'description' => 'This is Admin',
        ]);
        $permissions = [
            [
                'group_name' => 'roles',
                'permissions' => [
                    'roles.index',
                    'roles.create',
                    'roles.show',
                    'roles.edit',
                    'roles.destroy',
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
            'roles.index',
            'roles.create',
            'roles.show',
            'roles.edit',
            'roles.destroy',
        ]);
    }
}
