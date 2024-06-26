<?php

use App\Models\ChatGroup;
use App\Models\Course;
use App\Models\Subject;
use App\Models\User;
use Database\Seeders\CourseSeeder;
use Database\Seeders\SubjectSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Inertia\Testing\AssertableInertia;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class SubjectControllerCodeTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_visit_subject_index_page()
    {
        // Setting up the role permission
        $this->rolePermission();

        // Creating a user with the 'Admin' role
        $user = User::factory()->create([
            'role' => 'Admin',
        ]);

        // Authenticating the user
        $this->actingAs($user);

        // Seeding the Course and Subject data
        $this->seed(CourseSeeder::class);
        $this->seed(SubjectSeeder::class);

        // Sending a GET request to the 'subjects.index' route
        $response = $this->get(route('subjects.index'));

        // Asserting that the response has a status code of 200 (OK)
        $response->assertStatus(200);

        // Asserting the response using the Inertia testing helpers
        $response->assertInertia(function (AssertableInertia $page) {
            // Asserting that the page component is 'Admin/Subject/Index'
            $page->component('Admin/Subject/Index')

                // Using the 'tap' method to perform additional assertions on the page
                ->tap(function ($page) {
                    // Asserting that the page has the 'subjects.data.0' key
                    $page->has('subjects.data.0');

                    // Asserting that the page has the 'classes.0' key
                    $page->has('classes.0');
                });
        });
    }

    public function test_admin_can_search_in_subject_index_page()
    {
        // Setting up the role permission
        $this->rolePermission();

        // Creating a user with the 'Admin' role
        $user = User::factory()->create([
            'role' => 'Admin',
        ]);

        // Authenticating the user
        $this->actingAs($user);

        // Seeding the Course and Subject data
        $this->seed(CourseSeeder::class);
        $this->seed(SubjectSeeder::class);

        // Creating the data for the search query
        $data = [
            'course_id' => '3',
        ];

        // Building the query string
        $queryString = http_build_query($data);

        // Sending a GET request to the 'subjects' route with the query string
        $response = $this->get('subjects?'.$queryString);

        // Asserting that the response has a status code of 200 (OK)
        $response->assertStatus(200);

        // Asserting the response using the Inertia testing helpers
        $response->assertInertia(function (AssertableInertia $page) {
            // Asserting that the page component is 'Admin/Subject/Index'
            $page->component('Admin/Subject/Index')

                // Using the 'tap' method to perform additional assertions on the page
                ->tap(function ($page) {
                    // Asserting that the page has the 'subjects.data' key
                    $page->has('subjects.data');
                });
        });
    }

    public function test_admin_can_store_subject()
    {
        // Setting up the role permission
        $this->rolePermission();

        // Creating a user with the 'Admin' role
        $user = User::factory()->create([
            'role' => 'Admin',
        ]);

        // Authenticating the user
        $this->actingAs($user);

        // Creating a Course record
        Course::create([
            'name' => 'Math',
        ]);

        // Creating the data for the subject
        $data = [
            'class' => 1,
            'name' => 'Programming',
            'color' => '#AD8581',
        ];

        // Sending a POST request to the 'subjects.store' route with the data
        $response = $this->post(route('subjects.store'), $data);

        // Asserting that the response has a status code of 302 (Found/Redirect)
        $response->assertStatus(302);

        // Asserting that there is one Subject record in the database
        expect(Subject::count())->toBe(1);
    }

    public function test_admin_fails_to_store_subject_for_validation()
    {
        // Setting up the role permission
        $this->rolePermission();

        // Creating a user with the 'Admin' role
        $user = User::factory()->create([
            'role' => 'Admin',
        ]);

        // Authenticating the user
        $this->actingAs($user);

        // Creating a Course record
        Course::create([
            'name' => 'Math',
        ]);

        // Creating the data for the subject without the 'name' field
        $data = [
            'class' => 1,
            'color' => '#AD8581',
        ];

        // Sending a POST request to the 'subjects.store' route with the data
        // and asserting that it has validation errors for the 'name' field
        $response = $this->post(route('subjects.store'), $data)->assertSessionHasErrors(['name']);

        // Asserting that there are no Subject records in the database
        expect(Subject::count())->toBe(0);
    }

    public function test_admin_can_update_subjects()
    {
        // Setting up the role permission
        $this->rolePermission();

        // Creating a user with the 'Admin' role
        $user = User::factory()->create([
            'role' => 'Admin',
        ]);

        // Authenticating the user
        $this->actingAs($user);

        // Creating a Course record
        Course::create([
            'name' => 'Programming',
        ]);

        // Creating a Subject record
        Subject::create(['course_id' => 1, 'name' => 'Java']);

        // Creating a ChatGroup record
        ChatGroup::create(['subject_id' => 1, 'name' => 'Java', 'description' => 'Java']);

        // Creating the data for the updated subject
        $data = [
            'course' => 1,
            'name' => 'JavaScript',
            'color' => '#AD8581',
        ];

        // Sending a PUT request to the 'subjects.update' route with the data
        $response = $this->put(route('subjects.update', 1), $data);

        // Asserting that the response has a status code of 302 (Found/Redirect)
        $response->assertStatus(302);

        // Asserting that the name of the Subject record is updated to 'JavaScript'
        expect(Subject::first()->name)->toBe('JavaScript');

        // Asserting that the name of the ChatGroup record is also updated to 'JavaScript'
        expect(ChatGroup::first()->name)->toBe('JavaScript');
    }

    public function test_admin_fails_to_update_subject_for_validation()
    {
        // Setting up the role permission
        $this->rolePermission();

        // Creating a user with the 'Admin' role
        $user = User::factory()->create([
            'role' => 'Admin',
        ]);

        // Authenticating the user
        $this->actingAs($user);

        // Creating a Course record
        Course::create([
            'name' => 'Programming',
        ]);

        // Creating a Subject record
        Subject::create(['course_id' => 1, 'name' => 'Java']);

        // Creating a ChatGroup record
        ChatGroup::create(['subject_id' => 1, 'name' => 'Java', 'description' => 'Java']);

        // Creating the data for the updated subject without the 'name' field
        $data = [
            'course' => 1,
            'color' => '#AD8581',
        ];

        // Sending a PUT request to the 'subjects.update' route with the data
        // and asserting that it has validation errors for the 'name' field
        $response = $this->put(route('subjects.update', 1), $data)->assertSessionHasErrors(['name']);

        // Asserting that the name of the Subject record remains 'Java'
        expect(Subject::first()->name)->toBe('Java');

        // Asserting that the name of the ChatGroup record remains 'Java'
        expect(ChatGroup::first()->name)->toBe('Java');
    }

    public function test_admin_can_delete_a_subject()
    {
        // Setting up the role permission
        $this->rolePermission();

        // Creating a user with the 'Admin' role
        $user = User::factory()->create([
            'role' => 'Admin',
        ]);

        // Authenticating the user
        $this->actingAs($user);

        // Creating a Course record
        Course::create([
            'name' => 'Programming',
        ]);

        // Creating a Subject record
        Subject::create(['course_id' => 1, 'name' => 'Java']);

        // Sending a DELETE request to the 'subjects.destroy' route for the subject with ID 1
        $response = $this->delete(route('subjects.destroy', 1));

        // Asserting that the response has a status code of 302 (Found/Redirect)
        $response->assertStatus(302);

        // Asserting that the Subject record is deleted (count is 0)
        expect(Subject::count())->toBe(0);
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
