<?php

use App\Models\Setting;
use App\Models\Transaction;
use App\Models\TransactionType;
use App\Models\User;
use Database\Seeders\CurrencySeeder;
use Database\Seeders\SettingSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Illuminate\Http\UploadedFile;
use Inertia\Testing\AssertableInertia;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class TransactionControllerCodeTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    public function setUp(): void
    {
        parent::setUp();
        $this->rolePermission();
    }

    public function test_displays_all_transactions_for_accountant()
    {
        // Creating a user with the 'Accountant' role
        $user = User::factory()->create([
            'role' => 'Accountant',
        ]);

        // Authenticating the user
        $this->actingAs($user);

        $this->seed([
            CurrencySeeder::class,
            SettingSeeder::class,
        ]);

        $settings =  Setting::first();
        $settings-> app_currency = 'USD' ;
        $settings->save();

        TransactionType::factory()->create();
        // Creating 10 Transaction records
        Transaction::factory()->count(10)->create();

        $response = $this->get(route('transaction.index'));

        // Asserting that the response has a status code of 200 (OK)
        $response->assertStatus(200);

        // Assert the rendered view
        $response->assertInertia(function (AssertableInertia $page) {
            $page->component('Accountant/Transaction/List/AllTransaction')
                ->tap(function ($page) {
                    $page->has('transactions.data.9');
                    $page->missing('transactions.data.10');
                });
        });
    }

    public function test_displays_all_transactions_for_admin()
    {
        // Creating a user with the 'Admin' role
        $user = User::factory()->create([
            'role' => 'Admin',
        ]);

        // Authenticating the user
        $this->actingAs($user);

        $this->seed([
            CurrencySeeder::class,
            SettingSeeder::class,
        ]);

        $settings =  Setting::first();
        $settings-> app_currency = 'USD' ;
        $settings->save();

        // Creating 10 TransactionType records
        TransactionType::factory()->create();

        // Creating 10 Transaction records
        Transaction::factory()->count(10)->create();

        // Creating the request parameters
        $request = ['status' => 'paid', 'type' => 'expense'];

        // Sending a GET request to the 'all.transaction' route with the request parameters
        $response = $this->get(route('all.transaction'), $request);

        // Asserting that the response has a status code of 200 (OK)
        $response->assertStatus(200);

        // Assert the rendered view
        $response->assertInertia(function (AssertableInertia $page) {
            $page->component('Accountant/Transaction/List/AllTransaction')
                ->tap(function ($page) {
                    $page->has('transactions.data.9');
                    $page->missing('transactions.data.10');
                });
        });
    }

    public function test_accountant_displays_all_transactions_filter_data()
    {
        // Creating a user with the 'Accountant' role
        $user = User::factory()->create([
            'role' => 'Accountant',
        ]);

        // Authenticating the user
        $this->actingAs($user);

        $this->seed([
            CurrencySeeder::class,
            SettingSeeder::class,
        ]);

        $settings =  Setting::first();
        $settings-> app_currency = 'USD' ;
        $settings->save();

        // Creating 10 TransactionType records
        TransactionType::factory()->create();

        // Creating 10 Transaction records
        Transaction::factory()->count(10)->create();

        // Creating the request parameters
        $data = [
            'keyword' => 'i',
            'status' => 'unpaid',
            'start_date' => '2000-06-06',
            'end_date' => '2100-06-07',
            'type' => 'income',
            'over_due' => 'over-due',
        ];

        // Building the query string from the request parameters
        $queryString = http_build_query($data);

        // Sending a GET request to the 'all/transaction' route with the query string
        $response = $this->get('all/transaction?'.$queryString);

        // Asserting that the response has a status code of 200 (OK)
        $response->assertStatus(200);

        // Assert the rendered view
        $response->assertInertia(function (AssertableInertia $page) {
            $page->component('Accountant/Transaction/List/AllTransaction')
                ->tap(function ($page) {
                    $page->has('filter_data.status');
                });
        });
    }

    public function test_admin_displays_all_transactions_filter_data()
    {
        // Creating a user with the 'Admin' role
        $user = User::factory()->create([
            'role' => 'Admin',
        ]);

        // Authenticating the user
        $this->actingAs($user);

        $this->seed([
            CurrencySeeder::class,
            SettingSeeder::class,
        ]);

        $settings =  Setting::first();
        $settings-> app_currency = 'USD' ;
        $settings->save();

        // Creating 10 TransactionType records
        TransactionType::factory()->create();

        // Creating 10 Transaction records
        Transaction::factory()->count(10)->create();

        // Creating the request parameters
        $data = [
            'keyword' => 'i',
            'status' => 'unpaid',
            'start_date' => '2000-06-06',
            'end_date' => '2100-06-07',
            'type' => 'income',
            'over_due' => 'over-due',
        ];

        // Building the query string from the request parameters
        $queryString = http_build_query($data);

        // Sending a GET request to the 'all/transaction' route with the query string
        $response = $this->get('all/transaction?'.$queryString);

        // Asserting that the response has a status code of 200 (OK)
        $response->assertStatus(200);

        // Assert the rendered view
        $response->assertInertia(function (AssertableInertia $page) {
            $page->component('Accountant/Transaction/List/AllTransaction')
                ->tap(function ($page) {
                    $page->has('filter_data.status');
                });
        });
    }

    public function test_display_transaction_create()
    {
        // Creating a user with the 'Accountant' role
        $user = User::factory()->create([
            'role' => 'Accountant',
        ]);

        // Seeding the required settings
        $this->seed(SettingSeeder::class);

        // Authenticating the user
        $this->actingAs($user);

        // Sending a GET request to the transaction create route
        $response = $this->get(route('transaction.create'));

        // Asserting that the response has a status code of 200 (OK)
        $response->assertStatus(200);

        // Assert the rendered view
        $response->assertInertia(function (AssertableInertia $page) {
            $page->component('Accountant/Transaction/List/Form');
        });
    }

    public function test_display_transaction_store()
    {
        // Creating a user with the 'Accountant' role
        $user = User::factory()->create([
            'role' => 'Accountant',
        ]);

        // Authenticating the user
        $this->actingAs($user);


        // Seeding one TransactionType record
        TransactionType::factory()->create();

        $data = [
            "category_type" => "expense",
            "type" => 1,
            "particular" => null,
            "title" => "test",
            "amount" => "1",
            "currency" => "USD",
            "date" => "2023-09-19",
            "due_date" => null,
            "paid_amount" => null,
            "description" => "ok",
            "status" => "unpaid",
            "document" =>UploadedFile::fake()->create('invoice.jpg', 1024),
            "payment_method" => "cash",
        ];

        // Sending a POST request to the transaction store route with the data
        $this->post(route('transaction.store'), $data)->assertStatus(302);

        // Asserting that the transaction is saved in the database
        $this->assertDatabaseHas('transactions', [
            'description' => 'ok',
        ]);

        // Asserting that the count of transactions is greater than 0
        $count = Transaction::count();
        expect($count)->toBeGreaterThan(0);
    }

    public function test_check_transaction_store_validation()
    {
        // Creating a user with the 'Accountant' role
        $user = User::factory()->create([
            'role' => 'Accountant',
        ]);

        // Creating a user with the 'Teacher' role
        User::factory()->create([
            'role' => 'Teacher',
        ]);

        // Seeding the required settings
        $this->seed(SettingSeeder::class);

        // Authenticating the user
        $this->actingAs($user);

        // Seeding one TransactionType record
        TransactionType::factory(1)->create();

        // Creating the input data for the transaction without required fields
        $data = [
            'description' => 'Payment of teacher',
        ];

        // Sending a POST request to the transaction store route with the incomplete data
        $this->post(route('transaction.store'), $data)
            ->assertSessionHasErrors(['title', 'type', 'date', 'status', 'amount'])
            ->assertStatus(302);

        // Asserting that the transaction is not saved in the database
        $this->assertDatabaseMissing('transactions', [
            'description' => 'Payment of teacher',
        ]);

        // Asserting that the count of transactions is less than 1
        $count = Transaction::count();
        expect($count)->toBeLessThan(1);
    }

    public function test_admin_display_transaction_edit()
    {
        // Creating a user with the 'Admin' role
        $user = User::factory()->create([
            'role' => 'Admin',
        ]);

        // Seeding the required settings
        $this->seed(SettingSeeder::class);

        // Authenticating the user
        $this->actingAs($user);

        // Seeding one TransactionType record
        TransactionType::factory(1)->create();

        // Creating one Transaction record
        Transaction::factory()->count(1)->create();

        // Getting the first transaction from the database
        $transaction = Transaction::first();

        // Sending a GET request to the transaction edit route with the transaction ID
        $response = $this->get(route('transaction.edit', $transaction->id));

        // Asserting that the response has a status code of 200 (OK)
        $response->assertStatus(200);

        // Assert the rendered view
        $response->assertInertia(function (AssertableInertia $page) {
            $page->component('Accountant/Transaction/List/Form');
        });
    }

    public function test_accountant_display_transaction_edit()
    {
        // Creating a user with the 'Accountant' role
        $user = User::factory()->create([
            'role' => 'Accountant',
        ]);

        // Seeding the required settings
        $this->seed(SettingSeeder::class);

        // Authenticating the user
        $this->actingAs($user);

        // Seeding one TransactionType record
        TransactionType::factory(1)->create();

        // Creating one Transaction record
        Transaction::factory()->count(1)->create();

        // Getting the first transaction from the database
        $transaction = Transaction::first();

        // Sending a GET request to the transaction edit route with the transaction ID
        $response = $this->get(route('transaction.edit', $transaction->id));

        // Asserting that the response has a status code of 200 (OK)
        $response->assertStatus(200);

        // Assert the rendered view
        $response->assertInertia(function (AssertableInertia $page) {
            $page->component('Accountant/Transaction/List/Form');
        });
    }

    public function test_admin_display_transaction_update()
    {
        // Creating a user with the 'Admin' role
        $user = User::factory()->create([
            'role' => 'Admin',
        ]);

        // Creating a user with the 'Student' role
        $student = User::factory()->create([
            'role' => 'Student',
        ]);

        // Seeding the required settings
        $this->seed(SettingSeeder::class);

        // Authenticating the user
        $this->actingAs($user);

        // Seeding one TransactionType record
        TransactionType::factory(1)->create();

        // Creating one Transaction record
        Transaction::factory()->count(1)->create();

        // Getting the first transaction from the database
        $transaction = Transaction::first();

        // Creating the input data for updating the transaction
        $data = [
            'title' => 'This is title',
            'date' => '2023-05-23',
            'status' => 'paid',
            'amount' => '102.00',
            'type' => 1,
        ];

        // Sending a PUT request to the transaction update route with the transaction ID and data
        $this->put(route('transaction.update', $transaction->id), $data)->assertStatus(302);

        // Asserting that the transaction is not saved in the database
        $this->assertDatabaseMissing('transactions', [
            'message' => 'This is title',
        ]);
    }

    public function test_accountant_display_transaction_update()
    {
        // Creating a user with the 'Accountant' role
        $user = User::factory()->create([
            'role' => 'Accountant',
        ]);

        // Creating a user with the 'Student' role
        $student = User::factory()->create([
            'role' => 'Student',
        ]);

        // Seeding the required settings
        $this->seed(SettingSeeder::class);

        // Authenticating the user
        $this->actingAs($user);

        // Seeding one TransactionType record
        TransactionType::factory(1)->create();

        // Creating one Transaction record
        Transaction::factory()->count(1)->create();

        // Getting the first transaction from the database
        $transaction = Transaction::first();

        // Creating the input data for updating the transaction
        $data = [
            'title' => 'This is title',
            'date' => '2023-05-23',
            'status' => 'paid',
            'amount' => '102.00',
            'type' => 1,
        ];

        // Sending a PUT request to the transaction update route with the transaction ID and data
        $this->put(route('transaction.update', $transaction->id), $data)->assertStatus(302);

        // Asserting that the transaction is not saved in the database
        $this->assertDatabaseMissing('transactions', [
            'message' => 'This is title',
        ]);
    }

    public function test_admin_display_transaction_update_validation_check()
    {
        // Creating a user with the 'Admin' role
        $user = User::factory()->create([
            'role' => 'Admin',
        ]);

        // Creating a user with the 'Student' role
        User::factory()->create([
            'role' => 'Student',
        ]);

        // Seeding the required settings
        $this->seed(SettingSeeder::class);

        // Authenticating the user
        $this->actingAs($user);

        // Seeding one TransactionType record
        TransactionType::factory(1)->create();

        // Creating one Transaction record
        Transaction::factory()->count(1)->create();

        // Getting the first transaction from the database
        $transaction = Transaction::first();

        // Creating the input data for updating the transaction (missing required fields)
        $data = [
            'title' => 'This is title',
        ];

        // Sending a PUT request to the transaction update route with the transaction ID and data
        $this->put(route('transaction.update', $transaction->id), $data)
            ->assertSessionHasErrors(['type', 'date', 'status', 'amount'])
            ->assertStatus(302);

        // Asserting that the transaction is not saved in the database
        $this->assertDatabaseMissing('transactions', [
            'message' => 'This is title',
        ]);
    }

    public function test_accountant_display_transaction_update_validation_check()
    {
        // Creating a user with the 'Accountant' role
        $user = User::factory()->create([
            'role' => 'Accountant',
        ]);

        // Creating a user with the 'Student' role
        $student = User::factory()->create([
            'role' => 'Student',
        ]);

        // Seeding the required settings
        $this->seed(SettingSeeder::class);

        // Authenticating the user
        $this->actingAs($user);

        // Seeding one TransactionType record
        TransactionType::factory(1)->create();

        // Creating one Transaction record
        Transaction::factory()->count(1)->create();

        // Getting the first transaction from the database
        $transaction = Transaction::first();

        // Creating the input data for updating the transaction (missing required fields)
        $data = [
            'title' => 'This is title',
        ];

        // Sending a PUT request to the transaction update route with the transaction ID and data
        $this->put(route('transaction.update', $transaction->id), $data)
            ->assertSessionHasErrors(['type', 'date', 'status', 'amount'])
            ->assertStatus(302);

        // Asserting that the transaction is not saved in the database
        $this->assertDatabaseMissing('transactions', [
            'message' => 'This is title',
        ]);
    }

    public function test_admin_transaction_destroy()
    {
        // Creating a user with the 'Admin' role
        $user = User::factory()->create([
            'role' => 'Admin',
        ]);

        // Seeding the required settings
        $this->seed(SettingSeeder::class);

        // Authenticating the user
        $this->actingAs($user);

        // Seeding one TransactionType record
        TransactionType::factory(1)->create();

        // Creating one Transaction record
        Transaction::factory()->count(1)->create();

        // Getting the first transaction from the database
        $transaction = Transaction::first();

        // Sending a DELETE request to the transaction destroy route with the transaction ID
        $this->delete(route('transaction.destroy', $transaction->id))
            ->assertStatus(302);

        // Asserting that there are no transactions in the database
        expect(Transaction::all())->toBeEmpty();
    }

    public function test_accountant_transaction_destroy()
    {
        // Creating a user with the 'Accountant' role
        $user = User::factory()->create([
            'role' => 'Accountant',
        ]);

        // Seeding the required settings
        $this->seed(SettingSeeder::class);

        // Authenticating the user
        $this->actingAs($user);

        // Seeding one TransactionType record
        TransactionType::factory(1)->create();

        // Creating one Transaction record
        Transaction::factory()->count(1)->create();

        // Getting the first transaction from the database
        $transaction = Transaction::first();

        // Sending a DELETE request to the transaction destroy route with the transaction ID
        $this->delete(route('transaction.destroy', $transaction->id))
            ->assertStatus(302);

        // Asserting that there are no transactions in the database
        expect(Transaction::all())->toBeEmpty();
    }

    public function test_admin_mark_as_paid()
    {
        // Creating a user with the 'Admin' role
        $user = User::factory()->create([
            'role' => 'Admin',
        ]);

        // Seeding the required settings
        $this->seed(SettingSeeder::class);

        // Authenticating the user
        $this->actingAs($user);

        // Seeding one TransactionType record
        TransactionType::factory(1)->create();

        // Creating one Transaction record with 'unpaid' status
        Transaction::factory()->count(1)->create([
            'status' => 'unpaid',
        ]);

        // Getting the first transaction from the database
        $transaction = Transaction::first();

        // Sending a POST request to the transaction mark as paid route with the transaction ID
        $this->post(route('transaction.mark.as.paid', $transaction->id))
            ->assertStatus(302);

        // Asserting that the transaction status is 'paid'
        expect(Transaction::first()->status)->toBe('paid');
    }

    public function test_accountant_mark_as_paid()
    {
        // Creating a user with the 'Accountant' role
        $user = User::factory()->create([
            'role' => 'Accountant',
        ]);

        // Seeding the required settings
        $this->seed(SettingSeeder::class);

        // Authenticating the user
        $this->actingAs($user);

        // Seeding one TransactionType record
        TransactionType::factory(1)->create();

        // Creating one Transaction record with 'unpaid' status
        Transaction::factory()->count(1)->create([
            'status' => 'unpaid',
        ]);

        // Getting the first transaction from the database
        $transaction = Transaction::first();

        // Sending a POST request to the transaction mark as paid route with the transaction ID
        $this->post(route('transaction.mark.as.paid', $transaction->id))
            ->assertStatus(302);

        // Asserting that the transaction status is 'paid'
        expect(Transaction::first()->status)->toBe('paid');
    }

    public function testAdminTransactionExportXlsx()
    {
        // Creating a user with the 'Admin' role
        $user = User::factory()->create([
            'role' => 'Admin',
        ]);

        // Authenticating the user
        $this->actingAs($user);

        // Sending a POST request to the transaction export route with the export type and month
        $response = $this->post(route('report.transaction.export'), ['type' => 'xlsx', 'month' => 'this_month']);

        // Asserting the response status code
        $response->assertStatus(Response::HTTP_OK);

        // Asserting the response headers
        $response->assertHeader('Content-Type', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        $response->assertHeader('Content-Disposition', 'attachment; filename=transaction.xlsx');
    }

    public function testAccountantTransactionExportXlsx()
    {
        // Creating a user with the 'Accountant' role
        $user = User::factory()->create([
            'role' => 'Accountant',
        ]);

        // Authenticating the user
        $this->actingAs($user);

        // Sending a POST request to the transaction export route with the export type and month
        $response = $this->post(route('report.transaction.export'), ['type' => 'xlsx', 'month' => 'this_month']);

        // Asserting the response status code
        $response->assertStatus(Response::HTTP_OK);

        // Asserting the response headers
        $response->assertHeader('Content-Type', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        $response->assertHeader('Content-Disposition', 'attachment; filename=transaction.xlsx');
    }

    public function testTransactionExportPdf()
    {
        // Sending a POST request to the transaction export route with the export type and month
        $response = $this->post(route('report.transaction.export'), ['type' => 'pdf', 'month' => 'this_month']);

        // Asserting the initial response status code
        $response->assertStatus(Response::HTTP_FOUND);

        // Following the redirect
        $response = $this->followRedirects($response);

        // Asserting the final response status code
        $response->assertStatus(Response::HTTP_OK);

        // Asserting the response header for content type
        $response->assertHeader('Content-Type', 'text/html; charset=UTF-8');  //application/pdf generate hobar kotha but generate hocche text/html; charset=UTF-8
    }

    public function rolePermission()
    {
        $roleSuperAdmin = Role::create([
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
        $permissions = [
            [
                'group_name' => 'transaction',
                'permissions' => [
                    'transaction.index',
                    'transaction.create',
                    'transaction.show',
                    'transaction.edit',
                    'transaction.destroy',
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
            'transaction.index',
            'transaction.create',
            'transaction.show',
            'transaction.edit',
            'transaction.destroy',
        ]);

        $roleAccountant->givePermissionTo([
            'transaction.index',
            'transaction.create',
            'transaction.show',
            'transaction.edit',
            'transaction.destroy',
        ]);
    }
}
