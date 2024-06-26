<?php

use App\Models\Notice;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Inertia\Testing\AssertableInertia;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class NoticeBoardCodeTest extends TestCase
{
    use RefreshDatabase;

    private function prepareTest($role)
    {
        $this->rolePermission();
        $user = User::factory()->create([
            'role' => $role,
        ]);
        $this->actingAs($user);
        Notice::factory()->create();
    }

    public function test_notice_board_page_as_an_admin()
    {
        // Prepare the test with the 'Admin' role
        $this->prepareTest('Admin');

        // Send a GET request to the notice board index page and assert for success
        $response = $this->get(route('notice-board.index'));
        $response->assertStatus(200);

        // Assert that the Inertia component used in the response is 'Admin/Announcement/Index'
        $response->assertInertia(function (AssertableInertia $page) {
            $page->component('Admin/Announcement/Index');
        });
    }

    public function test_admin_can_store_new_notice()
    {
        // Prepare the test with the 'Admin' role
        $this->prepareTest('Admin');

        // Create data for a new notice
        $data = [
            'title' => 'Victory day',
            'description' => '16 December is our victory day.',
            'status' => 'public',
            'file' => UploadedFile::fake()->create('invoice.jpg', 1024),
        ];

        // Send a POST request to store the new notice and assert for success
        $response = $this->post(route('notice-board.store'), $data);
        $response->assertStatus(302);

        // Check the count of notices in the database
        expect(Notice::count())->toBe(2);
    }

    public function test_admin_store_notice_validation()
    {
        // Prepare the test with the 'Admin' role
        $this->prepareTest('Admin');

        // Create empty data for a new notice
        $data = [];

        // Send a POST request to store the new notice and assert for validation errors
        $response = $this->post(route('notice-board.store'), $data)
            ->assertSessionHasErrors(['title', 'file', 'description', 'status']);
        $response->assertStatus(302);

        // Check the count of notices in the database
        expect(Notice::count())->toBe(1);
    }

    public function test_admin_can_update_notice()
    {
        // Prepare the test with the 'Admin' role
        $this->prepareTest('Admin');

        // Create data for updating a notice
        $data = [
            'title' => 'Victory day',
            'description' => '16 December is our victory day.',
            'status' => 'public',
            'file' => UploadedFile::fake()->create('invoice.jpg', 1024),
        ];

        // Send a PUT request to update the notice and assert for success
        $response = $this->put(route('notice-board.update', 1), $data);
        $response->assertStatus(302);

        // Check the count of notices in the database
        expect(Notice::count())->toBe(1);
    }

    public function test_admin_update_notice_validation()
    {
        // Prepare the test with the 'Admin' role
        $this->prepareTest('Admin');

        // Create empty data for updating a notice
        $data = [];

        // Send a PUT request to update the notice and assert for validation errors
        $response = $this->put(route('notice-board.update', 1), $data)
            ->assertSessionHasErrors(['title', 'description', 'status']);
        $response->assertStatus(302);
    }

    public function test_admin_delete_notice()
    {
        // Prepare the test with the 'Admin' role
        $this->prepareTest('Admin');

        // Send a DELETE request to delete a notice and assert for success
        $response = $this->delete(route('notice-board.destroy', 1));
        $response->assertStatus(302);

        // Check the count of notices in the database
        expect(Notice::count())->toBe(0);
    }

    public function test_notice_board_page_as_an_accountant()
    {
        // Prepare the test with the 'Accountant' role
        $this->prepareTest('Accountant');

        // Send a GET request to the notice board index page and assert for success
        $response = $this->get(route('notice-board.index'));
        $response->assertStatus(200);

        // Assert that the Inertia component used in the response is 'NoticeBoard'
        $response->assertInertia(function (AssertableInertia $page) {
            $page->component('NoticeBoard');
        });
    }

    public function test_notice_board_page_as_a_student()
    {
        // Prepare the test with the 'Student' role
        $this->prepareTest('Student');

        // Send a GET request to the notice board index page and assert for success
        $response = $this->get(route('notice-board.index'));
        $response->assertStatus(200);

        // Assert that the Inertia component used in the response is 'NoticeBoard'
        $response->assertInertia(function (AssertableInertia $page) {
            $page->component('NoticeBoard');
        });
    }

    public function test_notice_board_page_as_a_teacher()
    {
        // Prepare the test with the 'Teacher' role
        $this->prepareTest('Teacher');

        // Send a GET request to the notice board index page and assert for success
        $response = $this->get(route('notice-board.index'));
        $response->assertStatus(200);

        // Assert that the Inertia component used in the response is 'NoticeBoard'
        $response->assertInertia(function (AssertableInertia $page) {
            $page->component('NoticeBoard');
        });
    }

    public function test_notice_board_details_page_as_an_admin()
    {
        // Prepare the test with the 'Admin' role
        $this->prepareTest('Admin');

        // Get the first notice from the database
        $notice = Notice::first();

        // Send a GET request to the notice board details page and assert for success
        $response = $this->get(route('notice.board.details', $notice->slug));
        $response->assertStatus(200);

        // Assert that the Inertia component used in the response is 'NoticeDetails'
        $response->assertInertia(function (AssertableInertia $page) {
            $page->component('NoticeDetails');
        });
    }

    public function test_notice_board_details_page_as_an_accountant()
    {
        // Prepare the test with the 'Accountant' role
        $this->prepareTest('Accountant');

        // Get the first notice from the database
        $notice = Notice::first();

        // Send a GET request to the notice board details page and assert for success
        $response = $this->get(route('notice.board.details', $notice->slug));
        $response->assertStatus(200);

        // Assert that the Inertia component used in the response is 'NoticeDetails'
        $response->assertInertia(function (AssertableInertia $page) {
            $page->component('NoticeDetails');
        });
    }

    public function test_notice_board_details_page_as_a_student()
    {
        // Prepare the test with the 'Student' role
        $this->prepareTest('Student');

        // Get the first notice from the database
        $notice = Notice::first();

        // Send a GET request to the notice board details page and assert for success
        $response = $this->get(route('notice.board.details', $notice->slug));
        $response->assertStatus(200);

        // Assert that the Inertia component used in the response is 'NoticeDetails'
        $response->assertInertia(function (AssertableInertia $page) {
            $page->component('NoticeDetails');
        });
    }

    public function test_notice_board_details_page_as_a_teacher()
    {
        // Prepare the test with the 'Teacher' role
        $this->prepareTest('Teacher');

        // Get the first notice from the database
        $notice = Notice::first();

        // Send a GET request to the notice board details page and assert for success
        $response = $this->get(route('notice.board.details', $notice->slug));
        $response->assertStatus(200);

        // Assert that the Inertia component used in the response is 'NoticeDetails'
        $response->assertInertia(function (AssertableInertia $page) {
            $page->component('NoticeDetails');
        });
    }

    public function rolePermission()
    {
        $roleAdmin = Role::create([
            'name' => 'Admin',
            'description' => 'This is Admin Teacher',
        ]);
        $roleTeacher = Role::create([
            'name' => 'Teacher',
            'description' => 'This is Admin Teacher',
        ]);
        $roleAccountant = Role::create([
            'name' => 'Accountant',
            'description' => 'This is Accountant',
        ]);
        $roleStudent = Role::create([
            'name' => 'Student',
            'description' => 'This is Admin Student',
        ]);
        $permissions = [
            [
                'group_name' => 'Notice Board',
                'permissions' => [
                    'notice-board.index',
                    'notice-board.create',
                    'notice-board.edit',
                    'notice-board.destroy',
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
            'notice-board.index',
            'notice-board.create',
            'notice-board.edit',
            'notice-board.destroy',
        ]);
        $roleTeacher->givePermissionTo([
            'notice-board.index',
        ]);
        $roleStudent->givePermissionTo([
            'notice-board.index',
        ]);
        $roleAccountant->givePermissionTo([
            'notice-board.index',
        ]);
    }
}
