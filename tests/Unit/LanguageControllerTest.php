<?php

use App\Models\Language;
use App\Models\User;
use Database\Seeders\LanguageSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Inertia\Testing\AssertableInertia;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class LanguageControllerTest extends TestCase
{
    use RefreshDatabase;

    //
    //
    //
    //
    //
    //
    //
    //      There seems to be a problem with the JSON file during some testing,
    //       so there are comments written off those specific tests.
    //
    //
    //
    //
    //
    //
    //
    //
    //

    //
    //
    //
    //
    //
    //
    //
    //      There seems to be a problem with the JSON file during some testing,
    //       so there are comments written off those specific tests.
    //
    //
    //
    //
    //
    //
    //
    //
    //

    public function test_admin_can_visit_language_page()
    {
        $this->rolePermission();

        // Create an admin user
        $user = User::factory()->create([
            'role' => 'Admin',
        ]);

        // Act as the admin user
        $this->actingAs($user);

        $this->seed(LanguageSeeder::class);

        // Visit the setting roles index page
        $response = $this->get(route('languages.index'));

        // Assert that the response status is 200 (OK)
        $response->assertStatus(200);

        // Get the inertia page content
        $response->assertInertia(function (AssertableInertia $page) {
            $page->component('Admin/Settings/Language/Index')
                ->tap(function ($page) {
                    $page->has('languages.data.0');
                });
        });
    }

    public function test_admin_can_visit_createLanguage_page()
    {
        $this->rolePermission();

        // Create an admin user
        $user = User::factory()->create([
            'role' => 'Admin',
        ]);

        // Act as the admin user
        $this->actingAs($user);

        // Visit the setting languages create page
        $response = $this->get(route('languages.create'));

        // Get the inertia page content
        $response->assertInertia(function (AssertableInertia $page) {
            $page->component('Admin/Settings/Language/Create')
                ->tap(function ($page) {
                    $page->has('translations');
                });
        });
    }

    public function test_admin_can_store_new_language()
    {
        $this->rolePermission();

        // Create an admin user
        $user = User::factory()->create([
            'role' => 'Admin',
        ]);

        // Act as the admin user
        $this->actingAs($user);

        // Test data
        $data = [
            'name' => 'Bengali',
            'code' => 'af',
            'direction' => 'ltr',
        ];

        // Send a POST request to the store method with data
        $response = $this->post(route('languages.store'), $data);

        // Assert the response status
        $response->assertStatus(302);

        expect(Language::count())->toBe(1);
    }

    public function test_admin_can_visit_language_settings_page()
    {
        $this->rolePermission();

        // Create an admin user
        $user = User::factory()->create([
            'role' => 'Admin',
        ]);

        // Act as the admin user
        $this->actingAs($user);

        $this->seed(LanguageSeeder::class);
        $language = Language::first();

        // Visit the setting languages create page
        $response = $this->get(route('languages.setting', $language->code));

        // Get the inertia page content
        $response->assertInertia(function (AssertableInertia $page) {
            $page->component('Admin/Settings/Language/Show')
                ->tap(function ($page) {
                    $page->has('translations');
                    $page->has('language');
                    $page->has('amount');
                });
        });
    }

    public function test_admin_can_visit_edit_language_page()
    {
        $this->rolePermission();

        // Create an admin user
        $user = User::factory()->create([
            'role' => 'Admin',
        ]);

        // Act as the admin user
        $this->actingAs($user);

        // Seed required data
        $this->seed(LanguageSeeder::class);

        // Visit the setting languages edit page
        $response = $this->get(route('languages.edit', 2));

        $response->assertStatus(200);

        // Get the inertia page content
        $response->assertInertia(function (AssertableInertia $page) {
            $page->component('Admin/Settings/Language/Edit')
                ->tap(function ($page) {
                    $page->has('translations');
                    $page->has('language');
                });
        });
    }

    public function test_admin_fails_to_visit_english_language_edit_page()
    {
        $this->rolePermission();

        // Create an admin user
        $user = User::factory()->create([
            'role' => 'Admin',
        ]);

        // Act as the admin user
        $this->actingAs($user);

        // Seed required data
        $this->seed(LanguageSeeder::class);

        // Visit the languages edit page
        $response = $this->get(route('languages.edit', 1));

        // fails to visit the links and its redirected
        $response->assertStatus(302);
    }

    // public function test_admin_can_update_any_language()
    // {
    //     $this->rolePermission();

    //     // Create an admin user
    //     $user = User::factory()->create([
    //         'role' => 'Admin',
    //     ]);

    //     // Act as the admin user
    //     $this->actingAs($user);

    //     // Seed required data
    //     $this->seed(LanguageSeeder::class);

    //     Language::create([
    //         'name' => "Khati Bangla",
    //         'code' => "KBN",
    //         'direction' => "ltr",
    //     ]);

    //     $data = [
    //         "name" => "Bengali",
    //         "code" => "fn",
    //         "direction" => "ltr"
    //     ];

    //     $response = $this->put(route('languages.update',3),$data);
    //     $response->assertStatus(302);

    //     expect(Language::find(3)->name)->toBe('Bengali');
    // }

    public function test_admin_can_update_validation_check()
    {
        $this->rolePermission();

        // Create an admin user
        $user = User::factory()->create([
            'role' => 'Admin',
        ]);

        // Act as the admin user
        $this->actingAs($user);

        // Seed required data
        $this->seed(LanguageSeeder::class);

        $data = [];

        $response = $this->put(route('languages.update', 2), $data)
            ->assertSessionHasErrors(['name', 'code', 'direction']);

        $response->assertStatus(302);
        expect(Language::find(2)->name)->toBe('Bengali');
    }

    // public function test_admin_can_delete_language()
    // {
    //     $this->rolePermission();

    //     // Create an admin user
    //     $user = User::factory()->create([
    //         'role' => 'Admin',
    //     ]);

    //     // Act as the admin user
    //     $this->actingAs($user);

    //     // Seed required data
    //     $this->seed(LanguageSeeder::class);

    //     $response = $this->delete(route('languages.destroy',3));

    //     $response->assertStatus(302);
    //     expect(Language::count())->toBe(1);
    // }

    // public function test_admin_can_do_language_translation_update()
    // {
    //     $this->rolePermission();

    //     // Create an admin user
    //     $user = User::factory()->create([
    //         'role' => 'Admin',
    //     ]);

    //     // Act as the admin user
    //     $this->actingAs($user);

    //     // Seed required data
    //     $this->seed(LanguageSeeder::class);

    //     $data = [
    //         "translations" => [
    //             "Login" => "Login Hobe?",
    //             "Dashboard" => "Dashboard e Jabo ?",
    //             "Add Transaction" => "Add Transaction korbo?",
    //         ],
    //     ];

    //     $language = Language::find(2);
    //     $response = $this->post(route('translation.update',$language->code),$data);

    //     $response->assertStatus(302);

    // }

    public function rolePermission()
    {
        $roleAdmin = Role::create([
            'name' => 'Admin',
            'description' => 'This is Admin',
        ]);
        $permissions = [
            [
                'group_name' => 'language',
                'permissions' => [
                    'language',
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
            'language',
        ]);
    }
}
