<?php

use App\Mail\AccountCreated;
use App\Mail\AdmissionRequestAccept;
use App\Mail\AdmissionRequestReject;
use App\Models\AdmissionRequest;
use App\Models\Course;
use App\Models\Subject;
use App\Models\User;
use App\Models\UserCourse;
use Database\Seeders\CourseSeeder;
use Database\Seeders\CurrencySeeder;
use Database\Seeders\DepartmentSeeder;
use Database\Seeders\PlanSeeder;
use Database\Seeders\SettingSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Mail;
use Inertia\Testing\AssertableInertia;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class StudentControllerCodeTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test if the admin all student displays correctly.
     *
     * @return void
     */
    public function test_admin_can_visit_all_student_page()
    {
        // Set up the necessary role permission
        $this->rolePermission();

        // Create an admin user
        $user = User::factory()->create([
            'role' => 'Admin',
        ]);

        // Act as the admin user
        $this->actingAs($user);

        // Seed the necessary data (CourseSeeder and DepartmentSeeder)
        $this->seed([CourseSeeder::class, DepartmentSeeder::class]);

        // Create a student and a parent user
        $student = User::factory()->create(['role' => 'Student']);
        $parent = User::factory()->create(['role' => 'Parent']);

        // Associate the parent with the student
        $student->parents()->attach($parent);

        // Check the route
        $response = $this->get(route('student.admission.all'));
        $response->assertStatus(200);

        // Check the view and data
        $response->assertInertia(function (AssertableInertia $page) {
            $page->component('Admin/Admission/AllStudent')
                ->tap(function ($page) {
                    // Check if the necessary data exists
                    $page->has('users.data.0');
                    $page->has('classes.0');
                });
        });
    }

    public function test_admin_can_search_in_all_student_page()
    {
        // Set up the necessary role permission
        $this->rolePermission();

        // Create an admin user
        $user = User::factory()->create([
            'role' => 'Admin',
        ]);

        // Act as the admin user
        $this->actingAs($user);

        // Seed the necessary data (CourseSeeder and DepartmentSeeder)
        $this->seed([CourseSeeder::class, DepartmentSeeder::class]);

        // Create a student and a parent user
        $student = User::factory()->create(['role' => 'Student']);
        $parent = User::factory()->create(['role' => 'Parent']);

        // Associate the parent with the student
        $student->parents()->attach($parent);

        // Check the route

        $response = $this->get('all/students?keyword=o&course=');
        $response->assertStatus(200);

        // Check the view and data
        $response->assertInertia(function (AssertableInertia $page) {
            $page->component('Admin/Admission/AllStudent')
                ->tap(function ($page) {
                    // Check if the necessary data exists
                    $page->has('users');
                    $page->has('classes.0');
                });
        });
    }

    /**
     * Test if the admin index page for student admission displays correctly.
     *
     * @return void
     */
    public function test_admin_can_visit_student_admission_index_page()
    {
        // Set up the necessary role permission
        $this->rolePermission();

        // Create an admin user
        $user = User::factory()->create([
            'role' => 'Admin',
        ]);

        // Act as the admin user
        $this->actingAs($user);

        // Seed the necessary data (CourseSeeder and DepartmentSeeder)
        $this->seed([CourseSeeder::class, DepartmentSeeder::class]);

        // Check the admin index page for student admission
        $response = $this->get(route('student.admission.index'));
        $response->assertStatus(200);
        $response->assertInertia(function (AssertableInertia $page) {
            $page->component('Admin/Admission/Index')
                ->tap(function ($page) {
                    // Check if the necessary data exists
                    $page->has('classes.0');
                    $page->has('departments.0');
                });
        });
    }

    /**
     * Test if an admin can visit the student admission create page.
     *
     * @return void
     */
    public function test_admin_visit_student_admission_create_page()
    {
        // Set up the necessary role permission
        $this->rolePermission();

        // Create an admin user
        $user = User::factory()->create([
            'role' => 'Admin',
        ]);

        // Act as the admin user
        $this->actingAs($user);

        // Insert data into the database (CourseSeeder, DepartmentSeeder, CurrencySeeder, SettingSeeder)
        $this->seed([CourseSeeder::class, DepartmentSeeder::class, CurrencySeeder::class, SettingSeeder::class]);

        // Create two parent users
        User::factory()->count(2)->create([
            'role' => 'Parent',
        ]);

        // Check the route
        $response = $this->get(route('student.admission.create'));
        $response->assertStatus(200);

        // Check the view and data
        $response->assertInertia(function (AssertableInertia $page) {
            $page->component('Admin/Admission/Form')
                ->tap(function ($page) {
                    // Check if the necessary data exists
                    $page->has('all_currencies.0');
                    $page->has('parents.0');
                    $page->has('courses.0');
                    $page->has('app_currency.name');
                });
        });
    }

    public function test_admin_visit_student_admission_edit_page()
    {
        // Set up the necessary role permission
        $this->rolePermission();

        // Create an admin user
        $user = User::factory()->create([
            'role' => 'Admin',
        ]);

        // Act as the admin user
        $this->actingAs($user);

        // Insert data into the database (CourseSeeder, DepartmentSeeder, CurrencySeeder)
        $this->seed([CourseSeeder::class, DepartmentSeeder::class, CurrencySeeder::class]);

        // Seed the settings
        $this->seed(SettingSeeder::class);

        // data insert to subject table
        Subject::create([
            'name' => 'Math',
            'course_id' => 1,
        ]);

        // Create student users
        $student = User::factory()->create([
            'role' => 'Student',
        ]);

        // Create parent users
        User::factory()->create([
            'role' => 'Parent',
        ]);
        $student->parents()->attach(3);

        // Check the route
        $response = $this->get(route('student.admission.edit', 1));
        $response->assertStatus(200);

        // Check the view and data
        $response->assertInertia(function (AssertableInertia $page) {
            $page->component('Admin/Admission/Form')
                ->tap(function ($page) {
                    // Check if the necessary data exists
                    $page->has('all_currencies.0');
                    $page->has('parents.0');
                    $page->has('courses.0');
                    $page->has('app_currency.name');
                    $page->has('user_courses');
                    $page->has('admission_parents');
                });
        });
    }

    /**
     * Test if an admin can visit the student bulk admission page.
     *
     * @return void
     */
    public function test_admin_visit_student_bulk_admission_page()
    {
        // Set up the necessary role permission
        $this->rolePermission();

        // Create an admin user
        $user = User::factory()->create([
            'role' => 'Admin',
        ]);

        // Act as the admin user
        $this->actingAs($user);

        // Insert data into the database (CourseSeeder, DepartmentSeeder, PlanSeeder)
        $this->seed([
            CourseSeeder::class,
            DepartmentSeeder::class,
            CurrencySeeder::class,
            PlanSeeder::class
        ]);

        // Create two parent users
        User::factory()->count(2)->create([
            'role' => 'Parent',
        ]);

        // Check the route
        $response = $this->get(route('student.bulk.admission'));
        $response->assertStatus(200);

        // Check the view and data
        $response->assertInertia(function (AssertableInertia $page) {
            $page->component('Admin/Admission/BulkAdmission')
                ->tap(function ($page) {
                    // Check if the necessary data exists
                    $page->has('departments.0');
                    $page->has('parents.0');
                    $page->has('classes.0');
                    $page->has('plans.0');
                });
        });
    }

    public function test_student_admission_reject()
    {
        // Set up the necessary role permission
        $this->rolePermission();

        // Create an admin user
        $user = User::factory()->create([
            'role' => 'Admin',
        ]);

        // Act as the admin user
        $this->actingAs($user);

        $this->seed([
            CourseSeeder::class,
        ]);
        $data = [
            'name' => 'opu saha',
            'email' => 'sahaapo@gmail.com',
            'profile_photo' => UploadedFile::fake()->create('profile_photo.jpg', 1024),
            'date_of_birth' => '2023-06-13',
            'gender' => 'Male',
            'phone' => '01616657585',
            'address' => 'Block A, Road 12.',
            'national_identification_number' => '1231312',
            'blood_group' => 'A+',
            'physical_disability' => 'no',
            'previous_school_name' => 'ok',
            'previous_school_year_of_exist' => '2022',
            'religion' => 'Sanatan',
            'bank_name' => 'Bangladesh Bank',
            'bank_account_number' => '1231313231',
            'note' => 'Note for admission',
            'guardian_name' => 'Galaxy of Guardian',
            'guardian_email' => 'galaxy@gmail.com',
            'guardian_photo' => UploadedFile::fake()->create('guardian_photo.jpg', 1024),
            'courses' => "['5']",
            'isAccept' => 0,
            'created_at' => '2023-06-12 06:03:37',
            'updated_at' => '2023-06-12 06:03:37',
        ];
        $admissionRequest = AdmissionRequest::create($data);
        Mail::fake();

        $response = $this->delete(route('student.admission.request.reject', 1));
        $response->assertStatus(302);
        expect(AdmissionRequest::count())->toBe(0);

        // Assert that an email of the AdmissionRequestReject class was sent
        // Mail::assertSent(AdmissionRequestReject::class, function ($mail) use ($admissionRequest) {
        //     return $mail->hasTo($admissionRequest->email);
        // });
    }

    public function test_student_admission_approve()
    {
        // Set up the necessary role permission
        $this->rolePermission();

        // Create an admin user
        $user = User::factory()->create([
            'role' => 'Admin',
        ]);

        // Act as the admin user
        $this->actingAs($user);

        $this->seed([
            CourseSeeder::class,
        ]);
        $data = [
            'name' => 'opu saha',
            'email' => 'sahaapo@gmail.com',
            'profile_photo' => UploadedFile::fake()->create('profile_photo.jpg', 1024),
            'date_of_birth' => '2023-06-13',
            'gender' => 'Male',
            'phone' => '01616657585',
            'address' => 'Block A, Road 12.',
            'national_identification_number' => '1231312',
            'blood_group' => 'A+',
            'physical_disability' => 'no',
            'previous_school_name' => 'ok',
            'previous_school_year_of_exist' => '2022',
            'religion' => 'Sanatan',
            'bank_name' => 'Bangladesh Bank',
            'bank_account_number' => '1231313231',
            'note' => 'Note for admission',
            'guardian_name' => 'Galaxy of Guardian',
            'guardian_email' => 'galaxy@gmail.com',
            'guardian_photo' => UploadedFile::fake()->create('guardian_photo.jpg', 1024),
            'courses' => "['5']",
            'isAccept' => 0,
            'created_at' => '2023-06-12 06:03:37',
            'updated_at' => '2023-06-12 06:03:37',
        ];
        $admissionRequest = AdmissionRequest::create($data);
        Mail::fake();

        $response = $this->get(route('student.admission.request.accept', 1));
        $response->assertStatus(302);

        // Assert that an email of the AdmissionRequestReject class was sent
        // Mail::assertSent(AdmissionRequestAccept::class, function ($mail) use ($admissionRequest) {
        //     return $mail->hasTo($admissionRequest->email);
        // });

        // Assert that an email of the AdmissionRequestReject class was sent
        // Mail::assertSent(AccountCreated::class, function ($mail) use ($admissionRequest) {
        //     return $mail->hasTo($admissionRequest->guardian_email);
        // });
    }

    // public function test_student_file_bulk_register()
    // {
    //     $data = [
    //         'file' => UploadedFile::fake()->create('students.xlsx',1024)
    //     ];
    //     $response = $this->post(route('student.file.bulk'),$data);
    //     $response->assertStatus(302);
    //     expect(User::where('role','Student')->count())->toBeGreaterThan(0);
    // }

    public function test_admin_can_promote_student()
    {
        // Set up the necessary role permission
        $this->rolePermission();

        // Create an admin user
        $user = User::factory()->create([
            'role' => 'Admin',
        ]);

        // Act as the admin user
        $this->actingAs($user);

        // Insert data into the database (CourseSeeder & UserFactory)
        $this->seed([CourseSeeder::class]);
        User::factory()->count(20)->create([
            'role' => 'Student',
        ]);

        $response = $this->get(route('student.promotion'));
        $response->assertStatus(200);
        // Check the view and data
        $response->assertInertia(function (AssertableInertia $page) {
            $page->component('Admin/Promotion/Index')
                ->tap(function ($page) {
                    // Check if the necessary data exists
                    $page->has('students.0');
                    $page->has('classes.0');
                });
        });
    }

    public function test_admin_can_post_promote()
    {
        // Set up the necessary role permission
        $this->rolePermission();

        // Create an admin user
        $user = User::factory()->create([
            'role' => 'Admin',
        ]);

        // Act as the admin user
        $this->actingAs($user);

        // Insert data into the database (CourseSeeder & UserFactory)
        Course::create(['name' => 'One']);

        User::factory()->count(3)->create([
            'role' => 'Student',
        ]);

        UserCourse::create(['user_id' => 2, 'course_id' => 1]);
        UserCourse::create(['user_id' => 3, 'course_id' => 1]);
        UserCourse::create(['user_id' => 4, 'course_id' => 1]);

        Course::create(['name' => 'Two']);
        $data = [
            'data' => [
                0 => [
                    'user_id' => 2,
                    'is_passed' => 1,
                    'next_course_status' => 0,
                    'from_course_id' => 1,
                    'to_course_id' => 2,
                ],
                1 => [
                    'user_id' => 3,
                    'is_passed' => 1,
                    'next_course_status' => 0,
                    'from_course_id' => 1,
                    'to_course_id' => 2,
                ],
                2 => [
                    'user_id' => 4,
                    'is_passed' => 1,
                    'next_course_status' => 0,
                    'from_course_id' => 1,
                    'to_course_id' => 2,
                ],
            ],
        ];

        $response = $this->post(route('student.promotion.update'), $data);
        $response->assertStatus(302);
        expect(UserCourse::first()->course_id)->toBe(2);
    }

    public function rolePermission()
    {
        $roleAdmin = Role::create([
            'name' => 'Admin',
            'description' => 'This is Admin',
        ]);
        $permissions = [
            [
                'group_name' => 'admission',
                'permissions' => [
                    'admission.index',
                    'admission.create',
                    'admission.edit',
                    'admission.destroy',
                ],
            ],
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
            'admission.index',
            'admission.create',
            'admission.edit',
            'admission.destroy',
            'student.promotion',
        ]);
    }
}
