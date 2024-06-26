<?php

namespace Tests\Browser;

use App\Models\Leave;
use App\Models\Subject;
use App\Models\TeacherSubject;
use App\Models\User;
use App\Models\UserCourse;
use App\Models\UserProfile;
use Database\Seeders\ChatGroupSeeder;
use Database\Seeders\ChatGroupUserSeeder;
use Database\Seeders\ClassRoutineSeeder;
use Database\Seeders\CurrencySeeder;
use Database\Seeders\Dusk\AssignmentTestSeeder;
use Database\Seeders\Dusk\CourseTestSeeder;
use Database\Seeders\Dusk\ExamTestSeeder;
use Database\Seeders\Dusk\NoticeTestSeeder;
use Database\Seeders\Dusk\OnlineClassTestSeeder;
use Database\Seeders\Dusk\ScheduleTestSeeder;
use Database\Seeders\Dusk\SubjectTestSeeder;
use Database\Seeders\EventSeeder;
use Database\Seeders\GradeSeeder;
use Database\Seeders\LanguageSeeder;
use Database\Seeders\LeaveTypeSeeder;
use Database\Seeders\OnboardingSeeder;
use Database\Seeders\PlanSeeder;
use Database\Seeders\RolePermissionSeeder;
use Database\Seeders\SettingSeeder;
use Database\Seeders\SocialLinkSeeder;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class testTeacherRole extends DuskTestCase
{
    use DatabaseMigrations;

    /**
     * A Dusk teacher role test.
     */
    public function testTeacherRole(): void
    {
        // Seed role permissions
        $this->seed(RolePermissionSeeder::class);

        // Create user roles
        User::factory()->create([
            'role' => 'Admin',
        ]);

        // Create a teacher user
        $teacher = User::factory()->create([
            'role' => 'Teacher',
            'email' => 'lomeyo@adeveloper.info',
        ]);

        User::factory()->create([
            'role' => 'Accountant',
        ]);

        // Create a parent user
        $parent = User::factory()->create([
            'role' => 'Parent',
        ]);

        // Create a student user
        $student = User::factory()->create([
            'role' => 'Student',
            'name' => 'Student Dusk',
        ]);

        $this->seed([
            OnboardingSeeder::class,
            CourseTestSeeder::class,
            SubjectTestSeeder::class,
            SocialLinkSeeder::class,
            CurrencySeeder::class,
            LanguageSeeder::class,
            SettingSeeder::class,
            EventSeeder::class,
            LeaveTypeSeeder::class,
            PlanSeeder::class,
        ]);

        // Create 20 leave instances
        Leave::factory(20)->create();

        // Assign a subject to the teacher
        TeacherSubject::create([
            'teacher_id' => 2,
            'subject_id' => 1,
        ]);

        // Assign a course to the student
        UserCourse::create([
            'user_id' => 5,
            'course_id' => 1,
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

        $this->seed([
            AssignmentTestSeeder::class,
            ClassRoutineSeeder::class,
            ScheduleTestSeeder::class,
            OnlineClassTestSeeder::class,
            GradeSeeder::class,
            ExamTestSeeder::class,
            ChatGroupSeeder::class,
            ChatGroupUserSeeder::class,
            NoticeTestSeeder::class,
        ]);

        $this->browse(function (Browser $browser) use ($teacher) {
            // Login as the teacher and visit the dashboard
            $browser->loginAs($teacher);
            $browser->visit('/dashboard')
                ->waitFor('.shepherd-cancel-icon')
                ->press('×')
                ->waitForText('Dashboard')
                ->assertSee('Dashboard');

            // Scroll through the page
            $this->scroll($browser);

            $browser->clickLink('Total Leave')
                ->waitForText('Total Pending Leave')
                ->assertSee('Total Leave Apply')
                ->assertSee('Total Approved Leave')
                ->assertSee('Total Rejected Leave');

            $this->scroll($browser);
            $browser->clickLink('Dashboard');

            $browser->waitForText('Total Subjects')
                ->clickLink('Total Subjects')
                ->waitForText('One')
                ->assertSee('Math');
            $browser->clickLink('Dashboard');

            $browser->waitForText('Total Subjects')
                ->clickLink('Pending Assignments')
                ->waitForText('Due Date')
                ->assertSee('Due Date');

            $this->scroll($browser);
            $browser->clickLink('Dashboard');

            $browser->waitForText('Total Subjects')
                ->clickLink('Events Today')
                ->waitForText('Event List')
                ->assertSee('Event List');
            $browser->clickLink('Dashboard')
                ->waitForText('Total Subjects');

            // // Ends Dashboard page
            // // Ends Dashboard page

            // // Start My Course Page
            // // Start My Course Page

            $browser->clickLink('My Courses')
                ->waitForText('One')
                ->assertSee('Math')
                ->pause(1000)
                ->clickLink('Math')
                ->waitForText('Upcoming Assignment');

            $this->scroll($browser);

            $browser->clickLink('Course Schedule')
                ->waitForText('Today')
                ->assertSee('Today')
                ->clickLink('Student List')
                ->waitForText('STUDENT ID')
                ->assertSee('STUDENT ID');

            $baseUrl = config('app.url'); // Retrieve the base URL from the environment configuration or set it manually
            $subject = Subject::first();

            $browser->clickLink('Assignments')
                ->waitForText('Subject Assignment')
                ->assertSee('Subject Assignment')
                ->click('a[href="'.$baseUrl.'/subject/details/'.$subject->slug.'?tab=online-class"]')
                ->waitForText('Upcoming')
                ->assertSee('Upcoming')
                ->click('a[href="'.$baseUrl.'/subject/details/'.$subject->slug.'?tab=syllabus"]')
                ->waitForText('ACTION')
                ->assertSee('ACTION');

            // // Ends My Course Page
            // // Ends My Course Page

            // // Starts My Schedule Page
            // // Starts My Schedule Page

            $browser->clickLink('My Schedule')
                ->waitForText('Select Course')
                ->assertSee('Select Course')
                ->assertSee('Select Subject')
                ->type('input[aria-placeholder="Select Course"]', 'One')
                ->keys('input[aria-placeholder="Select Course"]', '{enter}')
                ->type('input[aria-placeholder="Select Subject"]', 'Math')
                ->keys('input[aria-placeholder="Select Subject"]', '{enter}')
                ->press('Search');

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

            // // Ends My Schedule Page
            // // Ends My Schedule Page

            // // Starts My OnlineClass Page
            // // Starts My OnlineClass Page

            $browser->clickLink('Online Classes')
                ->waitForText('Create New Class')
                ->assertSee('Create New Class');

            $this->scroll($browser);

            $browser->press('Create New Class')
                ->pause(500);
            $browser->script('window.scrollTo(0, 200)');

            $browser->press('Save')
                ->waitForText('The topic field is required.')
                ->assertSee('The topic field is required.')
                ->assertSee('The start date field is required.')
                ->assertSee('The course field is required.')
                ->assertSee('The subject field is required.')
                ->assertSee('The password field is required.')
                ->type('#topic', 'Bangladesh')
                ->keys('input[id="start_date"]', now())
                ->pause(200)
                ->click('a[class="ant-picker-now-btn"]')
                ->type('#rc_select_0', '1')
                ->keys('#rc_select_0', '{enter}')
                ->type('#rc_select_1', '1')
                ->keys('#rc_select_1', '{enter}')
                ->type('#password', 'lomeyo123')
                ->type('#description', 'Join first');
            $browser->script('window.scrollTo(0, 300)');
            $browser->press('Save');
            $browser->waitForText('Class Successfully Created');
            // edit online class check
            $browser->click('#editOnlineClass5')
                ->pause(200)
                ->type('#topic', 'Digital Updated Bangladesh')
                ->keys('input[id="start_date"]', now())
                ->pause(200)
                ->click('a[class="ant-picker-now-btn"]')
                ->type('#password', 'lomeyo12345')
                ->type('#description', 'Online class is updated');
            $browser->press('Save')
                ->waitForText('The password must not be greater than 9 characters.')
                ->assertSee('The password must not be greater than 9 characters.')
                ->type('#password', 'lomeyo12');
            $browser->press('Save');
            $browser->waitForText('Class Successfully update')
                ->assertSee('Class Successfully update');

            $browser->click('#deleteOnlineClass5')
                ->pause(500)
                ->waitForDialog()
                ->acceptDialog()
                ->pause(5002);

            // // Ends My OnlineClass Page
            // // Ends My OnlineClass Page

            // // Starts Assignment Page
            // // Starts Assignment Page

            $browser->clickLink('Assignment')
                ->waitForText('Create New Assignment')
                ->assertSee('Assignment List');
            $browser->script('window.scrollTo(0, 300)');
            $browser->pause(1000)
                ->mouseover('#hoverAssignment1')
                ->click('#editAssignment1')
                ->pause(200)
                ->type('#title', 'How to submit a assignment?')
                ->type('#description', 'To submit an assignment using Dusk testing, you need
                    to interact with the appropriate form or button elements on the page.')
                ->press('Save')
                ->waitForText('Assignment updated successfully')
                ->assertSee('Assignment updated successfully')
                ->pause(1500);
            $browser->script('window.scrollTo(0, 400)');

            $browser->pause(500)
                ->mouseover('#hoverAssignment1')
                ->click('#deleteAssignment1')
                ->pause(200)
                ->waitForDialog()
                ->acceptDialog()
                ->waitForText('Assignment deleted successfully.')
                ->assertSee('Assignment deleted successfully.');

            // // Ends My Assignment Page
            // // Ends My Assignment Page

            // // Starts  Attendance Page
            // // Starts  Attendance Page

            $browser->clickLink('Attendance')
                ->waitForText('Attendance List')
                ->assertSee('Attendance List')
                ->click('#present5')
                ->waitForText('Student Attendance created')
                ->assertSee('Student Attendance created');

            // // Ends  Attendance Page
            // // Ends  Attendance Page

            // // Starts  Exam & Results Page
            // // Starts  Exam & Results Page

            $result = base_path('tests/Browser/picture/result.xlsx');

            $browser->clickLink('Publish Exam Result')
                ->waitForText('Exam & Results')
                ->assertSee('Exam & Results')
                ->press('Publish New Result')
                ->type('#exam', 'Secondary')
                ->keys('#exam', '{enter}')
                ->attach('#name', $result)
                ->press('Save')
                ->waitForText('Exam result imported successfully')
                ->assertSee('Exam result imported successfully')
                ->pause(1000);

            // // Ends  Attendance Page
            // // Ends  Attendance Page

            // // Starts  My Message Page
            // // Starts  My Message Page

            // Click on the "Group Chat" Page
            $baseUrl = config('app.url');
            $browser->clickLink('My Messages')
                ->waitForText('Math')
                ->assertSee('Math')
                ->pause(1000);
            // ->assertSee('Select a message group');
            $browser->click('#testGroup1')
                ->type('input[type="text"]', 'I am a Teacher')
                ->keys('input[type="text"]', '{enter}');
            $browser->pause(5000);

            // // Ends My Message Page
            // // Ends  My Message Page

            // // Starts  Syllabus Page
            // // Starts  Syllabus Page

            $syllabus_wrong = base_path('tests/Browser/picture/result.xlsx');
            $syllabus_right = base_path('tests/Browser/picture/kid.jpg');

            $browser->clickLink('Syllabus')
                ->waitForText('Create New Syllabus')
                ->assertSee('Create New Syllabus')
                ->press('Save')
                ->waitForText('The class field is required.')
                ->assertSee('The class field is required.')
                ->assertSee('The subject field is required.')
                ->assertSee('The syllabus field is required.')
                ->type('#class', 'one')
                ->keys('#class', '{enter}')
                ->type('#subject', 'math')
                ->keys('#subject', '{enter}')
                ->attach('#syllabus', $syllabus_wrong)
                ->press('Save')
                ->waitForText('The syllabus must be a file of type: pdf, doc, docx, zip, 7z, jpeg, png, jpg, gif, svg.')
                ->assertSee('The syllabus must be a file of type: pdf, doc, docx, zip, 7z, jpeg, png, jpg, gif, svg.')
                ->attach('#syllabus', $syllabus_right)
                ->press('Save')
                ->waitForText('Syllabus save')
                ->assertSee('Syllabus save')
                ->pause(1000);

            $syllabus_update = base_path('tests/Browser/picture/document.jpg');

            $browser->click('#editSyllabus1')
                ->attach('#syllabus', $syllabus_update)
                ->press('Save')
                ->waitForText('Syllabus updated !')
                ->assertSee('Syllabus updated !');

            $browser->click('#deleteSyllabus1')
                ->pause(500)
                ->waitForDialog()
                ->acceptDialog()
                ->waitForText('Syllabus deleted !')
                ->assertSee('Syllabus deleted !');

            // Ends Syllabus Page
            // Ends Syllabus Page

            // Starts  Meeting Page
            // Starts  Meeting Page
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

            // // Starts  Holiday Page
            // // Starts  Holiday Page

            $browser->clickLink('Holiday')
                ->waitForText('Holiday List')
                ->assertSee('Holiday List');
            $this->scroll($browser);

            // // Ends Event Page
            // // Ends Event Page

            // // Starts Event Page
            // // Starts Event Page

            $browser->clickLink('All Events')
                ->waitForText('Event List')
                ->assertSee('Event List');
            $this->scroll($browser);

            // // Ends Event Page
            // // Ends Event Page

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

            // Starts Leave Request Page
            // Starts Leave Request Page

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
}
