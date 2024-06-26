<?php

namespace Tests\Browser;

use App\Models\User;
use Database\Seeders\CurrencySeeder;
use Database\Seeders\Dusk\CourseTestSeeder;
use Database\Seeders\Dusk\EventTestSeeder;
use Database\Seeders\Dusk\InvoiceTestSeeder;
use Database\Seeders\Dusk\NoticeTestSeeder;
use Database\Seeders\Dusk\TransactionTestSeeder;
use Database\Seeders\Dusk\TransactionTypeTestSeeder;
use Database\Seeders\LanguageSeeder;
use Database\Seeders\LeaveTypeSeeder;
use Database\Seeders\RolePermissionSeeder;
use Database\Seeders\SettingSeeder;
use Database\Seeders\SocialLinkSeeder;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class AccountantRoleTest extends DuskTestCase
{
    use DatabaseMigrations;

    /**
     * A Dusk test example.
     */
    public function testAccountantRole(): void
    {
        // Seed role permissions
        $this->seed(RolePermissionSeeder::class);

        // Create user roles
        User::factory()->create([
            'role' => 'Admin',
        ]);

        // Create a teacher user
        User::factory()->create([
            'role' => 'Teacher',
        ]);

        $accountant = User::factory()->create([
            'role' => 'Accountant',
            'email' => 'lomeyo@adeveloper.info',
            'password' => 'password',
            'name' => 'Accountant Dusk',
        ]);

        // Create a parent user
        User::factory()->create([
            'role' => 'Parent',
        ]);

        // Create a student user
        User::factory()->create([
            'role' => 'Student',
            'name' => 'Student Dusk',
            'email' => 'sahaapo@gmail.com',
        ]);

        $this->seed([
            EventTestSeeder::class,
            TransactionTypeTestSeeder::class,
            TransactionTestSeeder::class,
            SocialLinkSeeder::class,
            CourseTestSeeder::class,
            CurrencySeeder::class,
            LanguageSeeder::class,
            SettingSeeder::class,
            InvoiceTestSeeder::class,
            NoticeTestSeeder::class,
            LeaveTypeSeeder::class,
        ]);

        $this->browse(function (Browser $browser) use ($accountant) {
            $browser->loginAs($accountant);

            //  // Start Dashboard test
            //  // Start Dashboard test

            $browser->visit('/dashboard')
                ->waitFor('.shepherd-cancel-icon')
                ->press('×')
                ->waitForText('Dashboard')
                ->assertSee('Dashboard');

            $browser->click('#testMonth')
                ->pause(5000)
                ->click('#testYear')
                ->pause(5000);

            $this->scroll($browser);

            //  // End Dashboard test
            //  // End Dashboard test

            // // //  // Start Transaction test
            // // //  // Start Transaction test
            $bill = base_path('tests/Browser/picture/scan.png');

            $browser->clickLink('Add Transaction')
                ->waitForText('Transaction Create')
                ->assertSee('Transaction Create')

                // check new transaction validation message
                ->press('Save')
                ->waitForText('The title field is required.')
                ->assertSee('The title field is required.')
                ->assertSee('The type field is required.')
                ->assertSee('The amount field is required.')
                ->assertSee('The date field is required.')

                // input data in
                ->type('#title', 'Test transaction check')
                ->type('#type', 'Rent ( Expense )')
                ->pause(200)
                ->keys('#type', '{enter}')
                ->type('#currency', 'uni')
                ->pause(200)
                ->keys('#currency', '{enter}')
                ->type('#amount', 50)
                ->click('#testDate')
                ->click('.ant-picker-today-btn')
                ->type('#payment_method', 'Cash')
                ->type('#description', 'We paid utility bills')
                ->attach('#document', $bill);

            // browser scroll to bottom for click save button
            $this->scrollToBottom($browser);

            $browser->press('Save')
                ->waitForText('Add New Transaction')
                ->assertSee('Add New Transaction');

            $today = date('Y-m-d');
            $startDay = date('Y-m-d', strtotime($today.' -7 day'));
            $this->scroll($browser);

            $browser->waitFor('#testEditTransaction16')
                ->click('#testEditTransaction16')
                ->waitForText('Transaction Edit')
                ->assertSee('Transaction Edit')
                ->type('#description', 'We paid electricity bills for this year.')
                ->type('#payment_method', 'Chaque')
                ->press('Save')            //Edit page er modification lagbe, tai full edit check hoi nai.
                ->waitForText('All Transaction')
                ->assertSee('All Transaction');

            $browser->waitFor('#testEditTransaction16')
                ->click('#testDeleteTransaction16')
                ->pause(500)
                ->waitForDialog()
                ->acceptDialog()
                ->waitForText('Transaction deleted')
                ->assertSee('Transaction deleted');

            // // // End Transaction page test
            // // // End Transaction page test

            // // Start Recurring invoice page
            // // start Recurring invoice page

            $browser->clickLink('Recurring Invoice')
                ->waitForText('INVOICE NO')
                ->assertSee('INVOICE NO')
                ->click('#testInvoiceButton')
                ->waitForText('Invoice Type')
                ->type('textarea[id="description"]', 'Description 1')
                ->type('#amount', '50')
                ->click('#testAddItem')
                ->click('#testRemoveItem')
                ->attach('#document', $bill)
                ->type('#message', 'This is a message for testing invoice')
                ->click('#recurring_invoice')
                ->pause(200)
                ->type('#recurring_days', 30)
                ->press('Save')
                // ->typeSlowly('#recipient','Student')
                // ->keys('#recipient','{enter}')
                ->type('#invoice_title', 'Student Invoice 001')
                ->check('#paid');

            // Scroll to half of the page height
            $this->scrollHalf($browser);

            $browser->click('input[placeholder="Select Date"]')
                ->click('.ant-picker-today-btn')
                ->click('#due_date_in')
                ->click('#due_date_in-multiselect-option-10')
                ->press('Create New Invoice')
                ->waitForTextIn('#testInvoiceDataTable', 'Student Dusk');

            $browser->click('#testInvoiceEdit6')
                ->waitForText('Edit Recurring Invoice')
                ->assertSee('Edit Recurring Invoice')
                ->type('textarea[id="description"]', 'Update Description for 1')
                ->type('#amount', '500')
                ->attach('#document', $bill)
                ->type('#message', 'This is a message for testing Update invoice')
                ->click('#recurring_invoice')
                ->pause(200)
                ->type('#recurring_days', 10)
                ->press('Save')
                ->type('#recipient', 'Stu')
                ->pause(200)
                ->keys('#recipient', '{enter}')
                ->type('#invoice_title', 'Student Invoice Update 001')
                ->check('#paid');

            // Scroll to half of the page height
            $browser->script('
                function scrollToHalfHeight() {
                    const halfHeight = window.innerHeight / 2;
                    window.scrollTo(0, halfHeight);
                }

                scrollToHalfHeight();
            ');

            $browser->click('input[placeholder="Select Date"]')
                ->click('.ant-picker-today-btn')
                ->click('#due_date_in')
                ->click('#due_date_in-multiselect-option-30')
                ->press('Edit Invoice')
                ->waitForTextIn('#testInvoiceDataTable', 'Student Dusk');

            $browser->click('#testInvoiceSendEmail6')
                ->pause(6000)
                ->click('#testInvoiceDelete6')
                ->pause(500)
                ->waitForDialog()
                ->acceptDialog()
                ->pause(5000);

            // End Recurring invoice page
            // End Recurring invoice page

            // Start Transaction Categories page
            // start Transaction Categories page

            $browser->clickLink('Transaction Categories')
                ->waitForText('Add New Category')
                ->assertSee('Add New Category')
                ->type('#name', 'Fees for Student')
                ->press('Save')
                ->waitForText('Type saved !')
                ->assertSee('Type saved !');

            $browser->click('#transactionTypeEdit4')
                ->type('#name', 'Update Fees for Student')
                ->press('Save')
                ->waitForText('Type updated !')
                ->assertSee('Type updated !');

            $browser->click('#transactionTypeDelete4')
                ->pause(500)
                ->waitForDialog()
                ->acceptDialog()
                ->waitForText('Type deleted !')
                ->assertSee('Type deleted !');

            // // // End Transaction Categories page
            // // // End Transaction Categories page

            // // Start Admission Plan page
            // // start Admission Plan page

            $baseUrl = config('app.url'); // Retrieve the base URL from the environment configuration or set it manually
            $browser->clickLink('Admission Plan')
                ->waitForText('Add New Plan')
                ->assertSee('Add New Plan')
                ->click('a[href="'.$baseUrl.'/plan/create"]')
                ->waitForText('Submit')
                ->type('#title', 'Advance')
                ->type('#course', 'one')
                ->keys('#course', '{enter}')
                ->type('#currency', 'uni')
                ->pause(200)
                ->keys('#currency', '{enter}')
                ->type('#description', 'Advance course for all')
                ->type('input[placeholder="Benefit"]', 'Extra Care')
                ->type('input[placeholder="Amount"]', 500)
                ->press('Submit')
                ->waitForText('Plan 1')
                ->assertSee('Plan 1')

                // // // edit plan

                ->click('#editPlan1')
                ->waitForText('Update')
                ->pause(2000)
                ->type('#title', 'Advance updated plan')
                ->type('#description', 'Advance course for all')
                ->type('input[placeholder="Benefit"]', 'Extra Care Update Plus')
                ->type('input[placeholder="Amount"]', 5000)
                ->press('Update')
                ->waitForText('Plan 1')
                ->assertSee('Plan 1')

                // delete plan
                ->click('#deletePlan1')
                ->pause(500)
                ->waitForDialog()
                ->acceptDialog()
                ->waitForText('Plan Deleted Successful')
                ->assertSee('Plan Deleted Successful');

            // // // Ends Admission Plan page
            // // // Ends Admission Plan page

            // // Starts  Meeting Page
            // // Starts  Meeting Page
            $browser->clickLink('Meeting')
                ->waitForText('Add Meeting')
                ->assertSee('Add Meeting')
                ->press('Add Meeting')
                ->pause(500);

            $today = now();
            $browser->type('#topic', 'Student Promotion')
                ->keys('input[id="start_date"]', $today->day)
                ->keys('input[id="start_date"]', $today->month)
                ->keys('input[id="start_date"]', $today->year)
                ->pause(200)
                ->click('a[class="ant-picker-now-btn"]')
                ->type('#password', 'password')
                ->click('#all_user')
                ->type('#description', 'Lets discus about student promotion')
                ->press('Save')
                ->waitForText('Meeting Successfully Created')
                ->assertSee('Meeting Successfully Created');

            $browser->pause(1000)
                ->press('Add Meeting')
                ->press('Save')
                ->waitForText('The topic field is required.')
                ->assertSee('The topic field is required.')
                // ->assertSee('The start date field is required.')
                ->assertSee('The password field is required.')
                // ->assertSee('The participants field is required.')
                ->pause(1000)
                ->click('button[aria-label="Close"]');

            // view meeting
            $browser->click('#viewMeeting1')
                ->pause(1000)
                ->press('Close');

            // delete Meeting
            $browser->click('#deleteMeeting1')
                ->pause(500)
                ->waitForDialog()
                ->acceptDialog()
                ->waitForText('Meeting Successfully Deleted')
                ->assertSee('Meeting Successfully Deleted');

            // // Ends  Meeting Page
            // // Ends  Meeting Page

            // // Starts Leave Request Page
            // // Starts Leave Request Page

            $browser->clickLink('Leave Request')
                ->waitForText('Total Approved Leave')
                ->assertSee('Total Approved Leave');
            $this->scroll($browser);

            $today = date('Y-m-d');
            $tomorrow = date('Y-m-d', strtotime($today.' +1 day'));
            $browser->press('New Leave Request')
                ->pause(200)
                ->click('input[placeholder="Start Time"]')
                ->click('td[title="'.$today.'"]')
                ->press('Ok')
                ->click('input[placeholder="End Time"]')
                ->click('td[title="'.$tomorrow.'"]')
                ->press('Ok')
                ->type('#name', 'Today I am going to Dhaka. So i need leave for today.')
                ->press('Save')
                ->waitForText('Leave request submitted')
                ->assertSee('Leave request submitted')
                ->pause(2000);

            // // Ends Leave Request Page
            // // Ends Leave Request Page

            // // Starts Notice Board Page
            // // Starts Notice Board Page

            $browser->clickLink('Notice Board')
                ->waitForText('Notice On Shab-e-barat’')
                ->assertSee('Notice On Shab-e-barat’');
            $this->scroll($browser);

            // Notice details page
            $browser->clickLink('Notice On Shab-e-barat’')
                ->waitForText('Write A Comment')
                ->assertSee('Write A Comment')
                ->type('#comment', 'I am commenting.')
                ->press('Publish')
                ->waitForTextIn('#commentSection', 'I am commenting.')
                ->click('#editComment1')
                ->pause(200)
                ->type('#comment', 'I need to update my comment.')
                ->press('Publish')
                ->waitForTextIn('#commentSection', 'I need to update my comment.');

            // delete comment
            $browser->click('#deleteComment1')
                ->pause(200)
                ->waitForDialog()
                ->acceptDialog()
                ->waitForText('Comment deleted')
                ->assertSee('Comment deleted');

            // // Ends Notice Board Page
            // // Ends Notice Board Page
        });
    }

    private function scroll(Browser $browser)
    {
        // Scroll to the bottom of the page
        $browser->script('
            function scrollToBottom() {
                window.scrollTo({ top: document.body.scrollHeight, behavior: "smooth" });
            }

            scrollToBottom();
        ');

        // Pause for 1.5 seconds after scrolling to the bottom
        $browser->pause(1500);

        // Scroll to the top of the page
        $browser->script('
            function scrollToTop() {
                window.scrollTo({ top: 0, behavior: "smooth" });
            }

            scrollToTop();
        ');

        // Pause for 1 second after scrolling to the top
        $browser->pause(1000);
    }

    private function scrollHalf(Browser $browser)
    {
        $browser->script('
        function scrollToHalfHeight() {
            const halfHeight = window.innerHeight / 2;
            window.scrollTo(0, halfHeight);
        }

        scrollToHalfHeight();
    ');
    }

    private function scrollToBottom(Browser $browser)
    {
        // Scroll to the bottom of the page
        $browser->script('
                function scrollToBottom() {
                    window.scrollTo({ top: document.body.scrollHeight, behavior: "smooth" });
                }

                scrollToBottom();
            ');

        // Pause for 1.5 seconds after scrolling to the bottom
        $browser->pause(1000);
    }
}
