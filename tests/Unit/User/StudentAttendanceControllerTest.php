<?php

use App\Models\StudentAttendance;
use App\Models\TeacherSubject;
use App\Models\User;
use Database\Seeders\CourseSeeder;
use Database\Seeders\SubjectSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Inertia\Testing\AssertableInertia;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class StudentAttendanceControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_teacher_can_visit_attendance_page()
    {
        $this->rolePermission();

        // Create an admin user
        $user = User::factory()->create([
            'role' => 'Teacher',
        ]);

        // Act as the admin user
        $this->actingAs($user);

        // Visit the user index page
        $response = $this->get(route('student.attendance.index'));

        // Assert that the response status is 200 (OK)
        $response->assertStatus(200);
    }

    public function test_user_can_store_new_attendance()
    {
        $this->rolePermission();

        // Create an admin user
        $user = User::factory()->create([
            'role' => 'Teacher',
        ]);

        // Act as the admin user
        $this->actingAs($user);

        $this->seed([CourseSeeder::class, SubjectSeeder::class]);

        TeacherSubject::create(['teacher_id' => 1, 'subject_id' => 1]);
        // Create 3 users as student
        User::factory()->count(3)->create([
            'role' => 'Student',
        ]);

        // Prepare data
        $data = [
            'student' => 3,
            "status" => "present",
            "late_amount" => null,
            "subject" => "1",
            "date" => "2023-09-19",
        ];

        // Visit the user index page
        $response = $this->post(route('student.attendance.store'), $data);

        // Assert that the response status is 302 (Redirect)
        $response->assertStatus(302);
        expect(StudentAttendance::count())->toBe(1);
    }

    public function rolePermission()
    {
        $roleTeacher = Role::create([
            'name' => 'Teacher',
            'description' => 'This is Teacher',
        ]);
        $permissions = [
            [
                'group_name' => 'attendance',
                'permissions' => [
                    'attendance.index',
                    'attendance.create',
                    'attendance.edit',
                    'attendance.destroy',
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
            'attendance.create',
        ]);
    }
}
