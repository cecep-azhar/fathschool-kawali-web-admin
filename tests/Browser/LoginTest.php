<?php

namespace Tests\Browser;

use App\Models\TeacherSubject;
use App\Models\User;
use App\Models\UserCourse;
use App\Models\UserProfile;
use Database\Seeders\CurrencySeeder;
use Database\Seeders\Dusk\AssignmentTestSeeder;
use Database\Seeders\Dusk\ClassRoutineTestSeeder;
use Database\Seeders\Dusk\CourseTestSeeder;
use Database\Seeders\Dusk\EventTestSeeder;
use Database\Seeders\Dusk\InvoiceTestSeeder;
use Database\Seeders\Dusk\SubjectTestSeeder;
use Database\Seeders\Dusk\TransactionTestSeeder;
use Database\Seeders\GallerySliderSeeder;
use Database\Seeders\LanguageSeeder;
use Database\Seeders\OnboardingSeeder;
use Database\Seeders\PlanSeeder;
use Database\Seeders\RolePermissionSeeder;
use Database\Seeders\SettingSeeder;
use Database\Seeders\SocialLinkSeeder;
use Database\Seeders\StudentAttendanceSeeder;
use Database\Seeders\TransactionTypeSeeder;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class LoginTest extends DuskTestCase
{
    use DatabaseMigrations;

    /**
     * All role login test and check there dashboard.
     */
    public function test_login_from_different_role(): void
    {
        $this->seed(RolePermissionSeeder::class);

        User::factory()->create([
            'role' => 'Admin',
            'name' => 'Admin Dusk',
            'email' => 'admin@adeveloper.info',
            'password' => bcrypt('password'),
        ]);

        User::factory()->create([
            'role' => 'Teacher',
            'name' => 'Teacher Dusk',
            'email' => 'teacher@adeveloper.info',
            'password' => bcrypt('password'),
        ]);

        User::factory()->create([
            'role' => 'Accountant',
            'name' => 'Accountant Dusk',
            'email' => 'accountant@adeveloper.info',
            'password' => bcrypt('password'),
        ]);

        User::factory()->create([
            'role' => 'Parent',
            'name' => 'Parent Dusk',
            'email' => 'parent@adeveloper.info',
            'password' => bcrypt('password'),
        ]);

        User::factory()->create([
            'role' => 'Student',
            'name' => 'Student Dusk',
            'email' => 'student@adeveloper.info',
            'password' => bcrypt('password'),
        ]);

        $this->seed([
            SocialLinkSeeder::class,
            CurrencySeeder::class,
            LanguageSeeder::class,
            SettingSeeder::class,
            GallerySliderSeeder::class,
            CourseTestSeeder::class,
            PlanSeeder::class,
            SubjectTestSeeder::class,
            ClassRoutineTestSeeder::class,
            AssignmentTestSeeder::class,
            TransactionTypeSeeder::class,
            TransactionTestSeeder::class,
            EventTestSeeder::class,
            OnboardingSeeder::class,
            StudentAttendanceSeeder::class,
            InvoiceTestSeeder::class,
        ]);

        $data = [
            'user_id' => 5,
            'student_id' => 'STD123',
            'roll_no' => '208005s',
            'session' => '2023-2024',
            'plan_id' => 1,
            'blood_group' => 'B+',
        ];

        UserProfile::create($data);

        TeacherSubject::create([
            'teacher_id' => 2,
            'subject_id' => 1,
        ]);

        $student = User::findOrFail(5);
        $student->parents()->attach(4);

        UserCourse::create([
            'user_id' => 5,
            'course_id' => 1,
        ]);

        // Dashboard test start for admin

        $this->browse(function (Browser $browser) {
            $browser->visit('/login')
                ->waitForText('Login')
                ->assertSee('Login')
                ->press('Login')
                ->pause(5000)
                ->waitForText('Email')
                ->waitForText('The email field is required.')
                ->assertSee('The email field is required.')
                ->assertSee('The password field is required.')
                ->typeSlowly('input[id="email"]', 'wrong@email.info')
                ->type('input[id="password"]', 'password')
                ->press('Login')
                ->pause(5000)
                ->waitForText('These credentials do not match our records.')
                ->assertSee('These credentials do not match our records.')
                ->typeSlowly('input[id="email"]', 'admin@adeveloper.info')
                ->type('input[id="password"]', 'password')
                ->press('Login')
                ->pause(6000)
                ->waitFor('.shepherd-cancel-icon')
                ->press('×')
                ->assertSee('Dashboard');
            $browser->script('
            function scrollToBottom() {
                window.scrollTo({ top: document.body.scrollHeight, behavior: "smooth" });
                }
                scrollToBottom();
            ');
            $browser->pause(1500);

            $browser->script('
                function scrollToTop() {
                    window.scrollTo({ top: 0, behavior: "smooth" });
                }

                scrollToTop();

            ');
            $browser->pause(1500);
            $browser->click('img[alt="Admin Dusk"]')
                ->pause(501)
                ->click('a[href="oid(0)"]')
                ->pause(3000)
                ->waitForText('Login')
                ->assertSee('FathSchool');
        });

        // Dashboard test ends for admin
        // Dashboard test start for teacher

        $this->browse(function (Browser $browser) {
            $baseUrl = config('app.url'); // Retrieve the base URL from the environment configuration or set it manually
            $browser->click('a[href="'.$baseUrl.'/login"]')
                ->pause(3000)
                ->waitForText('Login')
                ->assertSee('Login')
                ->waitForText('Email')
                ->typeSlowly('input[id="email"]', 'teacher@adeveloper.info')
                ->type('input[id="password"]', 'password')
                ->press('Login')
                ->pause(5000)
                ->waitFor('.shepherd-cancel-icon')
                ->press('×')
                ->assertSee('Dashboard');
            $browser->script('
                function scrollToBottom() {
                window.scrollTo({ top: document.body.scrollHeight, behavior: "smooth" });
                }
                scrollToBottom();
            ');
            $browser->pause(1500);

            $browser->script('
                function scrollToTop() {
                    window.scrollTo({ top: 0, behavior: "smooth" });
                }

                scrollToTop();

            ');
            $browser->pause(1500);
            $browser->click('img[alt="Teacher Dusk"]')
                ->pause(501)
                ->click('a[href="oid(0)"]')
                ->pause(3001)
                ->waitForLink('Login')
                ->assertSee('FathSchool');
        });

        // Dashboard test ends for Teacher
        // Dashboard test start for Accountant

        $this->browse(function (Browser $browser) {
            $baseUrl = config('app.url'); // Retrieve the base URL from the environment configuration or set it manually
            $browser->click('a[href="'.$baseUrl.'/login"]')
                ->pause(3000)
                ->waitForText('Login')
                ->assertSee('Login')
                ->waitForText('Email')
                ->typeSlowly('input[id="email"]', 'accountant@adeveloper.info')
                ->type('input[id="password"]', 'password')
                ->press('Login')
                ->pause(5000)
                ->waitFor('.shepherd-cancel-icon')
                ->press('×')
                ->assertSee('Dashboard');
            $browser->script('
                    function scrollToBottom() {
                window.scrollTo({ top: document.body.scrollHeight, behavior: "smooth" });
                }
                scrollToBottom();
            ');
            $browser->pause(1500);

            $browser->script('
                function scrollToTop() {
                    window.scrollTo({ top: 0, behavior: "smooth" });
                }

                scrollToTop();

            ');
            $browser->pause(1500);
            $browser->click('img[alt="Accountant Dusk"]')
                ->pause(501)
                ->click('a[href="oid(0)"]')
                ->pause(5000)
                ->waitForText('Login')
                ->assertSee('FathSchool');
        });

        // Dashboard test ends for Accountant
        // Dashboard test start for Student

        $this->browse(function (Browser $browser) {
            $baseUrl = config('app.url'); // Retrieve the base URL from the environment configuration or set it manually
            $browser->click('a[href="'.$baseUrl.'/login"]')
                ->waitForText('Login')
                ->assertSee('Login')
                ->waitForText('Email')
                ->typeSlowly('input[id="email"]', 'student@adeveloper.info')
                ->type('input[id="password"]', 'password')
                ->press('Login')
                ->waitFor('.shepherd-cancel-icon')
                ->press('×')
                ->assertSee('Dashboard');
            $browser->script('
                    function scrollToBottom() {
                window.scrollTo({ top: document.body.scrollHeight, behavior: "smooth" });
                }
                scrollToBottom();
            ');
            $browser->pause(1500);

            $browser->script('
                function scrollToTop() {
                    window.scrollTo({ top: 0, behavior: "smooth" });
                }

                scrollToTop();

            ');
            $browser->pause(1500);
            $browser->click('img[alt="Student Dusk"]')
                ->pause(501)
                ->click('a[href="oid(0)"]')
                ->waitForText('Login')
                ->assertSee('FathSchool');
        });

        // Dashboard test ends for Student
        // Dashboard test start for Parent

        $this->browse(function (Browser $browser) {
            $baseUrl = config('app.url'); // Retrieve the base URL from the environment configuration or set it manually
            $browser->click('a[href="'.$baseUrl.'/login"]')
                ->waitForText('Login')
                ->assertSee('Login')
                ->waitForText('Email')
                ->typeSlowly('input[id="email"]', 'parent@adeveloper.info')
                ->type('input[id="password"]', 'password')
                ->press('Login')
                ->waitFor('.shepherd-cancel-icon')
                ->press('×')
                ->assertSee('Dashboard');
            $browser->script('
                    function scrollToBottom() {
                window.scrollTo({ top: document.body.scrollHeight, behavior: "smooth" });
                }
                scrollToBottom();
            ');
            $browser->pause(1500);

            $browser->script('
                function scrollToTop() {
                    window.scrollTo({ top: 0, behavior: "smooth" });
                }

                scrollToTop();

            ');
            $browser->pause(1500);
            $browser->click('img[alt="Parent Dusk"]')
                ->pause(501)
                ->click('a[href="oid(0)"]')
                ->waitForText('Login')
                ->assertSee('FathSchool');
        });

        // Dashboard test ends for Parent
    }
}
