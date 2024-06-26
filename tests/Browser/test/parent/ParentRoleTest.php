<?php

namespace Tests\Browser;

use App\Models\Exam;
use App\Models\TeacherSubject;
use App\Models\User;
use App\Models\UserCourse;
use App\Models\UserProfile;
use Database\Seeders\ClassRoutineSeeder;
use Database\Seeders\CurrencySeeder;
use Database\Seeders\Dusk\AssignmentTestSeeder;
use Database\Seeders\Dusk\CourseTestSeeder;
use Database\Seeders\Dusk\InvoiceTestSeeder;
use Database\Seeders\Dusk\StudentAttendanceTestSeeder;
use Database\Seeders\Dusk\SubjectTestSeeder;
use Database\Seeders\ExamResultSeeder;
use Database\Seeders\ExamSeeder;
use Database\Seeders\GradeSeeder;
use Database\Seeders\LanguageSeeder;
use Database\Seeders\OnboardingSeeder;
use Database\Seeders\PlanSeeder;
use Database\Seeders\RolePermissionSeeder;
use Database\Seeders\SettingSeeder;
use Database\Seeders\SocialLinkSeeder;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class ParentRoleTest extends DuskTestCase
{
    use DatabaseMigrations;

    /**
     * A Dusk parent role test example.
     */
    public function testParentRole(): void
    {
        // Seed role permissions
        $this->seed(RolePermissionSeeder::class);

        // Create user roles
        User::factory()->create([
            'role' => 'Admin',
        ]);

        User::factory()->create([
            'role' => 'Teacher',
            'email' => 'lomeyo@adeveloper.info',
        ]);

        User::factory()->create([
            'role' => 'Accountant',
        ]);

        $parent = User::factory()->create([
            'role' => 'Parent',
            'name' => 'Parent Dusk',
            'email' => 'sahaapo@gmail.com',
            'password' => bcrypt('password'),
        ]);

        // Create a student user
        $student = User::factory()->create([
            'role' => 'Student',
            'name' => 'Student Dusk',
        ]);

        $this->seed([
            OnboardingSeeder::class,
            InvoiceTestSeeder::class,
            SocialLinkSeeder::class,
            CurrencySeeder::class,
            LanguageSeeder::class,
            SettingSeeder::class,
            CourseTestSeeder::class,
            SubjectTestSeeder::class,
            PlanSeeder::class,
            StudentAttendanceTestSeeder::class,
            AssignmentTestSeeder::class,
            GradeSeeder::class,
            ExamSeeder::class,
            ExamResultSeeder::class,
            ClassRoutineSeeder::class,
        ]);

        $student->parents()->attach(4);

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

        UserCourse::create([
            'user_id' => 5,
            'course_id' => 1,
        ]);

        $this->browse(function (Browser $browser) use ($parent) {
            // Login as the student and visit the dashboard
            $browser->loginAs($parent)
                ->visit('/dashboard')
                ->waitFor('.shepherd-cancel-icon')
                ->press('×')
                ->waitForText('Dashboard')
                ->assertSee('Dashboard');

            // Scroll to the bottom of the page
            $this->scroll($browser);

            $browser->click('img[alt="Student Dusk"]')
                ->waitForText('Children')
                ->assertSee('Children');

            // Scroll to the bottom of the page
            $this->scroll($browser);

            $browser->clickLink('Fees Payment')
                ->waitForText('All Transaction');

            // Scroll to the bottom of the page
            $this->scroll($browser);

            // Scroll to half of the page height
            $browser->script('
            function scrollToHalfHeight() {
                const halfHeight = window.innerHeight / 3;
                window.scrollTo(0, halfHeight);
            }

            scrollToHalfHeight();
            ');

            // Clicks on the element with the specified label attribute
            $browser->click('label[for="paid"]')
                ->waitFor('button[type="submit"]')
                ->press('Search')
                ->pause(5000);

            // Clicks on the 'Assignment' link and waits for the 'Assignment List' text to appear
            $browser->clickLink('Assignment')
                ->waitForText('Assignment List')
                ->assertSee('Assignment List');

            // Scrolls the page
            $this->scroll($browser);

            // Clicks on the 'Attendance' link and waits for the 'All Attendance' text to appear
            $browser->clickLink('Attendance')
                ->waitForText('All Attendance')
                ->assertSee('All Attendance');

            // Scrolls the page
            $this->scroll($browser);

            // Clicks on the 'Class Schedule' link and waits for the 'Today' text to appear
            $browser->clickLink(' Class Schedule')
                ->waitForText('Today')
                ->assertSee('Today');

            // Presses the buttons with the specified names
            $browser->press('Prev')
                ->pause(500)
                ->press('Next')
                ->pause(500)
                ->press('Month')
                ->pause(500)
                ->press('Week')
                ->pause(500)
                ->press('Day');

            // Clicks on the 'Exam & Results' link and waits for the 'Preview Result Sheets' text to appear
            $browser->clickLink(' Exam & Results')
                ->waitForText('Preview Result Sheets')
                ->assertSee('Preview Result Sheets');

            // Scrolls the page
            $this->scroll($browser);

            $browser->press('Preview Result Sheets')
                ->pause(8000);
        });
    }

    private function scroll(Browser $browser)
    {
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
        $browser->pause(1000);
    }
}
