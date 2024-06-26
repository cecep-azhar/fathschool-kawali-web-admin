<?php

use App\Models\Subject;
use App\Models\Syllabus;
use App\Models\TeacherSubject;
use App\Models\User;
use Database\Seeders\CourseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Inertia\Testing\AssertableInertia;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class SyllabusControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_teachers_syllabus_index_page()
    {
        // Set up role permissions
        $this->rolePermission();

        // Create a new Teacher user
        $user = User::factory()->create([
            'role' => 'Teacher',
        ]);

        // Authenticate the teacher user
        $this->actingAs($user);

        // Seed the Course table
        $this->seed(CourseSeeder::class);

        // Create a subject and associate it with the course
        Subject::create(['course_id' => 1, 'name' => 'math']);

        // Associate the subject with the teacher
        TeacherSubject::create(['subject_id' => 1, 'teacher_id' => 1]);

        // Create a syllabus for the teacher, course, and subject
        Syllabus::create(['user_id' => 1, 'course_id' => 1, 'subject_id' => 1]);

        // Make a GET request to the syllabus index page
        $response = $this->get(route('syllabus.index'));

        // Assert that the response has a status code of 200 (OK)
        $response->assertStatus(200);

        // Assert the inertia component and data
        $response->assertInertia(function (AssertableInertia $page) {
            $page->component('Teacher/Syllabus')->tap(function ($page) {
                $page->has('syllabuses.data.0');
                $page->has('classes.0');
                $page->has('subjects.0');
                $page->missing('filter_data.0');
            });
        });
    }

    public function test_teachers_syllabus_search_in_index_page()
    {
        // Set up role permissions
        $this->rolePermission();

        // Create a new Teacher user
        $user = User::factory()->create([
            'role' => 'Teacher',
        ]);

        // Authenticate the teacher user
        $this->actingAs($user);

        // Seed the Course table
        $this->seed(CourseSeeder::class);

        // Create a subject and associate it with the course
        Subject::create(['course_id' => 1, 'name' => 'math']);

        // Associate the subject with the teacher
        TeacherSubject::create(['subject_id' => 1, 'teacher_id' => 1]);

        // Create a syllabus for the teacher, course, and subject
        Syllabus::create(['user_id' => 1, 'course_id' => 1, 'subject_id' => 1]);

        // Define the search data
        $data = [
            'title' => 'math',
            'class' => 'one',
            'subject' => null,
        ];

        // Build the query string from the search data
        $queryString = http_build_query($data);

        // Make a GET request to the syllabus index page with the query string
        $response = $this->get('syllabus'.'?'.$queryString);

        // Assert that the response has a status code of 200 (OK)
        $response->assertStatus(200);

        // Assert the inertia component and data
        $response->assertInertia(function (AssertableInertia $page) {
            $page->component('Teacher/Syllabus')->tap(function ($page) {
                $page->has('syllabuses.data.0');
                $page->has('classes.0');
                $page->has('subjects.0');
                $page->missing('filter_data.0');
            });
        });
    }

    public function test_teachers_can_record_new_syllabus()
    {
        // Set up role permissions
        $this->rolePermission();

        // Create a new Teacher user
        $user = User::factory()->create([
            'role' => 'Teacher',
        ]);

        // Authenticate the teacher user
        $this->actingAs($user);

        // Seed the Course table
        $this->seed(CourseSeeder::class);

        // Create a subject and associate it with the course
        Subject::create(['course_id' => 1, 'name' => 'math']);

        // Associate the subject with the teacher
        TeacherSubject::create(['subject_id' => 1, 'teacher_id' => 1]);

        // Define the data for creating a syllabus
        $data = [
            'teacher' => 1,
            'subject' => 1,
            'class' => 1,
            'syllabus' => UploadedFile::fake()->create('fake.jpg', 1024),
        ];

        // Make a POST request to store the syllabus
        $response = $this->post(route('syllabus.store'), $data);

        // Assert that the response has a status code of 302 (Redirect)
        $response->assertStatus(302);

        // Assert that a new syllabus has been created
        expect(Syllabus::count())->toBe(1);
    }

    public function test_teachers_fails_to_record_new_syllabus_for_validation()
    {
        // Set up role permissions
        $this->rolePermission();

        // Create a new Teacher user
        $user = User::factory()->create([
            'role' => 'Teacher',
        ]);

        // Authenticate the teacher user
        $this->actingAs($user);

        // Seed the Course table
        $this->seed(CourseSeeder::class);

        // Create a subject and associate it with the course
        Subject::create(['course_id' => 1, 'name' => 'math']);

        // Associate the subject with the teacher
        TeacherSubject::create(['subject_id' => 1, 'teacher_id' => 1]);

        // Define invalid data for creating a syllabus
        $data = [
            'teacher' => 1,
            'subject' => '',
            'class' => '',
            'syllabus' => '',
        ];

        // Make a POST request to store the syllabus and assert validation errors
        $response = $this->post(route('syllabus.store'), $data)
            ->assertSessionHasErrors(['subject', 'class', 'syllabus']);

        // Assert that the response has a status code of 302 (Redirect)
        $response->assertStatus(302);

        // Assert that no syllabus has been created
        expect(Syllabus::count())->toBe(0);
    }

    public function test_teachers_can_update_old_syllabus()
    {
        // Set up role permissions
        $this->rolePermission();

        // Create a new Teacher user
        $user = User::factory()->create([
            'role' => 'Teacher',
        ]);

        // Authenticate the teacher user
        $this->actingAs($user);

        // Seed the Course table
        $this->seed(CourseSeeder::class);

        // Create a subject and associate it with the course
        Subject::create(['course_id' => 1, 'name' => 'math']);

        // Associate the subject with the teacher
        TeacherSubject::create(['subject_id' => 1, 'teacher_id' => 1]);

        // Create an existing syllabus
        Syllabus::create(['user_id' => 1, 'course_id' => 1, 'subject_id' => 1]);

        // Define the data for updating the syllabus
        $data = [
            'teacher' => 1,
            'subject' => 1,
            'class' => 1,
            'syllabus' => UploadedFile::fake()->create('fake.jpg', 1024),
        ];

        // Make a PUT request to update the syllabus
        $response = $this->put(route('syllabus.update', 1), $data);

        // Assert that the response has a status code of 302 (Redirect)
        $response->assertStatus(302);

        // Assert that the syllabus has been updated
        expect(Syllabus::count())->toBe(1);
    }

    public function test_teachers_fails_to_update_old_syllabus_for_validation()
    {
        // Set up role permissions
        $this->rolePermission();

        // Create a new Teacher user
        $user = User::factory()->create([
            'role' => 'Teacher',
        ]);

        // Authenticate the teacher user
        $this->actingAs($user);

        // Seed the Course table
        $this->seed(CourseSeeder::class);

        // Create a subject and associate it with the course
        Subject::create(['course_id' => 1, 'name' => 'math']);

        // Associate the subject with the teacher
        TeacherSubject::create(['subject_id' => 1, 'teacher_id' => 1]);

        // Create an existing syllabus
        Syllabus::create(['user_id' => 1, 'course_id' => 1, 'subject_id' => 1]);

        // Define invalid data for updating the syllabus
        $data = [
            'teacher' => 1,
            'subject' => '',
            'class' => '',
            'syllabus' => '',
        ];

        // Make a PUT request to update the syllabus and assert validation errors
        $response = $this->put(route('syllabus.update', 1), $data)
            ->assertSessionHasErrors(['subject', 'class']);

        // Assert that the syllabus has not been updated
        expect(Syllabus::count())->toBe(1);

        // Assert that the original syllabus data is still in the database
        $this->assertDatabaseHas('syllabi', [
            'course_id' => 1,
        ]);
    }

    public function test_teachers_can_delete_syllabus()
    {
        // Set up role permissions
        $this->rolePermission();

        // Create a new Teacher user
        $user = User::factory()->create([
            'role' => 'Teacher',
        ]);

        // Authenticate the teacher user
        $this->actingAs($user);

        // Seed the Course table
        $this->seed(CourseSeeder::class);

        // Create a subject and associate it with the course
        Subject::create(['course_id' => 1, 'name' => 'math']);

        // Associate the subject with the teacher
        TeacherSubject::create(['subject_id' => 1, 'teacher_id' => 1]);

        // Create an existing syllabus
        Syllabus::create(['user_id' => 1, 'course_id' => 1, 'subject_id' => 1]);

        // Make a DELETE request to delete the syllabus
        $response = $this->delete(route('syllabus.destroy', 1));

        // Assert that the response has a status code of 302 (Redirect)
        $response->assertStatus(302);

        // Assert that the syllabus has been deleted
        expect(Syllabus::count())->toBe(0);
    }

    public function rolePermission()
    {
        // Create Teacher role
        $roleTeacher = Role::create([
            'name' => 'Teacher',
            'description' => 'This is Teacher',
        ]);

        // Define permissions for syllabus management
        $teacherPermissions = [
            [
                'group_name' => 'syllabus',
                'permissions' => [
                    'syllabus.index',
                    'syllabus.create',
                    'syllabus.store',
                    'syllabus.show',
                    'syllabus.edit',
                    'syllabus.update',
                    'syllabus.destroy',
                ],
            ],
        ];

        // Assign permissions to the Teacher role
        foreach ($teacherPermissions as $permissionGroup) {
            $groupName = $permissionGroup['group_name'];

            foreach ($permissionGroup['permissions'] as $permissionName) {
                // Create Permission
                $permission = Permission::create([
                    'name' => $permissionName,
                    'group_name' => $groupName,
                ]);

                // Assign permission to the Teacher role
                $roleTeacher->givePermissionTo($permission);
            }
        }
    }
}
