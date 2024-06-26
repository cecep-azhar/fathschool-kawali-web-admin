<?php

namespace Tests\Browser;

use App\Models\Assignment;
use App\Models\Notice;
use App\Models\Subject;
use App\Models\Syllabus;
use App\Models\TeacherSubject;
use App\Models\User;
use App\Models\UserCourse;
use App\Models\UserProfile;
use Database\Seeders\ChatGroupSeeder;
use Database\Seeders\ChatGroupUserSeeder;
use Database\Seeders\CurrencySeeder;
use Database\Seeders\Dusk\CourseTestSeeder;
use Database\Seeders\Dusk\EventTestSeeder;
use Database\Seeders\Dusk\InvoiceTestSeeder;
use Database\Seeders\Dusk\NoticeTestSeeder;
use Database\Seeders\Dusk\StudentAttendanceTestSeeder;
use Database\Seeders\Dusk\SubjectTestSeeder;
use Database\Seeders\HolidaySeeder;
use Database\Seeders\LanguageSeeder;
use Database\Seeders\OnboardingSeeder;
use Database\Seeders\OnlineClassSeeder;
use Database\Seeders\PlanSeeder;
use Database\Seeders\RolePermissionSeeder;
use Database\Seeders\SettingSeeder;
use Database\Seeders\SocialLinkSeeder;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class StudentTest extends DuskTestCase
{
    use DatabaseMigrations;

    /**
     * A Dusk test example.
     */
    public function test_student_role(): void
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

        User::factory()->create([
            'role' => 'Parent',
        ]);

        // Seed necessary data
        $this->seed([
            SettingSeeder::class,
            SocialLinkSeeder::class,
            CurrencySeeder::class,
            LanguageSeeder::class,
            CourseTestSeeder::class,
            SubjectTestSeeder::class,
            PlanSeeder::class,
        ]);

        // Create a student user
        $student = User::factory()->create([
            'role' => 'Student',
            'name' => 'Student Dusk',
            'email' => 'sahaapo@gmail.com',
            'password' => bcrypt('password'),
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

        // Create a UserCourse relationship
        UserCourse::create([
            'user_id' => 5,
            'course_id' => 1,
        ]);

        // Create a TeacherSubject relationship
        TeacherSubject::create([
            'teacher_id' => 2,
            'subject_id' => 1,
        ]);

        // Seed additional data
        $this->seed([
            OnboardingSeeder::class,
            InvoiceTestSeeder::class,
            NoticeTestSeeder::class,
            StudentAttendanceTestSeeder::class,
            EventTestSeeder::class,
            OnlineClassSeeder::class,
            ChatGroupSeeder::class,
            ChatGroupUserSeeder::class,
            HolidaySeeder::class,
        ]);
        Syllabus::factory()->create();
        Assignment::factory(8)->create();

        $this->browse(function (Browser $browser) use ($student) {

            $baseUrl = config('app.url');

            // Login as the student and visit the dashboard
            $browser->loginAs($student)
                ->visit('/dashboard')
                ->waitFor('.shepherd-cancel-icon')
                ->press('×')
                ->waitForText('Dashboard')
                ->assertSee('Dashboard');

            // Scroll to the bottom of the page
            $this->scroll($browser);

            // Get the first subject
            $subject = Subject::first();

            // Click on the "Math" link
            $browser->click('a[href="'.$baseUrl.'/my/courses"]')
                ->pause(1500)
                ->waitForText('Course List')
                ->assertSee('Course List')
                ->assertSee('One')
                ->assertSee('Math')
                ->click('a[href="'.$baseUrl.'/subject/show/'.$subject->slug.'"]');

            // Scroll to the bottom of the page
            $this->scroll($browser);

            // Click on the "Schedule" tab
            $browser->waitFor('a[href="'.$baseUrl.'/subject/show/'.$subject->slug.'?tab=schedule"]')
                ->click('a[href="'.$baseUrl.'/subject/show/'.$subject->slug.'?tab=schedule"]')
                ->waitForText('Course Schedule')
                ->assertSee('Course Schedule');

            // Scroll to the bottom of the page
            $this->scroll($browser);

            // Interact with the schedule (e.g., click on buttons)
            $browser->waitForText('Prev')
                ->press('Prev')
                ->pause(500)
                ->press('Next')
                ->pause(500)
                ->press('Month')
                ->pause(500)
                ->press('Week')
                ->pause(500)
                ->press('Day');

            // Click on the "Students" tab
            $browser->click('a[href="'.$baseUrl.'/subject/show/'.$subject->slug.'?tab=students"]')
                ->waitForText('Student List')
                ->assertSee('Student List');

            // Scroll to the bottom of the page
            $this->scroll($browser);

            // Click on the "Assignment" tab
            $browser->click('a[href="'.$baseUrl.'/subject/show/'.$subject->slug.'?tab=assignments"]')
                ->waitForText('Subject Assignment')
                ->assertSee('Subject Assignment');

            // Scroll to the bottom of the page
            $this->scroll($browser);

            // Click on the "Assignment" tab
            $browser->click('a[href="'.$baseUrl.'/subject/show/'.$subject->slug.'?tab=online-class"]')
                ->waitForText('Classes')
                ->assertSee('Classes')
                ->click('a[href="'.$baseUrl.'/subject/show/'.$subject->slug.'?status=upcoming&tab=online-class"]')
                ->pause(2000)
                ->click('a[href="'.$baseUrl.'/subject/show/'.$subject->slug.'?status=completed&tab=online-class"]')
                ->pause(2000);

            // Scroll to the bottom of the page
            $this->scroll($browser);

            // Click on the "Assignment" tab
            $browser->click('a[href="'.$baseUrl.'/subject/show/'.$subject->slug.'?tab=syllabus"]')
                ->waitForText('Syllabus')
                ->assertSee('Syllabus');

            // Scroll to the bottom of the page
            $this->scroll($browser);

            // Click on the "Assignment" Page
            $browser->click('a[href="'.$baseUrl.'/my-assignment"]')
                ->waitForText('Assignment List')
                ->assertSee('Assignment List');

            // Scroll to the bottom of the page
            $this->scroll($browser);

            $documentImagePath = base_path('tests/Browser/picture/scan.png');

            $browser->waitForText('Ongoing Assignment')
                ->assertSee('Ongoing Assignment')
                ->press('Submit Now')
                ->press('Save')
                ->waitForText('The file field is required.')
                ->attach('input[type="file"][id="name"]', $documentImagePath)
                ->type('textarea[id="name"]', 'My assignment is done')
                ->press('Save')
                ->waitForText('Assignment submitted')
                ->assertSee('Assignment submitted');

            // Click on the "Online Class" Page
            $browser->click('a[href="'.$baseUrl.'/online/classes"]')
                ->waitForText('Online Class List')
                ->assertSee('Online Class List');

            // Scroll to the bottom of the page
            $this->scroll($browser);

            // Search data
            $browser->click('.multiselect-wrapper')
                ->click('li#status-multiselect-option-upcoming')
                ->press('Search');

            // Click on the "Online Class" Page
            $browser->click('a[href="'.$baseUrl.'/my-attendances"]')
                ->waitForText('Attendance List')
                ->assertSee('Attendance List');

            // Scroll to the bottom of the page
            $this->scroll($browser);

            // Click on the "Online Class" Page
            $browser->click('a[href="'.$baseUrl.'/class/routine"]')
                ->waitForText('Class Schedule')
                ->assertSee('Class Schedule');

            // Scroll to the bottom of the page
            $this->scroll($browser);

            // Click on the "Exam and Result" Page
            $browser->click('a[href="'.$baseUrl.'/exam-result"]')
                ->waitForText('Exam & Results')
                ->assertSee('Exam & Results');

            // Scroll to the bottom of the page
            $this->scroll($browser);

            // Click on the "Group Chat" Page
            $browser->click('a[href="'.$baseUrl.'/group/chat"]')
                ->waitForText('Math')
                ->assertSee('Math')
                ->assertSee('Select a message group');
            $browser->click('div.font-bold span')
                ->type('input[type="text"]', 'I am a student')
                ->keys('input[type="text"]', '{enter}');
            $browser->pause(5000);

            $notice = Notice::findOrFail(1);
            $slug = $notice->slug;

            // Login as a student
            $browser->clickLink('Notice Board')
                ->waitForText('Read Full Notice')
                ->assertSee('Read Full Notice');

            // Scroll the page
            $this->scroll($browser);

            // Click on a specific link
            $browser->click('a[href="'.$baseUrl.'/notice-board-detail/'.$slug.'"]')
                ->waitForText('Write A Comment');

            // Scroll the page
            $this->scroll($browser);

            // Enter 'New comment' in a textarea and press the 'Publish' button
            $browser->type('textarea[id="comment"]', 'New comment')
                ->press('Publish')
                ->waitForTextIn('#commentSection', 'New comment')
                ->assertSee('New comment');

            // Click on a specific button, enter 'Comment is Updated' in a textarea, and press the 'Publish' button
            $browser->click('button#editComment1')
                ->type('textarea[id="comment"]', 'Comment is Updated')
                ->press('Publish')
                ->waitForTextIn('#commentSection', 'Comment is Updated')
                ->assertSee('Comment is Updated');

            // Click on a specific button to delete the comment
            $browser->click('button#deleteComment1')
                ->pause(1000)
                ->waitForDialog()->acceptDialog();

            // Wait for 'Nothing Found' to appear in a specific element
            $browser->waitForTextIn('#commentSection', 'Nothing Found')
                ->assertSee('Nothing Found');

            // Click on a specific link
            $browser->clickLink('Fees Payment')
                ->waitForText('All Transaction');

            // Scroll the page
            $this->scroll($browser);
            $browser->pause(500)
                ->press('Export')
                ->pause(1000)
                ->press('Cancel');

            $browser->click('label[for="paid"]')
                ->waitFor('button[type="submit"]')
                ->press('Search')
                ->pause(5000);

            // Click on a specific link
            $browser->clickLink('Holiday')
                ->waitForText('Holiday List');

            // Scroll the page
            $this->scroll($browser);
            $browser->press('Prev')
                ->press('Next')
                ->press('Month')
                ->press('Week');

            // Click on a specific link
            $browser->clickLink('All Events')
                ->waitForText('Event List');

            // Scroll the page
            $this->scroll($browser);
            $browser->press('Prev')
                ->press('Next')
                ->press('Month')
                ->press('Week');

            $browser->click('img[alt="Student Dusk"]')
                ->pause(501)
                ->click('a[href="oid(0)"]')
                ->waitForText('Login')
                ->assertSee('Schooling');
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
