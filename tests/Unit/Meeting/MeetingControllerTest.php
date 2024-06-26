<?php

use App\Models\Meeting;
use App\Models\User;
use Illuminate\Foundation\Testing\{RefreshDatabase};
use Inertia\Testing\AssertableInertia;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class MeetingControllerCodeTest extends TestCase
{
    use RefreshDatabase;

    public function test_for_admin_role_Meeting_index_page()
    {
        // Setting up the super admin role permission
        $this->superAdminRolePermission();

        // Creating a user with the 'Admin' role
        $user = User::factory()->create([
            'role' => 'Admin',
        ]);

        // Authenticating the user
        $this->actingAs($user);

        // Creating 10 Meeting instances using a factory
        Meeting::factory()->count(10)->create();

        // Sending a GET request to the 'meeting.index' route
        $response = $this->get(route('meeting.index'));

        // Asserting that the response has a status code of 200 (OK)
        $response->assertStatus(200);

        // Asserting the response using the Inertia testing helpers
        $response->assertInertia(function (AssertableInertia $page) {
            // Asserting that the page component is 'Admin/Meeting/Index'
            $page->component('Admin/Meeting/Index')

                // Using the 'tap' method to perform additional assertions on the page
                ->tap(function ($page) {
                    // Asserting that the page has the 'meetings.data.9' key
                    $page->has('meetings.data.9');

                    // Asserting that the page does not have the 'meetings.data.10' key
                    $page->missing('meetings.data.10');
                });
        });
    }

    public function test_for_accountant_role_Meeting_index_page()
    {
        // Setting up the role permission
        $this->rolePermission();

        // Creating a user with the 'Accountant' role
        $user = User::factory()->create([
            'role' => 'Accountant',
        ]);

        // Authenticating the user
        $this->actingAs($user);

        // Creating 10 Meeting instances using a factory
        Meeting::factory()->count(10)->create();

        // Sending a GET request to the 'meeting.index' route
        $response = $this->get(route('meeting.index'));

        // Asserting that the response has a status code of 200 (OK)
        $response->assertStatus(200);

        // Asserting the response using the Inertia testing helpers
        $response->assertInertia(function (AssertableInertia $page) {
            // Asserting that the page component is 'Admin/Meeting/Index'
            $page->component('Admin/Meeting/Index')

                // Using the 'tap' method to perform additional assertions on the page
                ->tap(function ($page) {
                    // Asserting that the page has the 'meetings.data.9' key
                    $page->has('meetings.data.9');

                    // Asserting that the page does not have the 'meetings.data.10' key
                    $page->missing('meetings.data.10');
                });
        });
    }

    public function test_for_teacher_role_Meeting_index_page()
    {
        // Setting up the role permission
        $this->rolePermission();

        // Creating a user with the 'Teacher' role
        $user = User::factory()->create([
            'role' => 'Teacher',
        ]);

        // Authenticating the user
        $this->actingAs($user);

        // Creating 10 Meeting instances using a factory
        Meeting::factory()->count(10)->create();

        // Sending a GET request to the 'meeting.index' route
        $response = $this->get(route('meeting.index'));

        // Asserting that the response has a status code of 200 (OK)
        $response->assertStatus(200);

        // Asserting the response using the Inertia testing helpers
        $response->assertInertia(function (AssertableInertia $page) {
            // Asserting that the page component is 'Admin/Meeting/Index'
            $page->component('Admin/Meeting/Index')

                // Using the 'tap' method to perform additional assertions on the page
                ->tap(function ($page) {
                    // Asserting that the page has the 'meetings.data.0' key
                    $page->has('meetings.data.0');

                    // Asserting that the page does not have the 'meetings.data.10' key
                    $page->missing('meetings.data.10');
                });
        });
    }

    public function test_admin_role_Meeting_store_for_all_participants()
    {
        // Setting up the super admin role permission
        $this->superAdminRolePermission();

        // Creating a user with the 'Admin' role
        $user = User::factory()->create([
            'role' => 'Admin',
        ]);

        // Creating 5 users with the 'Student' role
        User::factory()->count(5)->create([
            'role' => 'Student',
        ]);

        // Authenticating the user
        $this->actingAs($user);

        // Creating the data for the meeting
        $data = [
            'topic' => 'Bangladesh',
            'start_date' => '2023-06-06T07:58:25+0600',
            'password' => '12345678',
            'selected_role' => 'Student',
            'participants' => [],
            'description' => 'Bangladesh is beautiful.',
            'all_user' => true,
        ];

        // Sending a POST request to the 'meeting.store' route with the data
        $response = $this->post(route('meeting.store'), $data);

        // Asserting that the response has a status code of 302 (Found/Redirect)
        $response->assertStatus(302);

        // Asserting that there is one Meeting record in the database
        expect(Meeting::count())->toBe(1);
    }

    public function test_admin_role_Meeting_store_for_specific_participants()
    {
        // Setting up the super admin role permission
        $this->superAdminRolePermission();

        // Creating a user with the 'Admin' role
        $user = User::factory()->create([
            'role' => 'Admin',
        ]);

        // Creating 5 users with the 'Student' role
        User::factory()->count(5)->create([
            'role' => 'Student',
        ]);

        // Authenticating the user
        $this->actingAs($user);

        // Creating the data for the meeting
        $data = [
            'topic' => 'Bangladesh',
            'start_date' => '2023-06-06T07:58:25+0600',
            'password' => '12345678',
            'selected_role' => 'Student',
            'participants' => [
                0 => 2,
                1 => 3,
                2 => 4,
                3 => 5,
                4 => 6,
            ],
            'description' => 'Bangladesh is beautiful.',
            'all_user' => false,
        ];

        // Sending a POST request to the 'meeting.store' route with the data
        $response = $this->post(route('meeting.store'), $data);

        // Asserting that the response has a status code of 302 (Found/Redirect)
        $response->assertStatus(302);

        // Asserting that there is one Meeting record in the database
        expect(Meeting::count())->toBe(1);
    }

    public function test_admin_role_Meeting_store_validation_check()
    {
        // Setting up the super admin role permission
        $this->superAdminRolePermission();

        // Creating a user with the 'Admin' role
        $user = User::factory()->create([
            'role' => 'Admin',
        ]);

        // Creating 5 users with the 'Student' role
        User::factory()->count(5)->create([
            'role' => 'Student',
        ]);

        // Authenticating the user
        $this->actingAs($user);

        // Creating the data for the meeting without required fields
        $data = [
            'description' => 'Bangladesh is beautiful.',
        ];

        // Sending a POST request to the 'meeting.store' route with the data
        // and asserting that it triggers validation errors for missing fields
        $response = $this->post(route('meeting.store'), $data)
            ->assertSessionHasErrors(['topic', 'start_date', 'password', 'participants']);

        // Asserting that there are no Meeting records in the database
        expect(Meeting::count())->toBe(0);
    }

    public function test_admin_role_Meeting_delete()
    {
        // Setting up the super admin role permission
        $this->superAdminRolePermission();

        // Creating a user with the 'Admin' role
        $user = User::factory()->create([
            'role' => 'Admin',
        ]);

        // Creating 5 users with the 'Student' role
        User::factory()->count(5)->create([
            'role' => 'Student',
        ]);

        // Authenticating the user
        $this->actingAs($user);

        // Creating the data for the meeting
        $data = [
            'topic' => 'Bangladesh',
            'start_date' => '2023-06-06T07:58:25+0600',
            'password' => '12345678',
            'selected_role' => 'Student',
            'participants' => [],
            'description' => 'Bangladesh is beautiful.',
            'all_user' => true,
        ];

        // Sending a POST request to the 'meeting.store' route with the data
        $response = $this->post(route('meeting.store'), $data);

        // Sending a DELETE request to the 'meeting.destroy' route for the created meeting
        $response = $this->delete(route('meeting.destroy', 1));

        // Asserting that the response has a status code of 302 (Found/Redirect)
        $response->assertStatus(302);

        // Asserting that there are no Meeting records in the database
        expect(Meeting::count())->toBe(0);
    }

    public function rolePermission()
    {
        $roleTeacher = Role::create([
            'name' => 'Teacher',
            'description' => 'This is Admin Teacher',
        ]);
        $roleAccountant = Role::create([
            'name' => 'Accountant',
            'description' => 'This is Admin Accountant',
        ]);
        $accountant_permissions = [
            [
                'group_name' => 'meeting',
                'permissions' => [
                    'meeting.index',
                ],
            ],
        ];
        for ($i = 0; $i < count($accountant_permissions); $i++) {
            $permissionGroup = $accountant_permissions[$i]['group_name'];

            for ($j = 0; $j < count($accountant_permissions[$i]['permissions']); $j++) {
                $permission = Permission::create([
                    'name' => $accountant_permissions[$i]['permissions'][$j],
                    'group_name' => $permissionGroup,
                ]);

                $roleAccountant->givePermissionTo($permission);
                $roleTeacher->givePermissionTo($permission);
            }
        }
    }

    public function superAdminRolePermission()
    {
        $roleSuperAdmin = Role::create([
            'name' => 'Admin',
            'description' => 'This is Admin',
        ]);
        $permissions = [
            [
                'group_name' => 'meeting',
                'permissions' => [
                    'meeting.index',
                    'meeting.create',
                    'meeting.edit',
                    'meeting.destroy',
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
            'meeting.index',
            'meeting.create',
            'meeting.edit',
            'meeting.destroy',
        ]);
    }
}
