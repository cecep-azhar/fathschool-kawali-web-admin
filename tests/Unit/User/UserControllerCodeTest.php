<?php

use App\Models\Course;
use App\Models\User;
use App\Notifications\StudentAdmissionNotification;
use App\Notifications\UserAccountSetPasswordNotification;
use Database\Seeders\CurrencySeeder;
use Database\Seeders\DepartmentSeeder;
use Database\Seeders\PlanSeeder;
use Database\Seeders\SubjectSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Notification;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class UserControllerCodeTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_record_new_student_data()
    {
        // Set up the necessary role permission
        $this->rolePermission();

        // Create an admin user
        $user = User::factory()->create([
            'role' => 'Admin',
        ]);

        $this->actingAs($user);

        // Create a parent user
        User::factory()->create([
            'role' => 'Parent',
        ]);

        // Create a course
        Course::create([
            'name' => 'one',
            'has_multiple_subject' => 0,
        ]);

        // Seed required data (plans and currencies)
        $this->seed([
            CurrencySeeder::class,
            PlanSeeder::class
        ]);

        // Prepare the data for the new student
        $data = [
            'admission' => true,
            'name' => 'opu saha',
            'email' => 'sahaapo@gmail.com',
            'user_type' => 'Student',
            'parents' => [
                0 => 1,
            ],
            'courses' => [
                0 => 1,
            ],
            'plan' => 1,
            'date_of_birth' => '07-06-2013',
        ];

        // Disable notifications for testing purposes
        Notification::fake();

        // Send a POST request to store the new student data
        $response = $this->post(route('users.store'), $data);

        // Assert that the response status is 302 (redirect)
        $response->assertStatus(302);

        // Assert that the count of users with the role 'Student' is now 1
        expect(User::where('role', 'Student')->count())->toBe(1);

        // Assert that a StudentAdmissionNotification was sent to the user with ID 3 (assuming ID 3 is the Student's ID)
        // Notification::assertSentTo(
        //     User::find(3),
        //     StudentAdmissionNotification::class
        // );

    }

    public function test_admin_can_record_new_teacher()
    {
        // Set up the necessary role permission
        $this->rolePermission();

        // Create an admin user
        $user = User::factory()->create([
            'role' => 'Admin',
        ]);

        $this->actingAs($user);

        // Create a new role for teachers
        Role::create([
            'name' => 'Teacher',
            'description' => 'This is Teacher',
        ]);

        // Create a course
        Course::create([
            'name' => 'one',
            'has_multiple_subject' => 0,
        ]);

        // Seed subjects and departments
        $this->seed([SubjectSeeder::class, DepartmentSeeder::class]);

        // Disable notifications for testing
        Notification::fake();

        // Prepare the data for creating a new teacher
        $data = [
            'name' => 'Opu Saha',
            'email' => 'sahaapo@gmail.com',
            'user_type' => 'Teacher',
            'phone' => '01616657585',
            'address' => 'Narsingdi',
            'gender' => 'Male',
            'department' => 2,
            'date_of_birth' => '08-06-2023',
            'documents' => [
                0 => UploadedFile::fake()->create('document_one.png', 1024),
                1 => UploadedFile::fake()->create('document_two.png', 1024),
            ],
            'document_titles' => [
                0 => 'one',
                1 => 'Two',
            ],
            'highest_degree_name' => 'MBA',
            'institute_name' => 'National University',
            'passing_year' => '2022',
            'religion' => 'Sanatan',
            'nationality' => 'Bangladeshi',
            'subjects' => [
                0 => 1,
                1 => 2,
                2 => 3,
                3 => 4,
                4 => 5,
                5 => 6,
                6 => 7,
                7 => 8,
            ],
        ];

        // Send a POST request to the 'users.store' route with the data
        $response = $this->post(route('users.store'), $data);

        // Assert that the response has a status code of 302 (redirect)
        $response->assertStatus(302);

        // Expect that the name of the newly created user is "Opu Saha"
        expect(User::find(2)->name)->toBe('Opu Saha');

        // Get the created user from the database
        $user = User::where('email', 'sahaapo@gmail.com')->first();

        // Assert that a notification has been sent to the user
        // Notification::assertSentTo($user, UserAccountSetPasswordNotification::class);
    }

    public function test_admin_can_update_teacher()
    {
        // Set up the necessary role permission
        $this->rolePermission();

        // Create an admin user
        $user = User::factory()->create([
            'role' => 'Admin',
        ]);

        $this->actingAs($user);

        // Create a new role for Teacher
        Role::create([
            'name' => 'Teacher',
            'description' => 'This is Teacher',
        ]);

        // Create a new course
        Course::create([
            'name' => 'one',
            'has_multiple_subject' => 0,
        ]);

        // Seed the database with subject and department data
        $this->seed([SubjectSeeder::class, DepartmentSeeder::class]);

        // Create a new teacher user
        User::factory()->create(['role' => 'teacher']);

        $data = [
            'name' => 'Opu Saha',
            'email' => 'sahaapo@gmail.com',
            'user_type' => 'Teacher',
            'phone' => '01616657585',
            'address' => 'Narsingdi',
            'gender' => 'Male',
            'department' => 2,
            'date_of_birth' => '08-06-2023',
            'documents' => [
                0 => UploadedFile::fake()->create('document_one.png', 1024),
                1 => UploadedFile::fake()->create('document_two.png', 1024),
            ],
            'document_titles' => [
                0 => 'one',
                1 => 'Two',
            ],
            'highest_degree_name' => 'MBA',
            'institute_name' => 'National University',
            'passing_year' => '2022',
            'religion' => 'Sanatan',
            'nationality' => 'Bangladeshi',
            'subjects' => [
                0 => 1,
                1 => 2,
                2 => 3,
                3 => 4,
                4 => 5,
                5 => 6,
                6 => 7,
                7 => 8,
            ],
        ];

        // Update the teacher user
        $response = $this->put(route('users.update', 2), $data);

        // Assert that the response status is 302 (redirect)
        $response->assertStatus(302);

        // Assert that the name of the user with ID 2 is now "Opu Saha"
        expect(User::find(2)->name)->toBe('Opu Saha');
    }

    public function rolePermission()
    {
        $roleAdmin = Role::create([
            'name' => 'Admin',
            'description' => 'This is Admin',
        ]);
        $permissions = [
            [
                'group_name' => 'users',
                'permissions' => [
                    'users.index',
                    'users.create',
                    'users.show',
                    'users.edit',
                    'users.destroy',
                    'student.promotion',
                    'admission.form',
                    'teacher.list',
                    'student.list',
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
            'users.index',
            'users.create',
            'users.show',
            'users.edit',
            'users.destroy',
            'student.promotion',
            'admission.form',
            'teacher.list',
            'student.list',
        ]);
    }
}
