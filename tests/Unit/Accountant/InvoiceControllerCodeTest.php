<?php

use App\Models\Invoice;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Artisan;
use Inertia\Testing\AssertableInertia;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class InvoiceControllerCodeTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    public function setUp(): void
    {
        parent::setUp();
        $this->rolePermission();
    }

    public function testAccountantAccessingInvoiceIndexPage()
    {
        // Create an Accountant user
        $user = User::factory()->create([
            'role' => 'Accountant',
        ]);

        // Act: Authenticate as the Accountant user
        $this->actingAs($user);

        // Arrange: Send a GET request to the invoice index page
        $response = $this->get(route('invoice.index'));

        // Assert: Check the response
        $response->assertStatus(200);
        $response->assertInertia(function (AssertableInertia $page) {
            // Verify that an Accountant user can access the invoice index page and the correct Inertia component is rendered
            $page->component('Accountant/Invoice/Index');

        });
    }

    public function testNonAccountantAccessingInvoiceIndexPage()
    {
        // Create a user with a random role other than "Accountant"
        $user = User::factory()->create([
            'role' => collect(['Admin', 'Teacher', 'Parent', 'Student'])->random(),
        ]);

        // Act: Authenticate as the non-Accountant user
        $this->actingAs($user);

        // Arrange: Send a GET request to the invoice index page
        $response = $this->get(route('invoice.index'));

        // Assert: Check the response status is 403 (forbidden)
        $response->assertStatus(403);
    }

    public function testAccountantInvoiceIndexPageIfDataAvailable()
    {
        // Create a user
        $this->createUser();

        // Seed the database with invoice data
        Artisan::call('db:seed', ['--class' => 'InvoiceSeeder']);

        // Create an Accountant user
        $user = User::factory()->create([
            'role' => 'Accountant',
        ]);

        // Act: Authenticate as the Accountant user
        $this->actingAs($user);

        // Arrange: Send a GET request to the invoice index page
        $response = $this->get(route('invoice.index'));

        // Assert: Check the response status is 200 (success)
        // and verify if the response data contains at least one invoice
        $response->assertStatus(200);
        $response->assertInertia(function (AssertableInertia $page) {
            $page->component('Accountant/Invoice/Index')
                ->tap(function ($page) {
                    $page->has('invoices.data.0');
                });
        });
    }

    public function testAccountantInvoiceIndexPageIfDataUnavailable()
    {
        // Create an Accountant user
        $user = User::factory()->create([
            'role' => 'Accountant',
        ]);

        // Act: Authenticate as the Accountant user
        $this->actingAs($user);

        // Arrange: Send a GET request to the invoice index page
        $response = $this->get(route('invoice.index'));

        // Assert: Check the response status is 200 (success)
        // and verify if the response data does not contain any invoices
        $response->assertStatus(200);
        $response->assertInertia(function (AssertableInertia $page) {
            $page->component('Accountant/Invoice/Index')
                ->tap(function ($page) {
                    $page->missing('invoices.data.0');
                });
        });
    }

    public function testAccountantAccessingCreateIndexPage()
    {
        // Create an Accountant user
        $user = User::factory()->create([
            'role' => 'Accountant',
        ]);

        // Act: Authenticate as the Accountant user
        $this->actingAs($user);

        // Arrange: Send a GET request to the invoice create page
        $response = $this->get(route('invoice.create'));

        // Assert: Check the response status is 200 (success)
        // and verify if the response data corresponds to the expected Inertia component
        $response->assertStatus(200);
        $response->assertInertia(function (AssertableInertia $page) {
            $page->component('Accountant/Invoice/Create');
        });
    }

    public function testNonAccountantAccessingInvoiceCreatePage()
    {
        // Create a non-Accountant user with a random role
        $user = User::factory()->create([
            'role' => collect(['Admin', 'Teacher', 'Parent', 'Student'])->random(),
        ]);

        // Act: Authenticate as the non-Accountant user
        $this->actingAs($user);

        // Arrange: Send a GET request to the invoice create page
        $response = $this->get(route('invoice.create'));

        // Assert: Check the response status is 403 (forbidden)
        $response->assertStatus(403);
    }

    public function testAccountantCanGenerateNewInvoice()
    {
        // Creating a new user with the 'Accountant' role
        $user = User::factory()->create([
            'role' => 'Accountant',
        ]);

        // Acting as the created user
        $this->actingAs($user);

        // Generating invoice data
        $invoiceData = [
            'date' => now(),
            'due_date_in' => 'date',
            'due_date' => now()->addDays(7),
            'user' => 1,
            'recurring_days' => 30,
            'invoice_number' => $this->faker->unique()->randomNumber(),
            'title' => $this->faker->sentence,
            'message' => $this->faker->paragraph,
            'currency' => 'USD',
            'total_amount' => $this->faker->randomFloat(2, 50, 500),
            'status' => true,
            'recurring' => false,
            'amount' => [50, 50],
            'description' => ['Item 1', 'Item 2'],
        ];

        // Sending a POST request to the invoice store route with the generated invoice data
        $response = $this->post(route('invoice.store'), $invoiceData);

        // Asserting that the response has a 302 status code (redirect)
        $response->assertStatus(302);

        // Asserting that the 'invoices' table in the database has a record with the specified invoice number and title
        $this->assertDatabaseHas('invoices', [
            'invoice_no' => $invoiceData['invoice_number'],
            'title' => $invoiceData['title'],
        ]);
    }

    public function testAccountantFailsToGenerateNewInvoiceForMissingData()
    {
        // Creating a new user with the 'Accountant' role
        $user = User::factory()->create([
            'role' => 'Accountant',
        ]);

        // Acting as the created user
        $this->actingAs($user);

        // Sending a POST request to the invoice store route with an empty array as data
        $this->post(route('invoice.store'), [])
            // Asserting that the session has errors for the specified fields
            ->assertSessionHasErrors(['title', 'invoice_number', 'date', 'due_date_in', 'amount', 'user', 'currency'])
            // Asserting that the response has a 302 status code (redirect)
            ->assertStatus(302);
    }

    public function testAccountantCanShowInvoice()
    {
        $this->createUser();

        // Creating a new user with the 'Accountant' role
        $user = User::factory()->create([
            'role' => 'Accountant',
        ]);

        // Acting as the created user
        $this->actingAs($user);

        // Creating a new invoice using the Invoice factory
        $invoice = Invoice::factory()->create();

        // Sending a GET request to the invoice show route with the invoice ID
        $response = $this->get(route('invoice.show', $invoice->id));

        // Asserting that the response returns an Inertia component called 'Accountant/Invoice/Show'
        $response->assertInertia(function (AssertableInertia $page) {
            $page->component('Accountant/Invoice/Show');
        });
    }

    public function testAccountantAccessingInvoiceEditPage()
    {
        $this->createUser();

        // Creating a new user with the 'Accountant' role
        $user = User::factory()->create([
            'role' => 'Accountant',
        ]);

        // Acting as the created user
        $this->actingAs($user);

        // Creating a new invoice using the Invoice factory
        $invoice = Invoice::factory()->create();

        // Sending a GET request to the invoice edit route with the invoice ID
        $response = $this->get(route('invoice.edit', $invoice->id));

        // Asserting that the response returns an Inertia component called 'Accountant/Invoice/Edit'
        $response->assertInertia(function (AssertableInertia $page) {
            $page->component('Accountant/Invoice/Edit');
        });
    }

    public function testAccountantCanUpdateExistingInvoice()
    {
        $this->createUser();

        // Creating a new user with the 'Accountant' role
        $user = User::factory()->create([
            'role' => 'Accountant',
        ]);

        // Acting as the created user
        $this->actingAs($user);

        // Creating a new invoice using the Invoice factory
        $invoice = Invoice::factory()->create();

        // Generating data to update the invoice
        $updateInvoiceData = [
            'date' => now(),
            'due_date_in' => 'date',
            'due_date' => now()->addDays(8),
            'user' => 1,
            'recurring_days' => 30,
            'invoice_number' => 'Invoice-00001221',
            'title' => 'This is invoice title -updated',
            'message' => 'This is invoice message -updated',
            'currency' => 'USD',
            'total_amount' => $this->faker->randomFloat(2, 50, 500),
            'status' => true,
            'recurring' => false,
            'amount' => [50, 50],
            'description' => ['Item 10', 'Item 20'],
        ];

        // Sending a PUT request to the invoice update route with the updated invoice data
        $response = $this->put(route('invoice.update', $invoice->id), $updateInvoiceData);

        // Asserting that the response has a 302 status code (redirect)
        $response->assertStatus(302);

        // Asserting that the 'invoices' table in the database has a record with the updated title and message
        $this->assertDatabaseHas('invoices', [
            'title' => 'This is invoice title -updated',
            'message' => 'This is invoice message -updated',
        ]);
    }

    public function testAccountantCanNotUpdateExistingInvoiceIfDataMissing()
    {
        $this->createUser();

        // Creating a new user with the 'Accountant' role
        $user = User::factory()->create([
            'role' => 'Accountant',
        ]);

        // Acting as the created user
        $this->actingAs($user);

        // Creating a new invoice using the Invoice factory
        $invoice = Invoice::factory()->create();

        // Generating incomplete data to update the invoice (missing required fields)
        $updateInvoiceData = [
            'message' => 'This is invoice message -updated',
        ];

        // Sending a PUT request to the invoice update route with the incomplete invoice data
        $this->put(route('invoice.update', $invoice->id), $updateInvoiceData)
            // Asserting that the session has errors for the specified required fields
            ->assertSessionHasErrors(['title', 'invoice_number', 'date', 'due_date_in', 'amount', 'user'])
            // Asserting that the response has a 302 status code (redirect)
            ->assertStatus(302);

        // Asserting that the 'invoices' table in the database does not have a record with the updated message
        $this->assertDatabaseMissing('invoices', [
            'message' => 'This is invoice message -updated',
        ]);
    }

    public function testAccountantCanDestroyInvoice()
    {
        $this->createUser();

        // Creating a new user with the 'Accountant' role
        $user = User::factory()->create([
            'role' => 'Accountant',
        ]);

        // Acting as the created user
        $this->actingAs($user);

        // Creating a new invoice using the Invoice factory
        $invoice = Invoice::factory()->create();

        // Sending a DELETE request to the invoice update route with the invoice ID
        $response = $this->delete(route('invoice.update', $invoice->id));

        // Asserting that the response has a 302 status code (redirect)
        $response->assertStatus(302);

        // Asserting that the 'invoices' table in the database has a count of 0 (no invoices exist)
        $this->assertDatabaseCount('invoices', 0);

        // Asserting that the invoice model is missing (deleted)
        $this->assertModelMissing($invoice);
    }

    public function testAccountantCanUpdateExistingInvoiceRecurringStatus()
    {
        $this->createUser();

        // Creating a new user with the 'Accountant' role
        $user = User::factory()->create([
            'role' => 'Accountant',
        ]);

        // Acting as the created user
        $this->actingAs($user);

        // Creating a new invoice using the Invoice factory
        $invoice = Invoice::factory()->create([
            'recurring_status' => 0,
        ]);

        // Generating data to update the invoice, including the recurring status
        $updateInvoiceData = [
            'date' => now(),
            'due_date_in' => 'date',
            'due_date' => now()->addDays(8),
            'user' => 1,
            'recurring_days' => 30,
            'invoice_number' => 'Invoice-00001221',
            'title' => 'This is invoice title -updated',
            'message' => 'This is invoice message -updated',
            'currency' => 'USD',
            'total_amount' => $this->faker->randomFloat(2, 50, 500),
            'status' => true,
            'recurring' => false,
            'amount' => [50, 50],
            'description' => ['Item 10', 'Item 20'],
            'recurring_status' => 1,
        ];

        // Sending a POST request to the invoice recurring status route with the updated invoice data
        $response = $this->post(route('invoice.recurring.status', $invoice->id), $updateInvoiceData);

        // Asserting that the response has a 302 status code (redirect)
        $response->assertStatus(302);

        // Asserting that the 'invoices' table in the database has a record with the updated recurring status
        $this->assertDatabaseHas('invoices', [
            'recurring_status' => $updateInvoiceData['recurring_status'],
        ]);
    }

    public function createUser()
    {
        // Creating an Admin user
        User::create([
            'name' => 'Developer',
            'role' => 'Admin',
            'email' => 'developer@mail.com',
            'password' => bcrypt('password'),
            'date_of_birth' => '1997-01-31',
        ]);

        // Creating an Accountant user
        User::create([
            'name' => 'Accountant',
            'role' => 'Accountant',
            'email' => 'accountant@mail.com',
            'password' => bcrypt('password'),
            'date_of_birth' => '1997-02-01',
        ]);

        // Creating a Teacher user
        User::create([
            'name' => 'Teacher',
            'role' => 'Teacher',
            'email' => 'teacher@mail.com',
            'password' => bcrypt('password'),
            'date_of_birth' => '1995-04-22',
        ]);

        // Creating a Parent user
        User::create([
            'name' => 'Parent',
            'role' => 'Parent',
            'email' => 'parent@mail.com',
            'password' => bcrypt('password'),
            'date_of_birth' => '1996-01-30',
        ]);

        // Creating a Student user
        User::create([
            'name' => 'Student',
            'role' => 'Student',
            'email' => 'student@mail.com',
            'password' => bcrypt('password'),
            'date_of_birth' => '1996-01-25',
        ]);
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
                'group_name' => 'invoice',
                'permissions' => [
                    'invoice.index',
                    'invoice.create',
                    'invoice.store',
                    'invoice.show',
                    'invoice.edit',
                    'invoice.update',
                    'invoice.destroy',
                    'invoice.print',
                    'invoice.demo',
                    'invoice.download',
                    'invoice.send',
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
