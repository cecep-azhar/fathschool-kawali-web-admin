<?php

use App\Models\Holiday;
use App\Models\User;
use Database\Seeders\HolidaySeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Inertia\Testing\AssertableInertia;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class HolidayControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_visit_holiday_index_page()
    {
        $this->rolePermission();

        // Create an admin user
        $user = User::factory()->create([
            'role' => 'Admin',
        ]);

        // Act as the admin user
        $this->actingAs($user);

        $this->seed(HolidaySeeder::class);

        // Visit the user index page
        $response = $this->get(route('holiday.index'));

        // Assert that the response status is 200 (OK)
        $response->assertStatus(200);

        // Assert the inertia page content
        $response->assertInertia(function (AssertableInertia $page) {
            $page->component('Admin/Holiday/Index')
                ->tap(function ($page) {
                    // Assert specific data on the page
                    $page->has('holidays.0');
                });
        });
    }

    public function test_admin_can_record_holiday()
    {
        $this->rolePermission();

        // Create an admin user
        $user = User::factory()->create([
            'role' => 'Admin',
        ]);

        // Act as the admin user
        $this->actingAs($user);

        $data = [
            'name' => 'My Day',
            'date' => [
                0 => '2023-06-07',
                1 => '2023-06-08',
            ],
        ];
        // Visit the user index page
        $response = $this->post(route('holiday.store'), $data);

        // Assert that the response status is 302 (Redirect)
        $response->assertStatus(302);

        // Assert Checking Database value
        expect(Holiday::first()->title)->toBe('My Day');
    }

    public function test_admin_fails_to_record_record_holiday_for_validation()
    {
        $this->rolePermission();

        // Create an admin user
        $user = User::factory()->create([
            'role' => 'Admin',
        ]);

        // Act as the admin user
        $this->actingAs($user);

        $data = [];
        // Visit the user index page
        $response = $this->post(route('holiday.store'), $data)
            ->assertSessionHasErrors(['name', 'date']);

        // Assert that the response status is 302 (REDIRECT)
        $response->assertStatus(302);

        // Assert Checking Database value
        expect(Holiday::count())->toBe(0);
    }

    public function test_admin_can_update_holiday()
    {
        $this->rolePermission();

        // Create an admin user
        $user = User::factory()->create([
            'role' => 'Admin',
        ]);

        // Act as the admin user
        $this->actingAs($user);

        Holiday::create([
            'title' => 'Victory Day',
            'start' => '2023-12-16',
            'end' => '2023-12-16',
        ]);

        $data = [
            'name' => 'Independence Day',
            'date' => [
                0 => '2023-03-26',
                1 => '2023-03-26',
            ],
        ];
        // Visit the user index page
        $response = $this->put(route('holiday.update', 1), $data);

        // Assert that the response status is 302 (Redirect)
        $response->assertStatus(302);

        // Assert Checking Database value
        expect(Holiday::first()->title)->toBe('Independence Day');
    }

    public function test_admin_fails_to_update_holiday_for_validation()
    {
        $this->rolePermission();

        // Create an admin user
        $user = User::factory()->create([
            'role' => 'Admin',
        ]);

        // Act as the admin user
        $this->actingAs($user);

        Holiday::create([
            'title' => 'Victory Day',
            'start' => '2023-12-16',
            'end' => '2023-12-16',
        ]);

        $data = [];
        // Visit the user index page
        $response = $this->put(route('holiday.update', 1), $data)
            ->assertSessionHasErrors(['name', 'date']);

        // Assert that the response status is 302 (Redirect)
        $response->assertStatus(302);

        // Assert Checking Database value
        expect(Holiday::first()->title)->toBe('Victory Day');
    }

    public function test_admin_can_delete_holiday()
    {
        $this->rolePermission();

        // Create an admin user
        $user = User::factory()->create([
            'role' => 'Admin',
        ]);

        // Act as the admin user
        $this->actingAs($user);

        Holiday::create([
            'title' => 'Victory Day',
            'start' => '2023-12-16',
            'end' => '2023-12-16',
        ]);

        // Visit the user index page
        $response = $this->delete(route('holiday.destroy', 1));

        // Assert that the response status is 302 (Redirect)
        $response->assertStatus(302);

        // Assert Checking Database value
        expect(Holiday::count())->toBe(0);
    }

    public function rolePermission()
    {
        $roleAdmin = Role::create([
            'name' => 'Admin',
            'description' => 'This is Admin',
        ]);
        $permissions = [
            [
                'group_name' => 'holiday',
                'permissions' => [
                    'holiday.index',
                    'holiday.create',
                    'holiday.show',
                    'holiday.edit',
                    'holiday.destroy',
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
            'holiday.index',
            'holiday.create',
            'holiday.show',
            'holiday.edit',
            'holiday.destroy',
        ]);
    }
}
