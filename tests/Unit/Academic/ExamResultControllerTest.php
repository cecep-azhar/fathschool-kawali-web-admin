<?php

use App\Models\Exam;
use App\Models\User;
use Database\Seeders\CourseSeeder;
use Database\Seeders\ExamSeeder;
use Database\Seeders\GradeSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Inertia\Testing\AssertableInertia;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class ExamResultControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_visit_exam_index_page()
    {
        // Set up role permissions
        $this->rolePermission();

        // Create a new Admin user
        $user = User::factory()->create([
            'role' => 'Admin',
        ]);

        // Authenticate the admin user
        $this->actingAs($user);

        // Seed the necessary data (e.g., GradeSeeder, CourseSeeder, ExamSeeder)
        $this->seed(GradeSeeder::class);
        $this->seed(CourseSeeder::class);
        $this->seed(ExamSeeder::class);

        // Send a GET request to the exam index page
        $response = $this->get(route('exam.index'));

        // Assert that the response has a status code of 200 (OK)
        $response->assertStatus(200);

        // Assert the response using Inertia's assertInertia method
        $response->assertInertia(function (AssertableInertia $page) {
            $page->component('Admin/Exam/Index')
                ->tap(function ($page) {
                    $page->has('exams.data.0');
                    $page->has('courses.0');
                });
        });
    }

    public function test_admin_can_visit_exam_create_page()
    {
        // Set up role permissions
        $this->rolePermission();

        // Create a new Admin user
        $user = User::factory()->create([
            'role' => 'Admin',
        ]);

        // Authenticate the admin user
        $this->actingAs($user);

        // Seed the necessary data (e.g., CourseSeeder)
        $this->seed(CourseSeeder::class);

        // Send a GET request to the exam create page
        $response = $this->get(route('exam.create'));

        // Assert that the response has a status code of 200 (OK)
        $response->assertStatus(200);

        // Assert the response using Inertia's assertInertia method
        $response->assertInertia(function (AssertableInertia $page) {
            $page->component('Admin/Exam/Form')
                ->tap(function ($page) {
                    $page->has('courses.0');
                });
        });
    }

    public function test_admin_can_store_exam()
    {
        // Set up role permissions
        $this->rolePermission();

        // Create a new Admin user
        $user = User::factory()->create([
            'role' => 'Admin',
        ]);

        // Authenticate the admin user
        $this->actingAs($user);

        // Seed the necessary data (e.g., GradeSeeder, CourseSeeder)
        $this->seed(GradeSeeder::class);
        $this->seed(CourseSeeder::class);

        // Prepare the data for the exam
        $data = [
            'name' => 'Final',
            'grade' => 'A+',
            'gpa' => '5.00',

            'start_date' =>   '2023-06-05',
            "end_date"  =>  '2023-06-23',
            'description' => 'Final Exam',
            'course' => 1,
        ];

        // Send a POST request to store the exam
        $response = $this->post(route('exam.store'), $data);

        // Assert that the response has a status code of 302 (Redirect)
        $response->assertStatus(302);

        // Assert that an exam has been created
        expect(Exam::count())->toBe(1);
    }

    public function test_admin_fails_to_store_exam_for_validation()
    {
        // Set up role permissions
        $this->rolePermission();

        // Create a new Admin user
        $user = User::factory()->create([
            'role' => 'Admin',
        ]);

        // Authenticate the admin user
        $this->actingAs($user);

        // Seed the necessary data (e.g., GradeSeeder, CourseSeeder)
        $this->seed(GradeSeeder::class);
        $this->seed(CourseSeeder::class);

        // Prepare empty data for the exam
        $data = [];

        // Send a POST request to store the exam with empty data
        $response = $this->post(route('exam.store'), $data)
            ->assertSessionHasErrors(['name', 'start_date', 'end_date', 'course', 'grade', 'gpa']);

        // Assert that the response has a status code of 302 (Redirect)
        $response->assertStatus(302);

        // Assert that no exam has been created
        expect(Exam::count())->toBe(0);
    }

    public function test_admin_can_update_exams()
    {
        // Set up role permissions
        $this->rolePermission();

        // Create a new Admin user
        $user = User::factory()->create([
            'role' => 'Admin',
        ]);

        // Authenticate the admin user
        $this->actingAs($user);

        // Seed the necessary data (e.g., GradeSeeder, CourseSeeder)
        $this->seed(GradeSeeder::class);
        $this->seed(CourseSeeder::class);

        // Create an exam
        $createData = [
            'name' => 'First',
            'grade' => 'A',
            'gpa' => '4.00',
            'start_date' => '2023-01-05',
            'end_date' => '2023-01-05',
            'description' => 'First Exam',
            'course_id' => 1,
        ];
        Exam::create($createData);

        // Prepare the data for updating the exam
        $data = [
            'name' => 'Final',
            'grade' => 'A+',
            'gpa' => '5.00',
            'start_date' => '2023-01-05',
            'end_date' => '2023-01-05',
            'description' => 'Final Exam',
            'course' => 1,
        ];

        // Send a PUT request to update the exam
        $response = $this->put(route('exam.update', 1), $data);

        // Assert that the response has a status code of 302 (Redirect)
        $response->assertStatus(302);

        // Assert that the exam name has been updated to 'Final'
        expect(Exam::first()->name)->toBe('Final');
    }

    public function test_admin_fails_to_update_exam_for_validation()
    {
        // Set up role permissions
        $this->rolePermission();

        // Create a new Admin user
        $user = User::factory()->create([
            'role' => 'Admin',
        ]);

        // Authenticate the admin user
        $this->actingAs($user);

        // Seed the necessary data (e.g., GradeSeeder, CourseSeeder)
        $this->seed(GradeSeeder::class);
        $this->seed(CourseSeeder::class);

        // Create an exam
        $createData = [
            'name' => 'First',
            'grade' => 'A',
            'gpa' => '4.00',
            'start_date' => '2023-01-05',
            'end_date' => '2023-01-05',
            'description' => 'First Exam',
            'course_id' => 1,
        ];
        Exam::create($createData);

        // Prepare empty data for updating the exam
        $data = [];

        // Send a PUT request to update the exam with empty data
        $response = $this->put(route('exam.update', 1), $data)
            ->assertSessionHasErrors(['name', 'start_date', 'end_date', 'course', 'grade', 'gpa']);

        // Assert that the response has a status code of 302 (Redirect)
        $response->assertStatus(302);
    }

    public function test_admin_can_delete_an_exam()
    {
        // Set up role permissions
        $this->rolePermission();

        // Create a new Admin user
        $user = User::factory()->create([
            'role' => 'Admin',
        ]);

        // Authenticate the admin user
        $this->actingAs($user);

        // Seed the necessary data (e.g., GradeSeeder, CourseSeeder)
        $this->seed(GradeSeeder::class);
        $this->seed(CourseSeeder::class);

        // Create an exam
        $createData = [
            'name' => 'First',
            'grade' => 'A',
            'gpa' => '4.00',
            'start_date' => '2023-01-05',
            'end_date' => '2023-01-05',
            'description' => 'First Exam',
            'course_id' => 1,
        ];
        Exam::create($createData);

        // Send a DELETE request to delete the exam
        $response = $this->delete(route('exam.destroy', 1));

        // Assert that the response has a status code of 302 (Redirect)
        $response->assertStatus(302);

        // Assert that the exam has been deleted
        expect(Exam::count())->toBe(0);
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
