<?php

use App\Models\TransactionType;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Inertia\Testing\AssertableInertia;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class TransactionTypeControllerCodeTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    public function setUp(): void
    {
        parent::setUp();
        $this->rolePermission();
    }

    public function test_displays_all_transaction_type_with_applied_filters()
    {
        // Create an accountant user
        $accountantUser = User::factory()->create([
            'role' => 'Accountant',
        ]);

        // Authenticate the accountant user
        $this->actingAs($accountantUser);
        
        // Send a GET request to the transaction type index page and assert for success
        $response = $this->get(route('transaction-type.index'));
        $response->assertStatus(200);

        // Assert that the response has the expected Inertia component
        $response->assertInertia(function (AssertableInertia $page) {
            $page->component('Accountant/Transaction/Type/Index');
        });
    }

    public function test_display_transaction_type_store()
    {
        // Create an accountant user
        $accountantUser = User::factory()->create([
            'role' => 'Accountant',
        ]);

        // Authenticate the accountant user
        $this->actingAs($accountantUser);

        // Define the data for creating a transaction type
        $data = [
            'type' => 'income',
            'name' => 'Income',
        ];

        // Send a POST request to store the transaction type and assert for success
        $response = $this->post(route('transaction-type.store'), $data);
        $response->assertStatus(302);

        // Assert that the transaction type is stored in the database
        $this->assertDatabaseHas('transaction_types', [
            'name' => 'Income',
        ]);

        // Assert that the count of transaction types is greater than 0
        $count = TransactionType::count();
        expect($count)->toBeGreaterThan(0);
    }

    public function test_check_transaction_store_validation()
    {
        // Create an accountant user
        $accountantUser = User::factory()->create([
            'role' => 'Accountant',
        ]);

        // Authenticate the accountant user
        $this->actingAs($accountantUser);

        // Define empty data for creating a transaction type
        $data = [];

        // Send a POST request to store the transaction type and assert for validation errors and redirection
        $response = $this->post(route('transaction-type.store'), $data);
        $response->assertSessionHasErrors(['name'])
            ->assertStatus(302);

        // Assert that the transaction type is not stored in the database
        $this->assertDatabaseMissing('transaction_types', [
            'name' => 'Good Income',
        ]);

        // Assert that the count of transaction types is less than 1
        $count = TransactionType::count();
        expect($count)->toBeLessThan(1);
    }

    public function test_display_transaction_update()
    {
        // Create an accountant user
        $accountantUser = User::factory()->create([
            'role' => 'Accountant',
        ]);

        // Seed the settings
        $this->seed(SettingSeeder::class);

        // Authenticate the accountant user
        $this->actingAs($accountantUser);

        // Create a transaction type with name 'Bad Income'
        TransactionType::factory(1)->create(['name' => 'Bad Income']);

        // Get the first transaction type
        $type = TransactionType::first();

        // Define the data for updating the transaction type
        $data = [
            'type' => 'income',
            'name' => 'Good Income',
        ];

        // Send a PUT request to update the transaction type and assert for success
        $this->put(route('transaction-type.update', $type->id), $data)->assertStatus(302);

        // Assert that the transaction type is updated in the database
        $this->assertDatabaseHas('transaction_types', [
            'name' => 'Good Income',
        ]);
    }

    public function test_display_transaction_update_validation_check()
    {
        // Create an accountant user
        $accountantUser = User::factory()->create([
            'role' => 'Accountant',
        ]);

        // Authenticate the accountant user
        $this->actingAs($accountantUser);

        // Create a transaction type with name 'Bad Income'
        TransactionType::factory(1)->create(['name' => 'Bad Income']);

        // Get the first transaction type
        $type = TransactionType::first();

        // Send a PUT request to update the transaction type with empty data
        // and assert for validation errors and redirection
        $this->put(route('transaction-type.update', $type->id), [])
            ->assertSessionHasErrors(['name'])
            ->assertStatus(302);

        // Assert that the transaction type remains unchanged in the database
        $this->assertDatabaseHas('transaction_types', [
            'name' => 'Bad Income',
        ]);
    }

    public function test_transaction_destroy()
    {
        // Create an accountant user
        $accountantUser = User::factory()->create([
            'role' => 'Accountant',
        ]);

        // Authenticate the accountant user
        $this->actingAs($accountantUser);

        // Create a transaction type
        TransactionType::factory(1)->create();

        // Get the first transaction type
        $type = TransactionType::first();

        // Send a DELETE request to delete the transaction type and assert for success
        $this->delete(route('transaction-type.destroy', $type))
            ->assertStatus(302);

        // Assert that there are no transaction types in the database
        expect(TransactionType::all())->toBeEmpty();
    }

    public function rolePermission()
    {
        Role::create([
            'name' => 'Admin',
            'description' => 'This is Admin Admin',
        ]);
        Role::create([
            'name' => 'Teacher',
            'description' => 'This is Admin Teacher',
        ]);
        Role::create([
            'name' => 'Parent',
            'description' => 'This is Admin Parent',
        ]);
        Role::create([
            'name' => 'Student',
            'description' => 'This is Admin Student',
        ]);
        $roleAccountant = Role::create([
            'name' => 'Accountant',
            'description' => 'This is Admin Accountant',
        ]);
        $accountant_permissions = [
            [
                'group_name' => 'transaction-type',
                'permissions' => [
                    'transaction-type.index',
                    'transaction-type.create',
                    'transaction-type.store',
                    'transaction-type.show',
                    'transaction-type.edit',
                    'transaction-type.update',
                    'transaction-type.destroy',
                ],
            ],
        ];
        for ($i = 0; $i < count($accountant_permissions); $i++) {
            $permissionGroup = $accountant_permissions[$i]['group_name'];

            for ($j = 0; $j < count($accountant_permissions[$i]['permissions']); $j++) {
                $permission = Permission::create([
                    'name' => $accountant_permissions[$i]['permissions'][$j],
                    'group_name' => $permissionGroup,
                ]);

                $roleAccountant->givePermissionTo($permission);
            }
        }
    }
}
