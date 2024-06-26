<?php

use App\Models\Event;
use App\Models\User;
use Carbon\Carbon;
use Database\Seeders\EventSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Inertia\Testing\AssertableInertia;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class EventControllerTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    public function setUp(): void
    {
        parent::setUp();
        $this->rolePermission();
    }

    public function test_admin_can_visit_event_index_page()
    {
        // Create an admin user
        $user = User::factory()->create([
            'role' => 'Admin',
        ]);

        // Authenticate the user
        $this->actingAs($user);

        // Seed the events
        $this->seed(EventSeeder::class);

        // Send a GET request to the event index page and assert the response
        $response = $this->get(route('event.index'));
        $response->assertStatus(200);
        $response->assertInertia(function (AssertableInertia $page) {
            $page->component('Admin/Event/Index')
                ->tap(function ($page) {
                    $page->has('all_events.data.0');
                });
        });
    }

    public function test_admin_can_record_new_event()
    {
        // Create an admin user
        $user = User::factory()->create([
            'role' => 'Admin',
        ]);

        // Authenticate the user
        $this->actingAs($user);

        // Data for creating a new event
        $data = [
            'name' => 'Independence Day',
            'date' => [
                0 => '2023-03-26',
                1 => '2023-03-26',
            ],
            'color' => '#fff',
        ];

        // Send a POST request to create a new event and assert the response
        $response = $this->post(route('event.store'), $data);
        $response->assertStatus(302);

        // Assert that the event has been created in the database
        expect(Event::count())->toBe(1);
        expect(Event::first()->title)->toBe('Independence Day');
    }

    public function test_admin_check_event_store_validation()
    {
        // Create an admin user
        $user = User::factory()->create([
            'role' => 'Admin',
        ]);

        // Authenticate the user
        $this->actingAs($user);

        // Send a POST request to create a new event without providing required data and assert the response
        $response = $this->post(route('event.store'), [])
            ->assertSessionHasErrors(['name', 'date']);
        $response->assertStatus(302);

        // Assert that no event has been created in the database
        expect(Event::count())->toBe(0);
    }

    public function test_admin_can_update_event()
    {
        // Create an admin user
        $user = User::factory()->create([
            'role' => 'Admin',
        ]);

        // Authenticate the user
        $this->actingAs($user);

        // Create an event
        Event::create([
            'title' => 'Ekla Boishakh',
            'color' => '#fff',
            'start' => Carbon::now()->addDay(2),
            'end' => Carbon::now()->addDay(8),
        ]);

        // Data for updating the event
        $data = [
            'name' => 'Independence Day',
            'date' => [
                0 => '2023-03-26',
                1 => '2023-03-26',
            ],
            'color' => '#000',
        ];

        // Send a PUT request to update the event and assert the response
        $response = $this->put(route('event.update', 1), $data);
        $response->assertStatus(302);

        // Assert that the event has been updated in the database
        expect(Event::count())->toBe(1);
        expect(Event::first()->title)->toBe('Independence Day');
    }

    public function test_admin_check_event_update_validation()
    {
        // Create an admin user
        $user = User::factory()->create([
            'role' => 'Admin',
        ]);

        // Authenticate the user
        $this->actingAs($user);

        // Create an event
        Event::create([
            'title' => 'Pohela Boishakh',
            'start' => Carbon::now()->addDay(2),
            'end' => Carbon::now()->addDay(8),
        ]);

        // Send a PUT request to update the event without providing required data and assert the response
        $response = $this->put(route('event.update', 1), [])
            ->assertSessionHasErrors(['name', 'date']);
        $response->assertStatus(302);

        // Assert that the event has not been updated in the database
        expect(Event::count())->toBe(1);
        expect(Event::first()->title)->toBe('Pohela Boishakh');
    }

    public function test_admin_can_delete_event()
    {
        // Create an admin user
        $user = User::factory()->create([
            'role' => 'Admin',
        ]);

        // Authenticate the user
        $this->actingAs($user);

        // Create an event
        Event::create([
            'title' => 'Pohela Boishakh',
            'start' => Carbon::now()->addDay(2),
            'end' => Carbon::now()->addDay(8),
        ]);

        // Send a DELETE request to delete the event and assert the response
        $response = $this->delete(route('event.destroy', 1));
        $response->assertStatus(302);

        // Assert that the event has been deleted from the database
        expect(Event::count())->toBe(0);
    }

    public function rolePermission()
    {
        $roleSuperAdmin = Role::create([
            'name' => 'Admin',
            'description' => 'This is Admin Admin',
        ]);
        $permissions = [
            [
                'group_name' => 'event',
                'permissions' => [
                    'event.index',
                    'event.create',
                    'event.edit',
                    'event.destroy',
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
            'event.index',
            'event.create',
            'event.edit',
            'event.destroy',
        ]);
    }
}
