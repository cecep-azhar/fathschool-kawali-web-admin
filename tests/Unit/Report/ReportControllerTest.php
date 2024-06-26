<?php

use App\Models\Transaction;
use App\Models\User;
use Database\Seeders\TransactionTypeSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Inertia\Testing\AssertableInertia;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class ReportControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_visit_report_index_page()
    {
        $this->rolePermission();

        // Create an admin user
        $user = User::factory()->create([
            'role' => 'Admin',
        ]);

        // Act as the admin user
        $this->actingAs($user);

        // Visit the user index page
        $response = $this->get(route('reports.index'));

        // Assert that the response status is 200 (OK)
        $response->assertStatus(200);

        // Get the inertia page content
        $response->assertInertia(function (AssertableInertia $page) {
            $page->component('Admin/Report/Index');
        });
    }

    public function test_admin_can_visit_report_transaction_index_page()
    {
        $this->rolePermission();

        // Create an admin user
        $user = User::factory()->create([
            'role' => 'Admin',
        ]);

        // Act as the admin user
        $this->actingAs($user);
        $user->factory()->count(20)->create();
        $this->seed([TransactionTypeSeeder::class]);
        Transaction::factory()->count(50)->create();

        // Visit the user index page
        $response = $this->get(route('report.transaction'));

        // Assert that the response status is 200 (OK)
        $response->assertStatus(200);

        // Get the inertia page content
        $response->assertInertia(function (AssertableInertia $page) {
            $page->component('Admin/Report/Transaction')
                ->tap(function ($page) {
                    $page->has('transactions.data.0');
                });
        });
    }

    public function test_admin_can_search_in_report_transaction_index_page()
    {
        $this->rolePermission();

        // Create an admin user
        $user = User::factory()->create([
            'role' => 'Admin',
        ]);

        // Act as the admin user
        $this->actingAs($user);
        $user->factory()->count(10)->create();
        $this->seed([TransactionTypeSeeder::class]);
        Transaction::factory()->count(500)->create();

        // Visit the user index page
        $data = [
            'keyword' => 'a',
            'status' => 'paid',
            'parent_id' => '1',
            'type' => 'all',
            'amountType' => 'income',
        ];
        $queryString = http_build_query($data);
        $response = $this->get('report/transactions?'.$queryString);

        // Assert that the response status is 200 (OK)
        $response->assertStatus(200);

        // Get the inertia page content
        $response->assertInertia(function (AssertableInertia $page) {
            $page->component('Admin/Report/Transaction')
                ->tap(function ($page) {
                    $page->has('transactions.data.0');
                });
        });
    }

    public function rolePermission()
    {
        $roleAdmin = Role::create([
            'name' => 'Admin',
            'description' => 'This is Admin',
        ]);
        $permissions = [
            [
                'group_name' => 'Reports',
                'permissions' => [
                    'report.index',
                    'report.transaction',
                    'report.attendance',
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
            'report.index',
            'report.transaction',
            'report.attendance',
        ]);
    }
}
