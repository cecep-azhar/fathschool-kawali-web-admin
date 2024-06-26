<?php

namespace Tests\Browser;

use App\Models\Notice;
use App\Models\User;
use Database\Seeders\AdmissionFormSeeder;
use Database\Seeders\CurrencySeeder;
use Database\Seeders\DepartmentSeeder;
use Database\Seeders\Dusk\CourseTestSeeder;
use Database\Seeders\Dusk\NoticeTestSeeder;
use Database\Seeders\GallerySliderSeeder;
use Database\Seeders\LanguageSeeder;
use Database\Seeders\RolePermissionSeeder;
use Database\Seeders\SettingSeeder;
use Database\Seeders\SocialLinkSeeder;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class HomeTest extends DuskTestCase
{
    use DatabaseMigrations;

    /*** A basic browser test Visit Home Page.*/

    public function test_home_notice_and_student_admission_request_with_admin_approve(): void
    {
        $this->seed(
            RolePermissionSeeder::class,
        );
        // Create an admin user
        User::factory()->create([
            'role' => 'Admin',
            'name' => 'Admin Dusk',
            'email' => 'email@adeveloper.info',
        ]);

        // Seed necessary data for testing
        $this->seed([
            SettingSeeder::class,
            GallerySliderSeeder::class,
            LanguageSeeder::class,
            SocialLinkSeeder::class,
            CurrencySeeder::class,
            AdmissionFormSeeder::class,
            CourseTestSeeder::class,
            NoticeTestSeeder::class,

            // seed for admin login.
            DepartmentSeeder::class,
        ]);

        // Browse the homepage using Laravel Dusk
        $this->browse(function (Browser $browser) {

            // Visit the homepage and test home page view

            $browser->visit('/')
                ->pause(1000)
                ->assertSee('Schooling');

            $this->scroll($browser);
            $browser->pause(1500);

            // Get the current date
            $today = now();

            // Set paths for image files
            $kidImagePath = base_path('tests/Browser/picture/kid.jpg');
            $parentImagePath = base_path('tests/Browser/picture/parent.jpg');
            $documentImage0Path = base_path('tests/Browser/picture/document.jpg');

            // Perform admission request actions with validation check
            $browser->click('a[href="/admission"]')
                ->pause(3000)
                ->waitForText("Let's work together")
                ->assertSee("Let's work together");

            $this->scrollToBottom($browser);

            // validation testing

            $browser->pause(2500);
            $browser->press('Submit Admission Request')
                ->pause(1500);

            $this->scrollToTop($browser);
            $browser->pause(1500)
                ->waitForText('The name field is required.')
                ->assertSee('The name field is required.')
                ->assertSee('The email field is required.')
                ->assertSee('The date of birth field is required.')
                ->assertSee('The gender field is required.')
                ->assertSee('The classes field is required.')
                ->scrollIntoView('input[id="parent_name"]')
                ->assertSee('The parent name field is required.')
                ->assertSee('The parent email field is required.');

            // validation testing done
            // New admission testing

            $this->scrollToTop($browser);

            $browser->type('input[id="name"]', 'Opu Saha')
                ->type('input[id="email"]', 'sahaapo@gmail.com')
                ->attach('input[type="file"][accept="image/*"][capture="false"]', $kidImagePath)
                ->keys('input[id="date_of_birth"]', $today->day)
                ->keys('input[id="date_of_birth"]', $today->month)
                ->keys('input[id="date_of_birth"]', $today->year)
                ->type('input[id="gender"]', 'Male')
                ->type('input#classes', 'One');

            // Scroll to half of the page height
            $this->scrollToHalfHeight($browser);

            $browser->pause(1001)
                ->keys('input#classes', '{enter}')
                ->type('input[id="phone"]', '01616657585')
                ->type('textarea[id="address"]', 'Narsingdi, Dhaka, Bangladesh')
                ->type('input[id="title0"]', 'Valid Document')
                ->type('input[id="document0"]', $documentImage0Path)
                ->type('input[id="national_identification_number"]', '500500500500')
                ->type('input#blood_group', 'b+');

            // Scroll to the bottom of the page
            $this->scrollToBottom($browser);

            $browser->pause(1001)
                ->keys('input#blood_group', '{enter}')
                ->type('input[id="physical_disability"]', 'No')
                ->type('input[id="previous_school_name"]', 'My previous school name')
                ->type('input[id="previous_school_year_of_exist"]', '2022')
                ->type('input[id="religion"]', 'Sanatan')
                ->type('input[id="bank_name"]', 'Bangladesh Bank')
                ->type('input[id="bank_account_number"]', '34921')
                ->type('textarea[id="note"]', 'My Note')
                ->type('input[id="parent_name"]', 'My parent')
                ->type('input[id="parent_email"]', 'lomeyo@adeveloper.info')
                ->attach('input[id="parent_image_id"]', $parentImagePath)
                ->pause(1001)
                ->press('Submit Admission Request')
                ->pause(2001);

            // Scroll to the top of the page
            $this->scrollToTop($browser);

            $browser->pause(2600)
                ->waitForText('Admission request sent.')
                ->assertSee('Admission request sent.');

            // New admission testing done
            // Navigate to the announcements page for testing

            $browser->click('a[href="/announcement"]')
                ->pause(2000)
                ->waitForText('Recent Announcements')
                ->assertSee('Recent Announcements');
            $this->scroll($browser);
            $notice = Notice::findOrFail(6);
            $baseUrl = config('app.url'); // Retrieve the base URL from the environment configuration or set it manually

            $slug = $notice->slug;

            // Scroll to half of the page height
            $this->scrollToHalfHeight($browser);

            $browser->waitForText('Notice On Shab-e-barat')
                ->assertSee('Notice On Shab-e-barat');

            // announce page testing done
            // announce details page testing

            $browser->click('a.mt-4.block[href="'.$baseUrl.'/announcement/'.$slug.'"]')
                ->pause(1500)
                ->waitForText('The university shall remain closed on March 08')
                ->assertSee('The university shall remain closed on March 08');
            $this->scroll($browser);
            $browser->pause(1500);

            // announce details page testing done
            // return back to home page

            $browser->click('a[href="/"]')
                ->pause(1500)
                ->waitForText('Schooling')
                ->assertSee('Schooling');

            // Login as admin for approve admission
            $admin = User::findOrFail(1);
            $browser->loginAs($admin)
                ->visit('/student/admission')
                ->waitForText('Opu Saha')
                ->assertSee('Opu Saha')
                ->waitFor('.shepherd-cancel-icon')
                ->press('×')
                ->click('a.group.relative[href="'.$baseUrl.'/student/admission/1"]')
                ->pause(10000)
                ->waitForText('Opu Saha')
                ->assertSee('Opu Saha');

            $browser->click('a[href="'.$baseUrl.'/student/admission/request/accept/1"]')

                ->pause(3000)
                ->waitFor('button[type="button"].bg-blue-500')
                ->click('button[type="button"].bg-blue-500')
                ->pause(1500);
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

    private function scrollToBottom(Browser $browser)
    {
        $browser->script('
        function scrollToBottom() {
            window.scrollTo({ top: document.body.scrollHeight, behavior: "smooth" });
        }

        scrollToBottom();
    ');
    }

    private function scrollToTop(Browser $browser)
    {
        $browser->script('
        function scrollToTop() {
            window.scrollTo({ top: 0, behavior: "smooth" });
        }

        scrollToTop();
    ');
    }

    private function scrollToHalfHeight(Browser $browser)
    {
        $browser->script('
        function scrollToHalfHeight() {
            const halfHeight = window.innerHeight / 2;
            window.scrollTo(0, halfHeight);
        }

        scrollToHalfHeight();
    ');
    }
}
