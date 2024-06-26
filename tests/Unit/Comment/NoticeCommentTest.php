<?php

use App\Models\Comment;
use App\Models\Notice;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class NoticeCommentTest extends TestCase
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

    public function test_notice_board_comment_store_as_an_admin()
    {
        // Prepare the test by setting up the user as an admin
        $this->prepareTest('Admin');

        // Get the first notice from the database
        $notice = Notice::first();

        // Prepare the data for creating a new comment
        $data = [
            'notice_id' => $notice->id,
            'description' => 'WOW. Great notice',
        ];

        // Create a new comment using the data
        $response = $this->post(route('comment.store'), $data);

        // Assert that the creation was successful (status code 302 indicates a redirect)
        $response->assertStatus(302);

        // Assert that the comment count in the database is now 1
        $count = Comment::count();
        expect($count)->toBe(1);
    }

    public function test_notice_board_comment_store_validation_checking_for_admin()
    {
        // Prepare the test by setting up the user as an admin
        $this->prepareTest('Admin');

        // Attempt to create a comment with an empty array, which is missing required data
        $response = $this->post(route('comment.store'), [])->assertSessionHasErrors(['notice_id', 'description']);

        // Assert that the creation failed due to validation errors (status code 302 indicates a redirect)
        $response->assertStatus(302);

        // Assert that the comment count in the database is still 0
        $count = Comment::count();
        expect($count)->toBe(0);
    }

    public function test_notice_board_comment_update_as_an_admin()
    {
        // Prepare the test by setting up the user as an admin
        $this->prepareTest('Admin');

        // Create a comment associated with a notice
        Comment::factory()->create([
            'notice_id' => 1,
        ]);

        // Get the first notice and comment from the database
        $notice = Notice::first();
        $comment = Comment::first();

        // Prepare the data for updating the comment
        $data = [
            'user_id' => 1,
            'notice_id' => $notice->id,
            'description' => 'This is a great notice',
        ];

        // Update the comment using the data
        $response = $this->put(route('comment.update', $comment->id), $data);

        // Assert that the update was successful (status code 302 indicates a redirect)
        $response->assertStatus(302);

        // Assert that the comments table in the database has the updated comment
        $this->assertDatabaseHas('comments', [
            'comment' => 'This is a great notice',
        ]);
    }

    public function test_notice_board_comment_update_validation_checking_for_admin()
    {
        // Prepare the test by setting up the user as an admin
        $this->prepareTest('Admin');

        // Create a comment associated with a notice
        Comment::factory()->create([
            'notice_id' => 1,
        ]);

        // Get the first comment from the database
        $comment = Comment::first();

        // Prepare the data for updating the comment with missing required field
        $data = [
            'user_id' => 1,
        ];

        // Attempt to update the comment with missing data, which should fail validation
        $response = $this->put(route('comment.update', $comment->id), $data)->assertSessionHasErrors(['description']);

        // Assert that the update failed due to validation errors (status code 302 indicates a redirect)
        $response->assertStatus(302);

        // Assert that the comments table in the database still has the original comment
        $this->assertDatabaseHas('comments', [
            'comment' => $comment->comment,
        ]);
    }

    public function test_notice_board_comment_delete_for_admin()
    {
        // Prepare the test by setting up the user as an admin
        $this->prepareTest('Admin');

        // Create a comment
        Comment::factory()->create();

        // Get the first comment from the database
        $comment = Comment::first();

        // Delete the comment using its ID
        $response = $this->delete(route('comment.destroy', $comment->id))->assertSessionDoesntHaveErrors();

        // Assert that the deletion was successful (status code 302 indicates a redirect)
        $response->assertStatus(302);

        // Assert that the comment count in the database is now 0
        $count = Comment::count();
        expect($count)->toBe(0);
    }

    public function test_notice_board_comment_store_as_an_accountant()
    {
        // Prepare the test by setting up the user as an accountant
        $this->prepareTest('Accountant');

        // Get the first notice from the database
        $notice = Notice::first();

        // Prepare the data for creating a new comment
        $data = [
            'notice_id' => $notice->id,
            'description' => 'WOW. Great notice',
        ];

        // Create a new comment using the data
        $response = $this->post(route('comment.store'), $data);

        // Assert that the creation was successful (status code 302 indicates a redirect)
        $response->assertStatus(302);

        // Assert that the comment count in the database is now 1
        $count = Comment::count();
        expect($count)->toBe(1);
    }

    public function test_notice_board_comment_store_as_a_student()
    {
        // Prepare the test by setting up the user as a student
        $this->prepareTest('Student');

        // Get the first notice from the database
        $notice = Notice::first();

        // Prepare the data for creating a new comment
        $data = [
            'notice_id' => $notice->id,
            'description' => 'WOW. Great notice',
        ];

        // Create a new comment using the data
        $response = $this->post(route('comment.store'), $data);

        // Assert that the creation was successful (status code 302 indicates a redirect)
        $response->assertStatus(302);

        // Assert that the comment count in the database is now 1
        $count = Comment::count();
        expect($count)->toBe(1);
    }

    public function test_notice_board_comment_store_as_a_teacher()
    {
        // Prepare the test by setting up the user as a teacher
        $this->prepareTest('Teacher');

        // Get the first notice from the database
        $notice = Notice::first();

        // Prepare the data for creating a new comment
        $data = [
            'notice_id' => $notice->id,
            'description' => 'WOW. Great notice',
        ];

        // Create a new comment using the data
        $response = $this->post(route('comment.store'), $data);

        // Assert that the creation was successful (status code 302 indicates a redirect)
        $response->assertStatus(302);

        // Assert that the comment count in the database is now 1
        $count = Comment::count();
        expect($count)->toBe(1);
    }

    public function test_notice_board_comment_store_validation_checking_for_accountant()
    {
        // Prepare the test by setting up the user as an accountant
        $this->prepareTest('Accountant');

        // Attempt to create a new comment with missing data, which should fail validation
        $response = $this->post(route('comment.store'), [])->assertSessionHasErrors(['notice_id', 'description']);

        // Assert that the creation failed due to validation errors (status code 302 indicates a redirect)
        $response->assertStatus(302);

        // Assert that the comment count in the database is still 0
        $count = Comment::count();
        expect($count)->toBe(0);
    }

    public function test_notice_board_comment_store_validation_checking_for_student()
    {
        // Prepare the test by setting up the user as a student
        $this->prepareTest('Student');

        // Attempt to create a new comment with missing data, which should fail validation
        $response = $this->post(route('comment.store'), [])->assertSessionHasErrors(['notice_id', 'description']);

        // Assert that the creation failed due to validation errors (status code 302 indicates a redirect)
        $response->assertStatus(302);

        // Assert that the comment count in the database is still 0
        $count = Comment::count();
        expect($count)->toBe(0);
    }

    public function test_notice_board_comment_store_validation_checking_for_teacher()
    {
        // Prepare the test by setting up the user as a teacher
        $this->prepareTest('Teacher');

        // Attempt to create a new comment with missing data, which should fail validation
        $response = $this->post(route('comment.store'), [])->assertSessionHasErrors(['notice_id', 'description']);

        // Assert that the creation failed due to validation errors (status code 302 indicates a redirect)
        $response->assertStatus(302);

        // Assert that the comment count in the database is still 0
        $count = Comment::count();
        expect($count)->toBe(0);
    }

    public function test_notice_board_comment_update_as_an_accountant()
    {
        // Prepare the test by setting up the user as an accountant
        $this->prepareTest('Accountant');

        // Create a comment with a specified notice_id
        Comment::factory()->create([
            'notice_id' => 1,
        ]);

        // Get the first notice from the database
        $notice = Notice::first();

        // Get the first comment from the database
        $comment = Comment::first();

        // Update the comment with new data
        $data = [
            'user_id' => 1,
            'notice_id' => $notice->id,
            'description' => 'This is a great notice',
        ];
        $response = $this->put(route('comment.update', $comment->id), $data);

        // Assert that the update was successful (status code 302 indicates a redirect)
        $response->assertStatus(302);

        // Assert that the comment in the database has the updated description
        $this->assertDatabaseHas('comments', [
            'comment' => 'This is a great notice',
        ]);
    }

    public function test_notice_board_comment_update_as_a_student()
    {
        // Prepare the test by setting up the user as a student
        $this->prepareTest('Student');

        // Create a comment with a specified notice_id
        Comment::factory()->create([
            'notice_id' => 1,
        ]);

        // Get the first notice from the database
        $notice = Notice::first();

        // Get the first comment from the database
        $comment = Comment::first();

        // Update the comment with new data
        $data = [
            'user_id' => 1,
            'notice_id' => $notice->id,
            'description' => 'This is a great notice',
        ];
        $response = $this->put(route('comment.update', $comment->id), $data);

        // Assert that the update was successful (status code 302 indicates a redirect)
        $response->assertStatus(302);

        // Assert that the comment in the database has the updated description
        $this->assertDatabaseHas('comments', [
            'comment' => 'This is a great notice',
        ]);
    }

    public function test_notice_board_comment_update_as_a_teacher()
    {
        // Prepare the test by setting up the user as a teacher
        $this->prepareTest('Teacher');

        // Create a comment with a specified notice_id
        Comment::factory()->create([
            'notice_id' => 1,
        ]);

        // Get the first notice from the database
        $notice = Notice::first();

        // Get the first comment from the database
        $comment = Comment::first();

        // Update the comment with new data
        $data = [
            'user_id' => 1,
            'notice_id' => $notice->id,
            'description' => 'This is a great notice',
        ];
        $response = $this->put(route('comment.update', $comment->id), $data);

        // Assert that the update was successful (status code 302 indicates a redirect)
        $response->assertStatus(302);

        // Assert that the comment in the database has the updated description
        $this->assertDatabaseHas('comments', [
            'comment' => 'This is a great notice',
        ]);
    }

    public function test_notice_board_comment_update_validation_checking_for_accountant()
    {
        // Prepare the test by setting up the user as an accountant
        $this->prepareTest('Accountant');

        // Create a comment with a specified notice_id
        Comment::factory()->create([
            'notice_id' => 1,
        ]);

        // Get the first comment from the database
        $comment = Comment::first();

        // Define the data for updating the comment (missing the 'description' field)
        $data = [
            'user_id' => 1,
        ];

        // Send the update request and assert that it fails validation (missing 'description' field)
        $response = $this->put(route('comment.update', $comment->id), $data)->assertSessionHasErrors(['description']);
        $response->assertStatus(302);

        // Assert that the comment in the database remains unchanged
        $this->assertDatabaseHas('comments', [
            'comment' => $comment->comment,
        ]);
    }

    public function test_notice_board_comment_update_validation_checking_for_student()
    {
        // Prepare the test by setting up the user as a student
        $this->prepareTest('Student');

        // Create a comment with a specified notice_id
        Comment::factory()->create([
            'notice_id' => 1,
        ]);

        // Get the first comment from the database
        $comment = Comment::first();

        // Define the data for updating the comment (missing the 'description' field)
        $data = [
            'user_id' => 1,
        ];

        // Send the update request and assert that it fails validation (missing 'description' field)
        $response = $this->put(route('comment.update', $comment->id), $data)->assertSessionHasErrors(['description']);
        $response->assertStatus(302);

        // Assert that the comment in the database remains unchanged
        $this->assertDatabaseHas('comments', [
            'comment' => $comment->comment,
        ]);
    }

    public function test_notice_board_comment_update_validation_checking_for_teacher()
    {
        // Prepare the test by setting up the user as a teacher
        $this->prepareTest('Teacher');

        // Create a comment with a specified notice_id
        Comment::factory()->create([
            'notice_id' => 1,
        ]);

        // Get the first comment from the database
        $comment = Comment::first();

        // Define the data for updating the comment (missing the 'description' field)
        $data = [
            'user_id' => 1,
        ];

        // Send the update request and assert that it fails validation (missing 'description' field)
        $response = $this->put(route('comment.update', $comment->id), $data)->assertSessionHasErrors(['description']);
        $response->assertStatus(302);

        // Assert that the comment in the database remains unchanged
        $this->assertDatabaseHas('comments', [
            'comment' => $comment->comment,
        ]);
    }

    public function test_notice_board_comment_delete_for_accountant_role()
    {
        // Prepare the test by setting up the user as an accountant
        $this->prepareTest('Accountant');

        // Create a comment
        Comment::factory()->create();

        // Get the first comment from the database
        $comment = Comment::first();

        // Send the delete request for the comment and assert that it doesn't have any errors
        $response = $this->delete(route('comment.destroy', $comment->id))->assertSessionDoesntHaveErrors();
        $response->assertStatus(302);

        // Assert that the comment has been deleted from the database
        $count = Comment::count();
        expect($count)->toBe(0);
    }

    public function test_notice_board_comment_delete_for_student_role()
    {
        // Prepare the test by setting up the user as a student
        $this->prepareTest('Student');

        // Create a comment
        Comment::factory()->create();

        // Get the first comment from the database
        $comment = Comment::first();

        // Send the delete request for the comment and assert that it doesn't have any errors
        $response = $this->delete(route('comment.destroy', $comment->id))->assertSessionDoesntHaveErrors();
        $response->assertStatus(302);

        // Assert that the comment has been deleted from the database
        $count = Comment::count();
        expect($count)->toBe(0);
    }

    public function test_notice_board_comment_delete_for_teacher_role()
    {
        // Prepare the test by setting up the user as a teacher
        $this->prepareTest('Teacher');

        // Create a comment
        Comment::factory()->create();

        // Get the first comment from the database
        $comment = Comment::first();

        // Send the delete request for the comment and assert that it doesn't have any errors
        $response = $this->delete(route('comment.destroy', $comment->id))->assertSessionDoesntHaveErrors();
        $response->assertStatus(302);

        // Assert that the comment has been deleted from the database
        $count = Comment::count();
        expect($count)->toBe(0);
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
