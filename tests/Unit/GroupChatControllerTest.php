<?php

use App\Models\ChatGroup;
use App\Models\ChatGroupConversation;
use App\Models\Subject;
use App\Models\TeacherSubject;
use App\Models\User;
use App\Models\UserCourse;
use App\Notifications\Student\SendNewMessageNotification;
use Database\Seeders\ChatGroupSeeder;
use Database\Seeders\CourseSeeder;
use Database\Seeders\SubjectSeeder;
use Database\Seeders\UserCourseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Notification;
use Inertia\Testing\AssertableInertia;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class GroupChatControllerTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    public function test_group_chat_index_page_for_student()
    {
        // Set up role permissions
        $this->rolePermission();

        // Create a new user with the 'Student' role
        $user = User::factory()->create([
            'role' => 'Student',
        ]);

        // Authenticate the user
        $this->actingAs($user);

        // Seed the necessary data for testing
        $this->seed([CourseSeeder::class, SubjectSeeder::class, ChatGroupSeeder::class]);

        // Create a new UserCourse record for the user and course
        UserCourse::create([
            'user_id' => 1,
            'course_id' => 1,
            'is_passed' => 0,
        ]);

        // Send a GET request to the group chat route
        $response = $this->get(route('group.chat'));

        // Assert that the response has a 200 status code
        $response->assertStatus(200);

        // Assert that the response is an Inertia page with the specified component and data
        $response->assertInertia(function (AssertableInertia $page) {
            $page->component('GroupChat/Index')
                ->tap(function ($page) {
                    $page->has('groups.0');
                });
        });
    }

    public function test_group_chat_index_page_for_teacher()
    {
        // Set up role permissions
        $this->rolePermission();

        // Create a new user with the 'Teacher' role
        $user = User::factory()->create([
            'role' => 'Teacher',
        ]);

        // Authenticate the user
        $this->actingAs($user);

        // Seed the necessary data for testing
        $this->seed(CourseSeeder::class);

        // Create a new subject for the course
        Subject::create(['course_id' => 1, 'name' => 'math']);

        // Associate the subject with the teacher
        TeacherSubject::create(['subject_id' => 1, 'teacher_id' => 1]);

        // Create a new chat group for the subject
        ChatGroup::create(['subject_id' => 1, 'name' => 'math', 'description' => 'This is math']);

        // Create a new UserCourse record for the user and course
        UserCourse::create([
            'user_id' => 1,
            'course_id' => 1,
            'is_passed' => 0,
        ]);

        // Send a GET request to the group chat route
        $response = $this->get(route('group.chat'));

        // Assert that the response has a 200 status code
        $response->assertStatus(200);

        // Assert that the response is an Inertia page with the specified component and data
        $response->assertInertia(function (AssertableInertia $page) {
            $page->component('GroupChat/Index')
                ->tap(function ($page) {
                    $page->has('groups.0');
                });
        });
    }

    public function test_group_new_message_for_student()
    {
        // Set up role permissions
        $this->rolePermission();

        // Create a new user with the 'Student' role
        $user = User::factory()->create([
            'role' => 'Student',
        ]);

        // Create a new user with the 'Teacher' role
        User::factory()->create([
            'role' => 'Teacher',
        ]);

        // Authenticate the student user
        $this->actingAs($user);

        // Seed the necessary data for testing
        $this->seed(CourseSeeder::class);

        // Create a new subject for the course
        Subject::create(['course_id' => 1, 'name' => 'math']);

        // Associate the subject with the teacher
        TeacherSubject::create(['subject_id' => 1, 'teacher_id' => 2]);

        // Create a new chat group for the subject
        ChatGroup::create(['subject_id' => 1, 'name' => 'math', 'description' => 'This is math']);

        // Prepare data for the new message
        $data = [
            'chat_group_id' => 1,
            'sender_user_id' => 1,
            'message' => 'Hello Bangladesh',
        ];

        // Send a POST request to store the new message
        $response = $this->post(route('group.storeMessage'), $data);

        // Assert that the response has a 201 status code
        $response->assertStatus(201);

        // Get the count of chat groups with the 'access' column set to true
        $count = ChatGroup::count('access');

        // Assert that the count is 1
        expect($count)->toBe(1);
    }

    public function test_group_new_message_for_teacher()
    {
        // Set up role permissions
        $this->rolePermission();

        // Create a new user with the 'Teacher' role
        $user = User::factory()->create([
            'role' => 'Teacher',
        ]);

        // Authenticate the teacher user
        $this->actingAs($user);

        // Seed the necessary data for testing
        $this->seed(CourseSeeder::class);

        // Create a new subject for the course
        Subject::create(['course_id' => 1, 'name' => 'math']);

        // Associate the subject with the teacher
        TeacherSubject::create(['subject_id' => 1, 'teacher_id' => 1]);

        // Create a new chat group for the subject
        ChatGroup::create(['subject_id' => 1, 'name' => 'math', 'description' => 'This is math']);

        Notification::fake();
        User::factory()->create(['role' => 'Student']);
        $this->seed(UserCourseSeeder::class);

        // Prepare data for the new message
        $data = [
            'chat_group_id' => 1,
            'sender_user_id' => 1,
            'message' => 'Hello Bangladesh',
        ];

        // Send a POST request to store the new message
        $response = $this->post(route('group.storeMessage'), $data);

        // Assert that the response has a 201 status code
        $response->assertStatus(201);

        // Get the count of chat groups with the 'access' column set to true
        $count = ChatGroup::count('access');

        // Assert that the count is 1
        expect($count)->toBe(1);
    }

    public function test_student_get_new_group_message()
    {
        // Set up role permissions
        $this->rolePermission();

        // Create a new user with the 'Student' role
        $user = User::factory()->create([
            'role' => 'Student',
        ]);

        // Create additional users for testing
        User::factory()->create([
            'role' => 'Student',
        ]);
        User::factory()->create([
            'role' => 'Teacher',
        ]);

        // Authenticate the student user
        $this->actingAs($user);

        // Seed the necessary data for testing
        $this->seed(CourseSeeder::class);

        // Create a new subject for the course
        Subject::create(['course_id' => 1, 'name' => 'Math']);

        // Create a new chat group for the subject
        ChatGroup::create(['subject_id' => 1, 'description' => 1, 'name' => 'Math']);

        // Create a new chat group conversation
        ChatGroupConversation::create([
            'chat_group_id' => 1,
            'sender_user_id' => 1,
            'message' => 'Hello Student 2, I am student 1',
        ]);

        // Send a GET request to retrieve group messages
        $response = $this->get(route('group.messages', 1));

        // Get the message from the response
        $message = $response->original['conversations'][0]['message'];

        // Assert that the retrieved message matches the expected message
        expect($message)->toBe('Hello Student 2, I am student 1');

        // Create a new chat group conversation
        ChatGroupConversation::create([
            'chat_group_id' => 1,
            'sender_user_id' => 2,
            'message' => 'Hello Student 1, I am student 2',
        ]);

        // Send another GET request to retrieve group messages
        $newResponse = $this->get(route('group.messages', 1));

        // Get the message from the new response
        $message = $newResponse->original['conversations'][0]['message'];
    }

    public function test_teacher_get_new_group_message()
    {
        // Set up role permissions
        $this->rolePermission();

        // Create a new user with the 'Teacher' role
        $user = User::factory()->create([
            'role' => 'Teacher',
        ]);

        // Create a new user with the 'Student' role
        User::factory()->create([
            'role' => 'Student',
        ]);

        // Authenticate the teacher user
        $this->actingAs($user);

        // Seed the necessary data for testing
        $this->seed(CourseSeeder::class);

        // Create a new subject for the course
        Subject::create(['course_id' => 1, 'name' => 'Math']);

        // Create a new chat group for the subject
        ChatGroup::create(['subject_id' => 1, 'description' => 1, 'name' => 'Math']);

        // Create a new chat group conversation
        ChatGroupConversation::create([
            'chat_group_id' => 1,
            'sender_user_id' => 2,
            'message' => 'Hello teacher',
        ]);

        // Send a GET request to retrieve group messages
        $response = $this->get(route('group.messages', 1));

        // Get the message from the response
        $message = $response->original['conversations'][0]['message'];

        // Assert that the retrieved message matches the expected message
        expect($message)->toBe('Hello teacher');

        // Create a new chat group conversation
        ChatGroupConversation::create([
            'chat_group_id' => 1,
            'sender_user_id' => 1,
            'message' => 'Hello Student',
        ]);

        // Send another GET request to retrieve group messages
        $response = $this->get(route('group.messages', 1));

        // Get the message from the response
        $message = $response->original['conversations'][0]['message'];
    }

    public function rolePermission()
    {
        $roleTeacher = Role::create([
            'name' => 'Teacher',
            'description' => 'This is Admin Teacher',
        ]);
        $roleStudent = Role::create([
            'name' => 'Student',
            'description' => 'This is Admin Student',
        ]);
        $permissions = [
            [
                'group_name' => 'Academic Management',
                'permissions' => [
                    'group.chat',
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

        $roleTeacher->givePermissionTo([
            'group.chat',
        ]);
        $roleStudent->givePermissionTo([
            'group.chat',
        ]);
    }
}
