<?php

use App\Models\Leave;
use App\Models\LeaveType;
use App\Models\User;
use Illuminate\Foundation\Testing\{RefreshDatabase};
use Inertia\Testing\AssertableInertia;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class LeaveControllerCodeTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        $this->rolePermission();
    }

    public function test_leave_index_page_as_an_accountant()
    {
        // Create a new user with the 'Accountant' role
        $user = User::factory()->create([
            'role' => 'Accountant',
        ]);

        // Authenticate as the accountant user
        $this->actingAs($user);

        // Create leave types for staff
        LeaveType::create(['role_type' => 'staff', 'name' => 'Paid']);
        LeaveType::create(['role_type' => 'staff', 'name' => 'Non Paid']);
        LeaveType::create(['role_type' => 'staff', 'name' => 'Others']);

        // Create a leave for a user
        Leave::factory()->create(['user_id' => 1]);

        // Send a GET request to the leave index page
        $response = $this->get(route('leave.index'));

        // Assert that the response status is 200 (OK)
        $response->assertStatus(200);

        // $response->assertInertia(function (AssertableInertia $page) {
        //     $page->component('Leave/Index')
        //         ->tap(function ($page) {
        //         $page->has('leaves.data.0');
        //         $page->missing('leaves.data.1');
        //         $page->has('leave_types');
        //         $page->has('total_submit');
        //         $page->has('total_approved');
        //         $page->has('total_rejected');
        //         $page->has('total_pending');
        //     });
        // });
    }

    public function test_leave_index_page_as_a_teacher()
    {
        // Create a new user with the 'Teacher' role
        $user = User::factory()->create([
            'role' => 'Teacher',
        ]);

        // Authenticate as the teacher user
        $this->actingAs($user);

        // Create leave types for staff
        LeaveType::create(['role_type' => 'staff', 'name' => 'Paid']);
        LeaveType::create(['role_type' => 'staff', 'name' => 'Non Paid']);
        LeaveType::create(['role_type' => 'staff', 'name' => 'Others']);

        // Create a leave for a user
        Leave::factory()->create(['user_id' => 1]);

        // Send a GET request to the leave index page
        $response = $this->get(route('leave.index'));

        // Assert that the response status is 200 (OK)
        $response->assertStatus(200);

        // $response->assertInertia(function (AssertableInertia $page) {
        //     $page->component('Leave/Index')->tap(function($page){
        //         $page->has('leaves.data.0');
        //         $page->missing('leaves.data.1');
        //         $page->has('leave_types');
        //         $page->has('total_submit');
        //         $page->has('total_approved');
        //         $page->has('total_rejected');
        //         $page->has('total_pending');
        //     });
        // });
    }

    public function test_leave_index_page_as_a_student()
    {
        $user = User::factory()->create([
            'role' => 'Student',
        ]);
        $this->actingAs($user);
        LeaveType::create(['role_type' => 'student', 'name' => 'Full Day']);
        LeaveType::create(['role_type' => 'student', 'name' => 'Half Day']);
        Leave::factory()->create(['user_id' => 1]);
        $response = $this->get(route('leave.index'));
        $response->assertStatus(200);
        // $response->assertInertia(function (AssertableInertia $page) {
        //     $page->component('Leave/Index')->tap(function($page){
        //         $page->has('leaves.data.0');
        //         $page->missing('leaves.data.1');
        //         $page->has('leave_types');
        //         $page->has('total_submit');
        //         $page->has('total_approved');
        //         $page->has('total_rejected');
        //         $page->has('total_pending');
        //     });
        // });
    }

    public function test_generate_new_leave_as_accountant()
    {
        // Create a new user with the 'Accountant' role
        $user = User::factory()->create([
            'role' => 'Accountant',
        ]);

        // Authenticate as the accountant user
        $this->actingAs($user);

        // Create a leave type for staff
        LeaveType::create(['role_type' => 'staff', 'name' => 'Paid']);

        // Create data for leave generation
        $data = [
            'date' => ['12-02-2023', '13-02-2023'],
            'date2' => ['12-02-2023', '13-02-2023'],
            'description' => 'I need leave',
            'leave_type_id' => 1,
        ];

        // Send a POST request to generate a new leave
        $response = $this->post(route('leave.store'), $data);

        // Assert that the response status is 302 (Found)
        $response->assertStatus(302);

        // Check the count of leaves in the database
        $count = Leave::count();
        expect($count)->toBe(1);
    }

    public function test_generate_new_leave_as_teacher()
    {
        // Create a new user with the 'Teacher' role
        $user = User::factory()->create([
            'role' => 'Teacher',
        ]);

        // Authenticate as the teacher user
        $this->actingAs($user);

        // Create a leave type for staff
        LeaveType::create(['role_type' => 'staff', 'name' => 'Paid']);

        // Create data for leave generation
        $data = [
            'date' => ['12-02-2023', '13-02-2023'],
            'date2' => ['12-02-2023', '13-02-2023'],
            'description' => 'I need leave',
            'leave_type_id' => 1,
        ];

        // Send a POST request to generate a new leave
        $response = $this->post(route('leave.store'), $data);

        // Assert that the response status is 302 (Found)
        $response->assertStatus(302);

        // Check the count of leaves in the database
        $count = Leave::count();
        expect($count)->toBe(1);
    }

    public function test_generate_new_leave_as_student()
    {
        // Create a new user with the 'Student' role
        $user = User::factory()->create([
            'role' => 'Student',
        ]);

        // Authenticate as the student user
        $this->actingAs($user);

        // Create a leave type for staff
        LeaveType::create(['role_type' => 'staff', 'name' => 'Full Day']);

        // Create data for leave generation
        $data = [
            'date' => ['12-02-2023', '13-02-2023'],
            'date2' => ['12-02-2023', '13-02-2023'],
            'description' => 'I need leave',
            'leave_type_id' => 1,
        ];

        // Send a POST request to generate a new leave
        $this->post(route('leave.store'), $data);

        // Check the count of leaves in the database
        $count = Leave::count();
        expect($count)->toBe(1);
    }

    public function test_check_leave_request_validation_as_accountant()
    {
        // Create a new user with the 'Accountant' role
        $user = User::factory()->create([
            'role' => 'Accountant',
        ]);

        // Authenticate as the accountant user
        $this->actingAs($user);

        // Create a leave type for staff
        LeaveType::create(['role_type' => 'staff', 'name' => 'Paid']);

        // Create empty data for leave request
        $data = [];

        // Send a POST request to generate a new leave and assert for validation errors
        $this->post(route('leave.store'), $data)->assertSessionHasErrors(['description', 'date', 'leave_type_id']);

        // Check the count of leaves in the database
        $count = Leave::count();
        expect($count)->toBe(0);
    }

    public function test_check_leave_request_validation_as_teacher()
    {
        // Create a new user with the 'Teacher' role
        $user = User::factory()->create([
            'role' => 'Teacher',
        ]);

        // Authenticate as the teacher user
        $this->actingAs($user);

        // Create a leave type for staff
        LeaveType::create(['role_type' => 'staff', 'name' => 'Paid']);

        // Create empty data for leave request
        $data = [];

        // Send a POST request to generate a new leave and assert for validation errors
        $this->post(route('leave.store'), $data)->assertSessionHasErrors(['description', 'date', 'leave_type_id']);

        // Check the count of leaves in the database
        $count = Leave::count();
        expect($count)->toBe(0);
    }

    public function test_check_leave_request_validation_as_student()
    {
        // Create a new user with the 'Student' role
        $user = User::factory()->create([
            'role' => 'Student',
        ]);

        // Authenticate as the student user
        $this->actingAs($user);

        // Create a leave type for staff
        LeaveType::create(['role_type' => 'staff', 'name' => 'Paid']);

        // Create empty data for leave request
        $data = [];

        // Send a POST request to generate a new leave and assert for validation errors
        $this->post(route('leave.store'), $data)->assertSessionHasErrors(['description', 'date', 'leave_type_id']);

        // Check the count of leaves in the database
        $count = Leave::count();
        expect($count)->toBe(0);
    }

    public function rolePermission()
    {
        //  Create roles
        $roleSuperAdmin = Role::create([
            'name' => 'Admin',
            'description' => 'This is Admin Admin',
        ]);
        $roleTeacher = Role::create([
            'name' => 'Teacher',
            'description' => 'This is Admin Teacher',
        ]);
        $roleParent = Role::create([
            'name' => 'Parent',
            'description' => 'This is Admin Parent',
        ]);
        $roleStudent = Role::create([
            'name' => 'Student',
            'description' => 'This is Admin Student',
        ]);
        $roleAccountant = Role::create([
            'name' => 'Accountant',
            'description' => 'This is Admin Accountant',
        ]);

        $permissions = [
            [
                'group_name' => 'request-leave',
                'permissions' => [
                    'request-leave.index',
                    'request-leave.create',
                    'manage.leave-type',
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

        $roleAccountant->givePermissionTo([
            'request-leave.index',
            'request-leave.create',
        ]);

        $roleTeacher->givePermissionTo([
            'request-leave.index',
            'request-leave.create',
        ]);

        $roleStudent->givePermissionTo([
            'request-leave.index',
            'request-leave.create',
        ]);
    }
}
