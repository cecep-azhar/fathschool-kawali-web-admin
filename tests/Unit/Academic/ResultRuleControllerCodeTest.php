<?php

use App\Models\ResultRule;
use App\Models\User;
use Database\Seeders\ResultRuleSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Inertia\Testing\AssertableInertia;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class ResultRuleControllerCodeTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_visit_result_rule_index_page()
    {
        // Set up role permissions
        $this->rolePermission();

        // Create a new Admin user
        $user = User::factory()->create([
            'role' => 'Admin',
        ]);

        // Authenticate the admin user
        $this->actingAs($user);

        // Seed the ResultRuleSeeder
        $this->seed(ResultRuleSeeder::class);

        // Send a GET request to the result rule index page
        $response = $this->get(route('result.rule.index'));

        // Assert that the response has a status code of 200 (OK)
        $response->assertStatus(200);

        // Assert that the response contains the expected inertia component and data
        $response->assertInertia(function (AssertableInertia $page) {
            $page->component('Admin/ResultRule/Index')
                ->tap(function ($page) {
                    $page->has('rules.0');
                });
        });
    }

    public function test_admin_can_store_result_rule()
    {
        // Set up role permissions
        $this->rolePermission();

        // Create a new Admin user
        $user = User::factory()->create([
            'role' => 'Admin',
        ]);

        // Authenticate the admin user
        $this->actingAs($user);

        // Set the data for the result rule
        $data = [
            'name' => 'A+',
            'gpa' => '5',
            'min_mark' => '80',
            'max_mark' => '100', 
            'grade_remark' => 'Best',
        ];

        // Send a POST request to store the result rule
        $response = $this->post(route('result.rule.store'), $data);

        // Assert that the response has a status code of 302 (redirect)
        $response->assertStatus(302);

        // Assert that the result rule has been stored in the database
        expect(ResultRule::count())->toBe(1);
    }

    public function test_admin_fails_to_store_result_rule_for_validation()
    {
        // Set up role permissions
        $this->rolePermission();

        // Create a new Admin user
        $user = User::factory()->create([
            'role' => 'Admin',
        ]);

        // Authenticate the admin user
        $this->actingAs($user);

        // Set empty data to fail validation
        $data = [];

        // Send a POST request to store the result rule with empty data
        $response = $this->post(route('result.rule.store'), $data)
            ->assertSessionHasErrors(['name', 'gpa', 'min_mark', 'max_mark', 'grade_remark']);

        // Assert that the response has a status code of 302 (redirect)
        $response->assertStatus(302);

        // Assert that no result rule has been stored in the database
        expect(ResultRule::count())->toBe(0);
    }

    public function test_admin_can_update_result_rules()
    {
        // Set up role permissions
        $this->rolePermission();

        // Create a new Admin user
        $user = User::factory()->create([
            'role' => 'Admin',
        ]);

        // Authenticate the admin user
        $this->actingAs($user);

        // Create a result rule
        $createData = [
            'name' => 'A',
            'gpa' => '4',
            'min_mark' => '70',
            'max_mark' => '80',
            'grade_remark' => 'good',
        ];
        ResultRule::create($createData);

        // Update the result rule with new data
        $data = [
            'name' => 'A+',
            'gpa' => '5',
            'min_mark' => '80',
            'max_mark' => '100',
            'grade_remark' => 'Best',
        ];
        $response = $this->put(route('result.rule.update', 1), $data);

        // Assert that the response has a status code of 302 (redirect)
        $response->assertStatus(302);

        // Assert that the name of the result rule has been updated in the database
        expect(ResultRule::first()->name)->toBe('A+');
    }

    public function test_admin_fails_to_update_result_rule_for_validation()
    {
        // Set up role permissions
        $this->rolePermission();

        // Create a new Admin user
        $user = User::factory()->create([
            'role' => 'Admin',
        ]);

        // Authenticate the admin user
        $this->actingAs($user);

        // Create a result rule
        $createData = [
            'name' => 'A',
            'gpa' => '4',
            'min_mark' => '70',
            'max_mark' => '80',
            'grade_remark' => 'good',
        ];
        ResultRule::create($createData);

        // Set empty data to fail validation
        $data = [];

        // Update the result rule with empty data
        $response = $this->put(route('result.rule.update', 1), $data)
            ->assertSessionHasErrors(['name', 'gpa', 'min_mark', 'max_mark', 'grade_remark']);

        // Assert that the response has a status code of 302 (redirect)
        $response->assertStatus(302);

        // Assert that the name of the result rule has not been updated in the database
        expect(ResultRule::first()->name)->toBe('A');
    }

    public function test_admin_can_delete_a_result_rule()
    {
        // Set up role permissions
        $this->rolePermission();

        // Create a new Admin user
        $user = User::factory()->create([
            'role' => 'Admin',
        ]);

        // Authenticate the admin user
        $this->actingAs($user);

        // Create a result rule
        $createData = [
            'name' => 'A',
            'gpa' => '4',
            'min_mark' => '70',
            'max_mark' => '80',
            'grade_remark' => 'good',
        ];
        ResultRule::create($createData);

        // Delete the result rule
        $response = $this->delete(route('result.rule.destroy', 1));

        // Assert that the response has a status code of 302 (redirect)
        $response->assertStatus(302);

        // Assert that the result rule has been deleted from the database
        expect(ResultRule::count())->toBe(0);
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
