<?php

use App\Models\Plan;
use App\Models\PlanBenefit;
use App\Models\User;
use Database\Seeders\CurrencySeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Inertia\Testing\AssertableInertia;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class PlanControllerCodeTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    public function setUp(): void
    {
        parent::setUp();
        $this->rolePermission();
        $this->seed(CurrencySeeder::class);
    }

    public function testAccountantAccessingPlanIndexPage()
    {
        // Create a new user with the role of 'Accountant'
        $user = User::factory()->create([
            'role' => 'Accountant',
        ]);

        // Act as the created user
        $this->actingAs($user);

        // Send a GET request to the route 'plan.index'
        $response = $this->get(route('plan.index'));

        // Assert that the response has a status code of 200 (OK)
        $response->assertStatus(200);

        // Assert that the response contains an Inertia component named 'Accountant/Plan/Index'
        $response->assertInertia(function (AssertableInertia $page) {
            $page->component('Accountant/Plan/Index');
        });
    }

    public function testAdminAccessingPlanIndexPage()
    {
        // Create a new user with the role of 'Admin'
        $user = User::factory()->create([
            'role' => 'Admin',
        ]);

        // Act as the created user
        $this->actingAs($user);

        // Send a GET request to the route 'plan.index'
        $response = $this->get(route('plan.index'));

        // Assert that the response has a status code of 200 (OK)
        $response->assertStatus(200);

        // Assert that the response contains an Inertia component named 'Accountant/Plan/Index'
        $response->assertInertia(function (AssertableInertia $page) {
            $page->component('Accountant/Plan/Index');
        });
    }

    public function testAccountantPlanIndexPageIfDataAvailable()
    {
        // Seed the CourseSeeder and PlanSeeder to generate necessary data
        $this->seed(CourseSeeder::class);
        $this->seed(PlanSeeder::class);

        // Create a new user with the role of 'Accountant'
        $user = User::factory()->create([
            'role' => 'Accountant',
        ]);

        // Act as the created user
        $this->actingAs($user);

        // Send a GET request to the route 'plan.index'
        $response = $this->get(route('plan.index'));

        // Assert that the response has a status code of 200 (OK)
        $response->assertStatus(200);

        // Assert that the response contains an Inertia component named 'Accountant/Plan/Index'
        // and verify that it has at least one plan available
        $response->assertInertia(function (AssertableInertia $page) {
            $page->component('Accountant/Plan/Index')
                ->tap(function ($page) {
                    $page->has('plans.0');
                });
        });
    }

    public function testAdminPlanIndexPageIfDataAvailable()
    {
        // Seed the CourseSeeder and PlanSeeder to generate necessary data
        $this->seed(CourseSeeder::class);
        $this->seed(PlanSeeder::class);

        // Create a new user with the role of 'Admin'
        $user = User::factory()->create([
            'role' => 'Admin',
        ]);

        // Act as the created user
        $this->actingAs($user);

        // Send a GET request to the route 'plan.index'
        $response = $this->get(route('plan.index'));

        // Assert that the response has a status code of 200 (OK)
        $response->assertStatus(200);

        // Assert that the response contains an Inertia component named 'Accountant/Plan/Index'
        // and verify that it has at least one plan available
        $response->assertInertia(function (AssertableInertia $page) {
            $page->component('Accountant/Plan/Index')
                ->tap(function ($page) {
                    $page->has('plans.0');
                });
        });
    }

    public function testAccountantAccessingPlanCreatePage()
    {
        // Seed the CourseSeeder to generate necessary data
        $this->seed(CourseSeeder::class);

        // Create a new user with the role of 'Accountant'
        $user = User::factory()->create([
            'role' => 'Accountant',
        ]);

        // Act as the created user
        $this->actingAs($user);

        // Send a GET request to the route 'plan.create'
        $response = $this->get(route('plan.create'));

        // Assert that the response has a status code of 200 (OK)
        $response->assertStatus(200);

        // Assert that the response contains an Inertia component named 'Accountant/Plan/Form'
        $response->assertInertia(function (AssertableInertia $page) {
            $page->component('Accountant/Plan/Form');
        });
    }

    public function testAdminAccessingPlanCreatePage()
    {
        // Seed the CourseSeeder to generate necessary data
        $this->seed(CourseSeeder::class);

        // Create a new user with the role of 'Admin'
        $user = User::factory()->create([
            'role' => 'Admin',
        ]);

        // Act as the created user
        $this->actingAs($user);

        // Send a GET request to the route 'plan.create'
        $response = $this->get(route('plan.create'));

        // Assert that the response has a status code of 200 (OK)
        $response->assertStatus(200);

        // Assert that the response contains an Inertia component named 'Accountant/Plan/Form'
        $response->assertInertia(function (AssertableInertia $page) {
            $page->component('Accountant/Plan/Form');
        });
    }

    public function testAccountantCanGenerateNewPlan()
    {
        // Seed the CourseSeeder to generate necessary data
        $this->seed(CourseSeeder::class);

        // Create a new user with the role of 'Accountant'
        $user = User::factory()->create([
            'role' => 'Accountant',
        ]);

        // Act as the created user
        $this->actingAs($user);

        // Define the data for creating a new plan
        $data = [
            'title' => 'master',
            'description' => 'no description',
            'course' => 1,
            "currency" => "USD",
            'benefits' => ['Be Good', 'Be Genius'],
            'amounts' => ['12', '123'],
        ];

        // Send a POST request to the route 'plan.store' with the data
        $this->post(route('plan.store'), $data)
            ->assertStatus(302);

        // Assert that a plan with the given title 'master' exists in the database
        $plan = Plan::where('title', 'master')->first();
        $this->assertNotNull($plan);

        // Assert that the plan's description matches the provided value
        $this->assertEquals('no description', $plan->description);

        // Assert that there are two plan benefits in the database
        $this->assertCount(2, PlanBenefit::get());
    }

    public function testAdminCanGenerateNewPlan()
    {
        // Seed the CourseSeeder to generate necessary data
        $this->seed(CourseSeeder::class);

        // Create a new user with the role of 'Admin'
        $user = User::factory()->create([
            'role' => 'Admin',
        ]);

        // Act as the created user
        $this->actingAs($user);

        // Define the data for creating a new plan
        $data = [
            'title' => 'master',
            'description' => 'no description',
            'course' => 1,
            'benefits' => ['Be Good', 'Be Genius'],
            'amounts' => ['12', '123'],
            "currency" => "USD",
        ];

        // Send a POST request to the route 'plan.store' with the data
        $this->post(route('plan.store'), $data)
            ->assertStatus(302);

        // Assert that a plan with the given title 'master' exists in the database
        $plan = Plan::where('title', 'master')->first();
        $this->assertNotNull($plan);

        // Assert that the plan's description matches the provided value
        $this->assertEquals('no description', $plan->description);

        // Assert that there are two plan benefits in the database
        $this->assertCount(2, PlanBenefit::get());
    }

    public function testAccountantWillFailToRecordPlanIfDataIsMissing()
    {
        // Create a new user with the role of 'Accountant'
        $user = User::factory()->create([
            'role' => 'Accountant',
        ]);

        // Act as the created user
        $this->actingAs($user);

        // Send a POST request to the route 'plan.store' with empty data
        $this->post(route('plan.store'), [])
            ->assertSessionHasErrors(['title', 'course', 'benefits'])
            ->assertStatus(302);
    }

    public function testAdminWillFailToRecordPlanIfDataIsMissing()
    {
        // Create a new user with the role of 'Admin'
        $user = User::factory()->create([
            'role' => 'Admin',
        ]);

        // Act as the created user
        $this->actingAs($user);

        // Send a POST request to the route 'plan.store' with empty data
        $this->post(route('plan.store'), [])
            ->assertSessionHasErrors(['title', 'course', 'benefits'])
            ->assertStatus(302);
    }

    public function testAccountantAccessingPlanEditPage()
    {
        // Seed the CourseSeeder and PlanSeeder to generate necessary data
        $this->seed(CourseSeeder::class);
        $this->seed(PlanSeeder::class);

        // Create a new user with the role of 'Accountant'
        $user = User::factory()->create([
            'role' => 'Accountant',
        ]);

        // Act as the created user
        $this->actingAs($user);

        // Get the first plan from the database
        $plan = Plan::first();

        // Send a GET request to the route 'plan.edit' with the plan's ID
        $response = $this->get(route('plan.edit', $plan->id));

        // Assert that the response contains an Inertia component named 'Accountant/Plan/Form'
        $response->assertInertia(function (AssertableInertia $page) {
            $page->component('Accountant/Plan/Form');
        });
    }

    public function testAdminAccessingPlanEditPage()
    {
        // Seed the CourseSeeder and PlanSeeder to generate necessary data
        $this->seed(CourseSeeder::class);
        $this->seed(PlanSeeder::class);

        // Create a new user with the role of 'Admin'
        $user = User::factory()->create([
            'role' => 'Admin',
        ]);

        // Act as the created user
        $this->actingAs($user);

        // Get the first plan from the database
        $plan = Plan::first();

        // Send a GET request to the route 'plan.edit' with the plan's ID
        $response = $this->get(route('plan.edit', $plan->id));

        // Assert that the response contains an Inertia component named 'Accountant/Plan/Form'
        $response->assertInertia(function (AssertableInertia $page) {
            $page->component('Accountant/Plan/Form');
        });
    }

    public function testAccountantCanUpdateExistingPlan()
    {
        // Seed the CourseSeeder and PlanSeeder to generate necessary data
        $this->seed(CourseSeeder::class);
        $this->seed(PlanSeeder::class);

        // Create a new user with the role of 'Accountant'
        $user = User::factory()->create([
            'role' => 'Accountant',
        ]);

        // Act as the created user
        $this->actingAs($user);

        // Get the first plan from the database
        $plan = Plan::first();

        // Define the data for updating the plan
        $data = [
            'title' => 'master',
            'description' => 'no description',
            'course' => 1,
            'benefits' => ['Be Good', 'Be Genius'],
            'amounts' => ['12', '123'],
            "currency" => "USD",
        ];

        // Send a PUT request to the route 'plan.update' with the plan's ID and the data
        $this->put(route('plan.update', $plan->id), $data)
            ->assertStatus(302);

        // Retrieve the updated plan from the database
        $plan = Plan::where('title', 'master')->first();

        // Assert that the plan exists and its description matches the updated value
        $this->assertNotNull($plan);
        $this->assertEquals('no description', $plan->description);
    }

    public function testAdminCanUpdateExistingPlan()
    {
        // Seed the CourseSeeder and PlanSeeder to generate necessary data
        $this->seed(CourseSeeder::class);
        $this->seed(PlanSeeder::class);

        // Create a new user with the role of 'Admin'
        $user = User::factory()->create([
            'role' => 'Admin',
        ]);

        // Act as the created user
        $this->actingAs($user);

        // Get the first plan from the database
        $plan = Plan::first();

        // Define the data for updating the plan
        $data = [
            'title' => 'master',
            'description' => 'no description',
            'course' => 1,
            'benefits' => ['Be Good', 'Be Genius'],
            'amounts' => ['12', '123'],
            "currency" => "USD",
        ];

        // Send a PUT request to the route 'plan.update' with the plan's ID and the data
        $this->put(route('plan.update', $plan->id), $data)
            ->assertStatus(302);

        // Retrieve the updated plan from the database
        $plan = Plan::where('title', 'master')->first();

        // Assert that the plan exists and its description matches the updated value
        $this->assertNotNull($plan);
        $this->assertEquals('no description', $plan->description);
    }

    public function testAccountantCanNotUpdateExistingPlanIfDataMissing()
    {
        // Seed the CourseSeeder to generate necessary data
        $this->seed(CourseSeeder::class);

        // Create a new user with the role of 'Accountant'
        $user = User::factory()->create([
            'role' => 'Accountant',
        ]);

        // Act as the created user
        $this->actingAs($user);

        // Define the data for creating a new plan
        $data = [
            'title' => 'master',
            'description' => 'no description',
            'course' => 1,
            'benefits' => ['Be Good', 'Be Genius'],
            'amounts' => ['12', '123'],
            "currency" => "USD",
        ];

        // Create a new plan using the defined data
        $this->post(route('plan.store'), $data);

        // Send a PUT request to the route 'plan.update' with an invalid plan ID and an empty data array
        $this->put(route('plan.update', 1), [])
            ->assertSessionHasErrors(['title', 'course', 'benefits'])
            ->assertStatus(302);

        // Assert that the plan with the title 'master' still exists in the database
        $this->assertDatabaseHas('plans', [
            'title' => 'master',
        ]);
    }

    public function testAdminCanNotUpdateExistingPlanIfDataMissing()
    {
        // Seed the course data
        $this->seed(CourseSeeder::class);

        // Create an admin user
        $user = User::factory()->create([
            'role' => 'Admin',
        ]);

        // Act as the admin user
        $this->actingAs($user);

        // Prepare the data for creating a new plan
        $data = [
            'title' => 'master',
            'description' => 'no description',
            'course' => 1,
            'benefits' => ['Be Good', 'Be Genius'],
            'amounts' => ['12', '123'],
            "currency" => "USD",
        ];

        // Create a new plan using the data
        $this->post(route('plan.store'), $data);

        // Attempt to update the plan with an empty array, which is missing required data
        $this->put(route('plan.update', 1), [])
            ->assertSessionHasErrors(['title', 'course', 'benefits']) // Expect errors for missing fields
            ->assertStatus(302); // Expect a redirect

        // Verify that the plan with the given title exists in the database
        $this->assertDatabaseHas('plans', [
            'title' => 'master',
        ]);
    }

    public function testAccountantCanDestroyPlan()
    {
        // Seed the course data
        $this->seed(CourseSeeder::class);

        // Create an accountant user
        $user = User::factory()->create([
            'role' => 'Accountant',
        ]);

        // Act as the accountant user
        $this->actingAs($user);

        // Prepare the data for creating a new plan
        $data = [
            'title' => 'master',
            'description' => 'no description',
            'course' => 1,
            'benefits' => ['Be Good', 'Be Genius'],
            'amounts' => ['12', '123'],
            "currency" => "USD",
        ];

        // Create a new plan using the data
        $this->post(route('plan.store'), $data);

        // Get the first plan from the database
        $plan = Plan::first();

        // Delete the plan using its ID
        $response = $this->delete(route('plan.destroy', $plan->id));

        // Assert that the deletion was successful (status code 302 indicates a redirect)
        $response->assertStatus(302);

        // Assert that the plans count in the database is now 0
        $this->assertDatabaseCount('plans', 0);

        // Assert that the plan is no longer in the database
        $this->assertModelMissing($plan);
    }

    public function testAdminCanDestroyPlan()
    {
        // Seed the course data
        $this->seed(CourseSeeder::class);

        // Create an admin user
        $user = User::factory()->create([
            'role' => 'Admin',
        ]);

        // Act as the admin user
        $this->actingAs($user);

        // Prepare the data for creating a new plan
        $data = [
            'title' => 'master',
            'description' => 'no description',
            'course' => 1,
            'benefits' => ['Be Good', 'Be Genius'],
            'amounts' => ['12', '123'],
            "currency" => "USD",
        ];

        // Create a new plan using the data
        $this->post(route('plan.store'), $data);

        // Get the first plan from the database
        $plan = Plan::first();

        // Delete the plan using its ID
        $response = $this->delete(route('plan.destroy', $plan->id));

        // Assert that the deletion was successful (status code 302 indicates a redirect)
        $response->assertStatus(302);

        // Assert that the plans count in the database is now 0
        $this->assertDatabaseCount('plans', 0);

        // Assert that the plan is no longer in the database
        $this->assertModelMissing($plan);
    }

    public function rolePermission()
    {
        $roleSuperAdmin = Role::create([
            'name' => 'Admin',
            'description' => 'This is Admin Admin',
        ]);
        $roleAccountant = Role::create([
            'name' => 'Accountant',
            'description' => 'This is Admin Accountant',
        ]);
        $permissions = [
            [
                'group_name' => 'plan',
                'permissions' => [
                    'plan.index',
                    'plan.create',
                    'plan.edit',
                    'plan.destroy',
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
            'plan.index',
            'plan.create',
            'plan.edit',
            'plan.destroy',
        ]);

        $roleAccountant->givePermissionTo([
            'plan.index',
            'plan.create',
            'plan.edit',
            'plan.destroy',
        ]);
    }
}
