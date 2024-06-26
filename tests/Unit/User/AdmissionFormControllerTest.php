<?php

use App\Models\AdmissionFormField;
use App\Models\User;
use App\Notifications\UserAccountSetPasswordNotification;
use Database\Seeders\AdmissionFormSeeder;
use Database\Seeders\CourseSeeder;
use Database\Seeders\CurrencySeeder;
use Database\Seeders\PlanSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Notification;
use Inertia\Testing\AssertableInertia;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class AdmissionFormControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_visit_user_index_page()
    {
        $this->rolePermission();

        // Create an admin user
        $user = User::factory()->create([
            'role' => 'Admin',
        ]);

        // Act as the admin user
        $this->actingAs($user);

        // Create 50 users
        User::factory()->count(50)->create();

        // Visit the user index page
        $response = $this->get(route('users.index'));

        // Assert that the response status is 200 (OK)
        $response->assertStatus(200);

        // Assert the inertia page content
        $response->assertInertia(function (AssertableInertia $page) {
            $page->component('Admin/User/Index')
                ->tap(function ($page) {
                    // Assert specific data on the page
                    $page->has('users.data.0');
                    $page->has('admins');
                    $page->has('parents');
                    $page->has('students');
                    $page->has('teachers');
                });
        });
    }

    public function test_admin_can_search_in_user_index_page()
    {
        $this->rolePermission();

        // Create an admin user
        $user = User::factory()->create([
            'role' => 'Admin',
        ]);

        // Act as the admin user
        $this->actingAs($user);

        // Create 50 users
        User::factory()->count(1)->create(['role' => 'Admin']);
        User::factory()->count(5)->create(['role' => 'Student', 'name' => 'Shahabuddin Chuppu']);
        User::factory()->count(1)->create(['role' => 'Teacher']);
        User::factory()->count(2)->create(['role' => 'Accountant']);
        User::factory()->count(3)->create(['role' => 'Parent']);

        $data = [
            'keyword' => 'Shahabuddin',
            'query' => 'Student',

        ];
        $queryString = http_build_query($data);

        // Visit the user index page
        $response = $this->get('users?' . $queryString);

        // Assert that the response status is 200 (OK)
        $response->assertStatus(200);

        // Assert the inertia page content
        $response->assertInertia(function (AssertableInertia $page) {
            $page->component('Admin/User/Index')
                ->tap(function ($page) {
                    // Assert specific data on the page
                    $page->has('users.data.4');
                    $page->missing('users.data.5');
                    $page->has('admins');
                    $page->has('parents');
                    $page->has('students');
                    $page->has('teachers');
                });
        });
    }

    public function test_admin_can_visit_user_create_page()
    {
        $this->rolePermission();

        // Create an admin user
        $user = User::factory()->create([
            'role' => 'Admin',
        ]);

        // Act as the admin user
        $this->actingAs($user);

        // Create additional roles
        Role::create([
            'name' => 'Teacher',
            'description' => 'This is Admin',
        ]);
        Role::create([
            'name' => 'Accountant',
            'description' => 'This is Accountant',
        ]);
        Role::create([
            'name' => 'Parent',
            'description' => 'This is Parent',
        ]);

        // Seed necessary data (e.g., courses and plans)
        $this->seed([
            CourseSeeder::class,
            CurrencySeeder::class,
            PlanSeeder::class
        ]);

        // Visit the user create page
        $response = $this->get(route('users.create'));

        // Assert that the response status is 200 (OK)
        $response->assertStatus(200);

        // Assert the inertia page content
        $response->assertInertia(function (AssertableInertia $page) {
            $page->component('Admin/User/Create')
                ->tap(function ($page) {
                    // Assert specific data on the page
                    $page->has('roles.0');
                    $page->has('plans.0');
                });
        });
    }

    public function test_admin_can_store_user()
    {
        $this->rolePermission();

        // Create an admin user
        $user = User::factory()->create([
            'role' => 'Admin',
        ]);

        // Act as the admin user
        $this->actingAs($user);

        // Create additional roles
        Role::create([
            'name' => 'Teacher',
            'description' => 'This is Admin',
        ]);
        Role::create([
            'name' => 'Accountant',
            'description' => 'This is Accountant',
        ]);
        Role::create([
            'name' => 'Parent',
            'description' => 'This is Parent',
        ]);

        // Seed necessary data (e.g., courses and plans)
        $this->seed([
            CourseSeeder::class,
            CurrencySeeder::class,
            PlanSeeder::class
        ]);

        // Fake notifications
        Notification::fake();

        // Create additional roles
        $data = [
            'name' => 'opu saha',
            'email' => 'newadmin@mail.com',
            'password' => 'password',
            'password_confirmation' => null,
            'user_type' => 'Admin',
            'parent' => null,
            'plan' => null,
        ];

        // Hit the user store function with request data
        $response = $this->post(route('users.store'), $data);

        // Assert that the response status is 302 (redirect)
        $response->assertStatus(302);

        // Expecting the database value
        expect(User::where('name', 'opu saha')->count())->toBe(1);

        // Get the created user from the database
        $user = User::where('email', 'newadmin@mail.com')->first();

        // Assert notification sent to the user
        // Notification::assertSentTo($user, UserAccountSetPasswordNotification::class);
    }

    public function test_admin_can_update_user()
    {
        $this->rolePermission();

        // Create an admin user
        $user = User::factory()->create([
            'role' => 'Admin',
        ]);

        // Act as the admin user
        $this->actingAs($user);

        // Create additional roles
        Role::create([
            'name' => 'Parent',
            'description' => 'This is Parent',
        ]);

        // create new user as parent
        User::factory()->create(['role' => 'Parent']);

        // Fake notifications
        Notification::fake();

        // Create additional roles
        $data = [
            'name' => 'Opu Saha',
            'email' => 'parent@example.com',
            'password' => '12345678',
            'password_confirmation' => '12345678',
            'user_type' => 'Parent',
            'avatar' => UploadedFile::fake()->create('avatar.png', 1024),
            'phone' => '01644339012',
            'address' => '13/4A, Block-B, 1207 Babar Rd, Dhaka 1207',
            'teacher_edit' => false,
        ];

        // Hit the user store function with request data
        $response = $this->put(route('users.update', 2), $data);

        // Assert that the response status is 302 (redirect)
        $response->assertStatus(302);

        // Expecting the database value
        expect(User::where('name', 'Opu Saha')->first()->email)->toBe('parent@example.com');
        expect(User::where('name', 'Opu Saha')->first()->address)->toBe('13/4A, Block-B, 1207 Babar Rd, Dhaka 1207');
    }

    public function test_admin_can_visit_admission_form_field_page()
    {
        // Set up the necessary role permission
        $this->rolePermission();

        // Create an admin user
        $user = User::factory()->create([
            'role' => 'Admin',
        ]);

        // Act as the admin user
        $this->actingAs($user);

        $this->seed([AdmissionFormSeeder::class, CourseSeeder::class]);
        $response = $this->get('admission/form');
        $response->assertStatus(200);
        $response->assertInertia(function (AssertableInertia $page) {
            $page->component('Admin/AdmissionForm/Index')
                ->tap(function ($page) {
                    $page->has('fields.0');
                    $page->has('active_fields.0');
                    $page->has('courses.0');
                });
        });
    }

    public function test_admin_can_visit_admission_form_field_status_change()
    {
        // Set up the necessary role permission
        $this->rolePermission();

        // Create an admin user
        $user = User::factory()->create([
            'role' => 'Admin',
        ]);

        // Act as the admin user
        $this->actingAs($user);

        $this->seed([AdmissionFormSeeder::class, CourseSeeder::class]);
        $field = AdmissionFormField::first();
        $data = ['value' => false];
        $response = $this->post(route('form.status.change', $field->id), $data);
        $response->assertStatus(302);
        expect(AdmissionFormField::first()->status)->toBe(0);
    }

    public function rolePermission()
    {
        //  Create roles
        $roleSuperAdmin = Role::create([
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
                $permission = Permission::create([
                    'name' => $permissions[$i]['permissions'][$j],
                    'group_name' => $permissionGroup,
                ]);
            }
        }

        $roleSuperAdmin->givePermissionTo([
            'admission.form',
            'users.index',
            'users.create',
            'users.show',
            'users.edit',
            'users.destroy',
        ]);
    }
}
