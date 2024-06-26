<?php

namespace Tests\Browser;

use App\Models\Course;
use App\Models\Notice;
use App\Models\Subject;
use App\Models\TeacherSubject;
use App\Models\User;
use App\Models\UserCourse;
use App\Models\UserProfile;
use Database\Seeders\AdmissionFormSeeder;
use Database\Seeders\ClassRoutineSeeder;
use Database\Seeders\CurrencySeeder;
use Database\Seeders\Dusk\CourseTestSeeder;
use Database\Seeders\Dusk\ExamTestSeeder;
use Database\Seeders\Dusk\InvoiceTestSeeder;
use Database\Seeders\Dusk\LeaveTestSeeder;
use Database\Seeders\Dusk\SubjectTestSeeder;
use Database\Seeders\Dusk\TransactionTestSeeder;
use Database\Seeders\Dusk\TransactionTypeTestSeeder;
use Database\Seeders\EventSeeder;
use Database\Seeders\GallerySliderSeeder;
use Database\Seeders\GradeSeeder;
use Database\Seeders\HolidaySeeder;
use Database\Seeders\LanguageSeeder;
use Database\Seeders\LeaveTypeSeeder;
use Database\Seeders\OnboardingSeeder;
use Database\Seeders\PlanSeeder;
use Database\Seeders\ResultRuleSeeder;
use Database\Seeders\RolePermissionSeeder;
use Database\Seeders\SettingSeeder;
use Database\Seeders\SocialLinkSeeder;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class AdminRoleTest extends DuskTestCase
{
    use DatabaseMigrations;

    /**
     * A Dusk Admin Role Test.
     */
    public function testAdminRole(): void
    {
        // Seed role permissions
        $this->seed(RolePermissionSeeder::class);

        // Create user roles
        $admin = User::factory()->create([
            'role' => 'Admin',
            'email' => 'lomeyo@adeveloper.info',
            'password' => 'password',
            'name' => 'Admin Dusk',
        ]);

        // Create a teacher user
        User::factory()->create([
            'role' => 'Teacher',
            'name' => 'Teacher Dusk',
        ]);

        User::factory()->create([
            'role' => 'Accountant',
        ]);

        // Create a parent user
        User::factory()->create([
            'role' => 'Parent',
        ]);

        // Create a student user
        $student = User::factory()->create([
            'role' => 'Student',
            'name' => 'Student Dusk',
            'email' => 'sahaapo@gmail.com',
        ]);

        $this->seed([
            CurrencySeeder::class,
            CourseTestSeeder::class,
            SubjectTestSeeder::class,
            PlanSeeder::class,
        ]);

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

        $this->seed([
            OnboardingSeeder::class,
            EventSeeder::class,
            ClassRoutineSeeder::class,
            HolidaySeeder::class,
            SocialLinkSeeder::class,
            LanguageSeeder::class,
            SettingSeeder::class,
            GradeSeeder::class,
            ResultRuleSeeder::class,
            ExamTestSeeder::class,
            LeaveTypeSeeder::class,
            LeaveTestSeeder::class,
            TransactionTypeTestSeeder::class,
            TransactionTestSeeder::class,
            InvoiceTestSeeder::class,
            AdmissionFormSeeder::class,
            GallerySliderSeeder::class,
        ]);

        Course::create([
            'name' => 'Two',
        ]);

        $this->browse(function (Browser $browser) use ($admin) {
            $browser->loginAs($admin);

            //  // Start Dashboard test
            //  // Start Dashboard test

            $browser->visit('/dashboard')
                ->waitFor('.shepherd-cancel-icon')
                ->press('×')
                ->waitForText('Dashboard')
                ->assertSee('Dashboard');

            $this->scroll($browser);

            // // Academic Section Starts From Here // //

            // // // Course Page  // //
            // // // Course Page  // //

            $browser->click('#academicDropdown')
                ->pause(200)
                ->clickLink('Course')
                ->waitForText('Course Management')
            // create course
                ->press('Add Course')
                ->waitForText('Create A New Course')
                ->press('Save')
                ->waitForText('The name field is required.')
                ->assertSee('The name field is required.')
                ->type('#name', 'One')
                ->press('Save')
                ->waitForText('The name has already been taken.')
                ->assertSee('The name has already been taken.')
                ->type('#name', 'Ten')
                ->press('Save')
                ->waitForText('Course created successfully.')
                ->assertSee('Course created successfully.')

            // edit course
                ->click('#testEditCourse3')
                ->waitForText('Edit Course')
                ->assertSee('Edit Course')
                ->type('input[placeholder="Subject Name"]', 'Bangladesh')
                ->type('#color', '#FF1900')
                ->press('Add Subject')
                ->press('Save')
                ->waitForText('Course updated successfully.')
                ->assertSee('Course updated successfully.')

            // delete Course
                ->click('#testDeleteCourse3')
                ->pause(500)
                ->waitForDialog()
                ->acceptDialog()
                ->waitForText('Course deleted successfully.')
                ->assertSee('Course deleted successfully.');

            // Subject page //
            // Subject page //

            $browser->click('#academicDropdown')
                ->pause(200)
                ->clickLink('Subject')
                ->waitForText('Create New Subject')
                ->assertSee('Create New Subject')
                ->press('Save')
                ->waitForText('The name field is required.')
                ->assertSee('The name field is required.')
                ->type('#name', 'Bangladesh')
                ->type('#color', '#29FF00')
                ->press('Save')
                ->waitForText('Subject created successfully.')
                ->assertSee('Subject created successfully.')
                ->pause(1500);

            // Subject edit
            $browser->click('#editSubject5')
                ->pause(200)
                ->type('#name', 'World')
                ->type('#color', '#5E2E2E')
                ->press('Update')
                ->waitForText('Subject updated successfully')
                ->assertSee('Subject updated successfully');

            // Subject delete
            $browser->click('#deleteSubject5')
                ->pause(500)
                ->waitForDialog()
                ->acceptDialog()
                ->waitForText('Subject deleted successfully.')
                ->assertSee('Subject deleted successfully.');

            // Result Rule page //
            // Result Rule page //

            $browser->clickLink('Result Rule')
                ->waitForText('Create New')
                ->assertSee('Create New')
                ->press('Save')
                ->waitForText('The name field is required.')
                ->assertSee('The name field is required.')
                ->assertSee('The gpa field is required.')
                ->assertSee('The min mark field is required.')
                ->assertSee('The max mark field is required.')
                ->assertSee('The grade remark field is required.')
                ->type('#name', 'A++')
                ->type('#gpa', '10')
                ->type('#min_mark', '200')
                ->type('input[name="max_mark"]', '500')
                ->type('#grade_remark', 'Nothing')
                ->press('Save')
                ->waitForText('Result Rule Created Successfully')
                ->assertSee('Result Rule Created Successfully');

            // Result Rule Edit page
            $browser->click('#testEditRule8')
                ->type('#name', 'Class test')
                ->type('#gpa', '1')
                ->type('#min_mark', '10')
                ->type('input[name="max_mark"]', '20')
                ->type('#grade_remark', 'Update class test exam')
                ->press('Update')
                ->waitForText('Result Rule Updated Successfully')
                ->assertSee('Result Rule Updated Successfully');

            // Subject delete
            $browser->click('#testDeleteRule8')
                ->pause(500)
                ->waitForDialog()
                ->acceptDialog()
                ->waitForText('Result Rule Deleted Successfully')
                ->assertSee('Result Rule Deleted Successfully');

            // Exam page //
            // Exam page //

            $today = date('Y-m-d');
            $tomorrow = date('Y-m-d', strtotime($today.' +1 day'));
            $browser->click('#academicDropdown')
                ->pause(200)
                ->clickLink('Exam')
                ->waitForText('Secondary School Certificate')
                ->assertSee('Secondary School Certificate')
                ->click('#createExamButton')
                ->waitForText('Enter exam name')
                ->assertSee('Enter exam name')
                ->press('Save')
                ->waitForText('The name field is required.')
                ->assertSee('The name field is required')
                ->assertSee('The grade field is required')
                ->assertSee('The gpa field is required')
                ->type('#examName', 'Higher Secondary Certificate (HSC)')
                ->type('#mark', '100')
                ->click('#testDate')
                ->pause(200)
                ->click('td[title="'.$today.'"]')
                ->click('input[placeholder="End date"]')
                ->click('td[title="'.$tomorrow.'"]')
                ->type('#gpa', '5')
                ->type('#description', 'The Higher Secondary School Certificate (HSC) is a secondary education qualification in Bangladesh, India and Pakistan.')
                ->press('Save')
                ->waitForTextIn('#testExamDataTable', 'Higher Secondary Certificate (HSC)');

            // edit Exam
            $browser->click('#testExamEdit2')
                ->waitForText('Update Exam')
                ->assertSee('Update Exam')
                ->type('#examName', 'Higher Secondary Certificate (Update)')
                ->type('#mark', '150')
                ->click('#testDate')
                ->pause(200)
                ->click('td[title="'.$today.'"]')
                ->click('input[placeholder="End date"]')
                ->click('td[title="'.$tomorrow.'"]')
                ->type('#gpa', '4')
                ->type('#description', 'The Higher Secondary School Certificate (update) is a secondary education qualification in Bangladesh, India and Pakistan.')
                ->press('Save')
                ->waitForTextIn('#testExamDataTable', 'Higher Secondary Certificate (HSC)');

            // delete Exam
            $browser->click('#testExamDelete2')
                ->pause(500)
                ->waitForDialog()
                ->acceptDialog()
                ->waitForText('Exam deleted successfully.')
                ->assertSee('Exam deleted successfully.');

            // // Class Schedule page //
            // // Class Schedule page //

            $browser->click('#academicDropdown')
                ->clickLink('Class Schedule')
                ->waitForText('Filter By')
                ->assertSee('Filter By');

            $this->scroll($browser);

            $browser->clickLink('Add New')
                ->waitForText('Create a New Schedule')
                ->assertSee('Create a New Schedule')
                ->type('#teacher', 'teacher')
                ->keys('#teacher', '{enter}')
                ->type('#class', 'one')
                ->keys('#class', '{enter}')
                ->type('#subject', 'math')
                ->keys('#subject', '{enter}')
                ->type('#weekday', 'm')
                ->keys('#weekday', '{enter}')
                ->click('#testTime')
                ->keys('#testTime', ['10:00'])
                ->press('Ok')
                ->click('input[placeholder="End Time"]')
                ->keys('input[placeholder="End Time"]', ['11:00'])
                ->press('Ok')
                ->press('Save')
                ->waitForText('Class routine successfully created')
                ->assertSee('Class routine successfully created');

            // // Department page //
            // // Department page //

            $browser->click('#academicDropdown')
                ->clickLink('Department')
                ->waitForText('Departments')
                ->assertSee('Department')
                ->press('Save')
                ->waitForText('The name field is required.')
                ->assertSee('The name field is required.')
                ->type('#name', 'Science')
                ->press('Save')
                ->waitForText('Department created successfully.')
                ->assertSee('Department created successfully.')

            // edit page
                ->click('#testEditDepartment1')
                ->pause(200)
                ->type('#name', 'Commerce')
                ->press('Update')
                ->waitForText('Department update successfully.')
                ->assertSee('Department update successfully.');

            // delete department
            $browser->click('#testDeleteDepartment1')
                ->pause(500)
                ->waitForDialog()
                ->acceptDialog()
                ->waitForText('Department deleted successfully.')
                ->assertSee('Department deleted successfully.');

            // // Starts  Meeting Page
            // // Starts  Meeting Page

            $browser->clickLink('Meeting')
                ->waitForText('Add Meeting')
                ->assertSee('Add Meeting')
                ->press('Add Meeting')
                ->pause(500);

            $today = now();
            $browser->type('#topic', 'Annual discussion')
                ->keys('input[id="start_date"]', $today->day)
                ->keys('input[id="start_date"]', $today->month)
                ->keys('input[id="start_date"]', $today->year)
                ->pause(200)
                ->click('a[class="ant-picker-now-btn"]')
                ->type('#password', 'password')
                ->click('#all_user')
                ->type('#description', 'Lets do a annual discussion')
                ->press('Save')
                ->waitForText('Meeting Successfully Created')
                ->assertSee('Meeting Successfully Created');

            $browser->pause(1000)
                ->press('Add Meeting')
                ->press('Save')
                ->waitForText('The topic field is required.')
                ->assertSee('The topic field is required.')
                ->assertSee('The password field is required.')
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

            // Leave Request page

            $browser->clickLink('Leave Request')
                ->waitForText('Leave Type')
            // accept leave
                ->waitFor('#testAccept1')
                ->click('#testAccept1')
                ->waitForText('Leave accepted !')
                ->assertSee('Leave accepted !')
            // reject leave
                ->click('#testReject2')
                ->waitForText('Insert Reject Cause')
                ->assertSee('Insert Reject Cause')
                ->type('#name', 'You already took a leave 7 days ago.')
                ->press('Save')
                ->waitForText('Leave rejected !')
                ->assertSee('Leave rejected !')
            // // edit leave
            // ->click('#testEdit3')
            // ->waitForText('Edit Leave')
            // ->assertSee('Edit Leave')
            // ->keys('#rc_select_1', ['a'])
            // ->keys('#rc_select_1','{enter}')
            // ->pause(500)
            // ->click('#updateButton')
            // ->waitForText('Leave updated')
            // ->assertSee('Leave updated')
            // view profile
                ->click('#testShow4')
                ->pause(1000)
                ->press('Close')
            // delete leave
                ->click('#testDelete4')
                ->pause(500)
                ->waitForDialog()
                ->acceptDialog()
                ->waitForText('Leave deleted !')
                ->assertSee('Leave deleted !');

            // leave type
            $browser->click('#testLeaveType')
                ->waitForText('Create New')
                ->assertSee('Create New')
                ->type('#name', 'Special Leave')
                ->press('Save')
                ->waitForText('Leave Type Saved !')
                ->assertSee('Leave Type Saved !')

            // edit leave type
                ->click('#testEdit6')
                ->type('#name', 'Update Special Leave')
                ->click('#staff')
                ->press('Save')
                ->waitForText('Leave Type Updated !')
                ->assertSee('Leave Type Updated !')

            // delete leave type
                ->click('#testDelete6')
                ->pause(500)
                ->waitForDialog()
                ->acceptDialog()
                ->waitForText('Leave Type Deleted !')
                ->assertSee('Leave Type Deleted !');

            // All Transaction page
            // All Transaction page

            $bill = base_path('tests/Browser/picture/scan.png');

            $browser->clickLink('All Transaction')
                ->waitForText('Add New Transaction')
                ->assertSee('Add New Transaction')
                ->click('#addNewTransaction')
                ->waitForText('Transaction Create')
                ->type('#title', 'Transaction for bills')
                ->click('#type')
                ->click('#type-multiselect-option-2')
            // ->keys('#type','{enter}')
                ->type('#amount', '500')
                ->click('#testDate')
                ->click('.ant-picker-today-btn')
                ->click('#paid')
                ->type('#payment_method', 'Cash')
                ->type('#description', 'This is a description for this transaction .')
                ->attach('#document', $bill)
                ->press('Save')
                ->waitForText('PAID AMOUNT')
                ->click('label[for="income"]')
                ->press('Search')
                ->pause(5000)
                ->press('Export')
                ->click('#exportTransaction')
                ->pause(1000);

            // // Admission plan page
            // // Admission plan page

            $browser->clickLink('Admission Plan')
                ->waitForText('Add New Plan')
                ->clickLink('Add New Plan')
                ->waitForText('Add New Benefit')
                ->press('Submit')
                ->waitForText('The title field is required.')
                ->assertSee('The title field is required.')
                ->assertSee('The course field is required.')
                ->assertSee('The benefits field is required.')
                ->type('title', 'Plan 20')
                ->type('#course', 'one')
                ->keys('#course', '{enter}')
                ->type('#currency', 'un')
                ->keys('#currency', '{enter}')
                ->type('#description', 'Best plan for international students.')
                ->type('.testBenefits', 'No more hidden cost')
                ->type('.testAmounts', '20000')
                ->press('Submit')
                ->waitForTextIn('.testPlanBox', 'Best plan for international students.')
                ->assertSee('Best plan for international students.')

            // edit plan
                ->click('#editPlan6')
                ->waitForText('Update')
                ->pause(2000)
                ->type('#title', 'Advance updated plan')
                ->type('#currency', 'b')
                ->keys('#currency', '{enter}')
                ->type('#description', 'Advance course for all')
                ->type('input[placeholder="Benefit"]', 'Best plan for international students.(update)')
                ->type('input[placeholder="Amount"]', 5500)
                ->press('Update')
                ->waitForTextIn('.testPlanBox', 'Best plan for international students.(update)')
                ->assertSee('Best plan for international students.(update)')

            // delete plan
                ->click('#deletePlan6')
                ->pause(500)
                ->waitForDialog()
                ->acceptDialog()
                ->waitForText('Plan Deleted Successful')
                ->assertSee('Plan Deleted Successful');

            // // Event List page
            // // Event List page

            $today = date('Y-m-d');
            $tomorrow = date('Y-m-d', strtotime($today.' +1 day'));

            $browser->clickLink('Event List')
                ->waitForText('Create Event')
                ->assertSee('Create Event')
                ->press('Create Event')
                ->pause(200)
                ->press('Save')
                ->waitForText('The name field is required.')
                ->assertSee('The name field is required.')
                ->type('#name', 'Summer Vacation')
                ->click('input[placeholder="Start date"]')
                ->pause(200)
                ->click('td[title="'.$today.'"]')
                ->click('input[placeholder="End date"]')
                ->click('td[title="'.$tomorrow.'"]')
                ->press('Save')
                ->waitForText('Event created successful !')
                ->assertSee('Event created successful !')

            // edit event
                ->pause(500)
                ->click('#testEdit8')
                ->pause(200)
                ->type('#name', 'Winter Vacation')
                ->press('Update')
                ->waitForText('Event updated successful !')
                ->assertSee('Event updated successful !')

            // delete event
                ->click('#testDelete8')
                ->pause(500)
                ->waitForDialog()
                ->acceptDialog()
                ->waitForText('Event delete successful !')
                ->assertSee('Event delete successful !');

            // // Notice Board page
            // // Notice Board page

            $noticeImage = base_path('tests/Browser/picture/scan.png');

            $browser->clickLink('Notice Board')
                ->waitForText('Add New Notice')
                ->assertSee('Add New Notice')
                ->press('Save')
                ->waitForText('The title field is required.')
                ->assertSee('The title field is required.')
                ->assertSee('The description field is required.')
                ->assertSee('The file field is required.')
                ->type('#title', 'Notice for Annual Exam')
                ->type('#description', 'Annual examination means a general or partial
                    examination of the vessel, its machinery, fittings and equipment,
                    as far as can readily be seen, to ascertain that it has been
                    satisfactorily maintained as required by the Code and that the
                    arrangements, fittings and equipment provided are as documented
                    for the vessel')
                ->attach('input[accept="image/*"]', $noticeImage)
                ->click('#status_public')
                ->press('Save')
                ->waitForText('Notice created')
                ->assertSee('Notice created');

            // notice view and comment
            $notice = Notice::first();
            $browser->visit('/notice-board-detail/'.$notice->slug)
                ->waitForTextIn('#testNoticeDetails', 'Notice for Annual Exam')
                ->type('#comment', 'I am a Admin')
                ->press('Publish')
                ->waitForText('Your comment successfully added')
                ->assertSee('Your comment successfully added')
                ->click('#editComment1')
                ->type('#comment', 'I am a Admin (Update)')
                ->press('Publish')
                ->waitForText('Comment updated')
                ->assertSee('Comment updated')
                ->click('#deleteComment1')
                ->pause(200)
                ->waitForDialog()
                ->acceptDialog()
                ->waitForText('Comment deleted')
                ->assertSee('Comment deleted')
                ->clickLink('Notice Board')
                ->waitForText('Add New Notice')

            // edit notice
                ->click('#edit1')
                ->type('#title', 'Notice for examination finished')
                ->type('#description', 'Annual examination finished')
                ->press('Save')
                ->waitForText('Notice updated')
                ->assertSee('Notice updated');

            // delete notice
            $browser->click('#delete1')
                ->pause(500)
                ->waitForDialog()
                ->acceptDialog()
                ->waitForText('Notice deleted')
                ->assertSee('Notice deleted');

            // // All Students page
            // // All Students page

            $bulkExcel = base_path('tests/Browser/picture/student.xlsx');

            $browser->clickLink('All Students')
                ->waitForText('Bulk Admission')
                ->assertSee('Bulk Admission')
                ->click('#show5')
                ->waitForText('Student Documents')
                ->assertSee('Student Documents')
                ->click('.testAttendance')
                ->waitForText('Attendance History')
                ->assertSee('Attendance History')
                ->click('.testTransactions')
                ->waitForText('Invoice History')
                ->assertSee('Invoice History')
                ->click('.testExams')
                ->waitForText('Exam Results')
                ->assertSee('Exam Results')
                ->click('.testLeaveHistory')
                ->clickLink('All Students')
                ->waitForText('Bulk Admission')
                ->assertSee('Bulk Admission')
                ->clickLink('Bulk Admission')
                ->waitForText('Select Your File')
                ->attach('#name', $bulkExcel)
                ->press('Save')
                ->waitForText('student1@gmail.com');

            $newStudent = User::whereEmail('student1@gmail.com')->first();
            $browser->click('#edit'.$newStudent->id)
                ->waitForText('Parent Information')
                ->assertSee('Parent Information')
                ->type('.testName', 'Saboj Kumar Shaha')
                ->type('#email', 'employee@lomeyo.com')
                ->press('Next')
                ->waitForText('Blood Group')
                ->type('#blood_group', 'b')
                ->keys('#blood_group', '{enter}')
                ->type('#physical_disability', 'No')
                ->type('#religion', 'Sanatan');

            $browser->script('
            function scrollToBottom() {
                window.scrollTo({ top: document.body.scrollHeight, behavior: "smooth" });
                }
                scrollToBottom();
            ');
            $browser->type('#previous_school_name', 'Narsingdi School')
                ->type('#previous_school_year_of_exist', '2010')
                ->press('Next');

            $browser->script('
            function scrollToBottom() {
                window.scrollTo({ top: document.body.scrollHeight, behavior: "smooth" });
                }
                scrollToBottom();
            ');

            $browser->click('#plan3')
                ->press('Save')
                ->waitForText('Bulk Admission');

            // delete Student profile
            $browser->click('#delete'.$newStudent->id)
                ->waitForDialog()
                ->acceptDialog()
                ->waitForText('User deleted successfully.')
                ->assertSee('User deleted successfully.');

            // // Student Promotion
            // // Student Promotion

            $browser->clickLink('Student Promotion')
                ->waitForText('Promotion From')
                ->assertSee('Promotion From')
                ->assertSee('Promoting To')
                ->type('#from_course', 'on')
                ->keys('#from_course', '{enter}')
                ->type('#to_course', 'tw')
                ->keys('#to_course', '{enter}')
                ->waitForText('Student Dusk (STD123)')
                ->click('#result_fail0')
                ->click('#result_pass_1')
                ->click('#result_fail2')
                ->click('#session_leave0')
                ->click('#session_continue1')
                ->click('#session_leave2')
                ->press('Promote')
                ->waitForDialog()
                ->acceptDialog()
                ->waitForText('Nothing Found')
                ->assertSee('Nothing Found');

            // Admission form page
            // Admission form page

            $browser->clickLink('Admission Form')
                ->waitForText('Form Preview')
                ->assertSee('Form Preview')
                ->click('#test_name')
                ->click('#test_email')
                ->click('#test_profile_photo')
                ->click('#test_date_of_birth')
                ->click('#test_gender')
                ->click('#test_course')
                ->click('#test_phone');
            $browser->script('
                function scrollToHalfHeight() {
                    const halfHeight = window.innerHeight / 2;
                    window.scrollTo(0, halfHeight);
                }

                scrollToHalfHeight();
            ');
            $browser->click('#test_address')
                ->click('#test_documents')
                ->click('#test_national_identification_number')
                ->click('#test_blood_group')
                ->click('#test_physical_disability');
            $browser->script('
            function scrollToBottom() {
                window.scrollTo({ top: document.body.scrollHeight });
            }

            scrollToBottom();
            ');
            $browser->click('#test_previous_school_name')
                ->click('#test_previous_school_year_of_exist')
                ->click('#test_religion')
                ->click('#test_bank_name')
                ->click('#test_bank_account_number')
                ->click('#test_note')
                ->click('#test_guardian_name')
                ->click('#test_guardian_email')
                ->click('#test_guardian_photo');
            $browser->script('
                function scrollToTop() {
                    window.scrollTo({ top: 0, behavior: "smooth" });
                }

                scrollToTop();

            ');
            $browser->waitForText('Field Status successfully Change.')
                ->assertSee('Field Status successfully Change.')
                ->pause(2500)
                ->click('#test_name')
                ->click('#test_email')
                ->click('#test_profile_photo')
                ->click('#test_date_of_birth')
                ->click('#test_gender')
                ->click('#test_course')
                ->click('#test_phone');
            $browser->script('
                function scrollToHalfHeight() {
                    const halfHeight = window.innerHeight / 2;
                    window.scrollTo(0, halfHeight);
                }

                scrollToHalfHeight();
            ');
            $browser->click('#test_address')
                ->click('#test_documents')
                ->click('#test_national_identification_number')
                ->click('#test_blood_group')
                ->click('#test_physical_disability');
            $browser->script('
            function scrollToBottom() {
                window.scrollTo({ top: document.body.scrollHeight });
            }

            scrollToBottom();
            ');
            $browser->click('#test_previous_school_name')
                ->click('#test_previous_school_year_of_exist')
                ->click('#test_religion')
                ->click('#test_bank_name')
                ->click('#test_bank_account_number')
                ->click('#test_note')
                ->click('#test_guardian_name')
                ->click('#test_guardian_email')
                ->click('#test_guardian_photo');
            $browser->script('
                function scrollToTop() {
                    window.scrollTo({ top: 0, behavior: "smooth" });
                }

                scrollToTop();

            ');
            $browser->waitForText('Field Status successfully Change.')
                ->assertSee('Field Status successfully Change.');

            // // All User Page
            // // All User Page
            $this->sidebarScroll($browser);

            $photo = base_path('tests/Browser/picture/kid.jpg');
            $ParentsPhoto = base_path('tests/Browser/picture/parent.jpg');

            $browser->clickLink('All Users')
                ->waitForText('Create User')
                ->assertSee('Create User')
                ->clickLink('Create User')
                ->waitForText('User Create')
                ->press('Submit')
                ->waitForText('The name field is required.')
                ->assertSee('The name field is required.')
                ->assertSee('The email field is required.')
                ->type('#name', 'Test name')
                ->type('#email', 'sabojkumarsaha@gmail.com')
                ->type('#password', '12345678')
                ->press('Submit')
                ->waitForText('sabojkumarsaha@gmail.com')
                ->click('#test_admin')
                ->pause(5000)
                ->waitFor('#edit1')
                ->click('#edit1')
                ->waitForText('User Edit')
                ->assertSee('User Edit')
                ->attach('input[type="file"]', $photo)
                ->type('#phone', '01616657585')
                ->type('#address', 'Narsingdi')
                ->press('Save')
                ->waitForText('Total Parents')
                ->assertSee('Total Parents')
                ->click('#test_parent')
                ->pause(3500)
                ->waitFor('#edit4')
                ->click('#edit4')
                ->waitForText('User Edit')
                ->assertSee('User Edit')
                ->attach('input[type="file"]', $ParentsPhoto)
                ->type('#phone', '01616657586')
                ->type('#address', 'Parent Narsingdi')
                ->press('Save')
                ->waitForText('Total Students')
                ->assertSee('Total Students')
                ->click('#test_student')
                ->pause(3500)
                ->click('#test_teacher')
                ->pause(3500)
                ->click('#test_other')
                ->pause(3500)
                ->waitFor('#edit3')
                ->click('#edit3')
                ->waitForText('User Edit')
                ->assertSee('User Edit')
                ->attach('input[type="file"]', $photo)
                ->type('#phone', '01616657586')
                ->type('#address', 'Accountant Narsingdi')
                ->press('Save')
                ->waitForText('Total Students')
                ->assertSee('Total Students');

            // // delete User profile
            $browser->click('#delete9')
                ->waitForDialog()
                ->acceptDialog()
                ->waitForText('User deleted successfully.')
                ->assertSee('User deleted successfully.');

            // All teacher page
            // All teacher page

            $this->sidebarScroll($browser);

            $browser->clickLink('All Teachers')
                ->waitForText('Add New Teachers')
                ->assertSee('Add New Teachers')
                ->clickLink('Add New Teachers')
                ->waitForText('Teacher Create')
                ->type('#name', 'Perfect Teacher')
                ->type('#email', 'sabojkumarsaha@gmail.com')
                ->click('input[placeholder="Select date"]')
                ->click('.ant-picker-today-btn')
                ->type('#phone', '01616657585')
                ->type('#gender', 'Male')
                ->type('#address', '126/5 Narsingdi, Bangladesh')
                ->press('Next')
                ->type('#highest_degree_name', 'MBA')
                ->type('#institute_name', 'Narsingdi Boys School')
                ->click('input[placeholder="Passing Year"]')
                ->click('td[title="2025"]');
            $browser->script('
            function scrollToBottom() {
                window.scrollTo({ top: document.body.scrollHeight, behavior: "smooth" });
            }

                scrollToBottom();
            ');
            $browser->type('#department', 'com')
                ->keys('#department', '{enter}')
                ->type('#religion', 'Sanatan')
                ->type('#nationality', 'bang')
                ->keys('#nationality', '{enter}')
                ->type('#title0', 'Document 1')
                ->attach('#document0', $photo)
                ->press('Next');
            $subject = Subject::first();

            $browser->check('#sub'.$subject->slug)
                ->press('Save')
                ->waitForText('ACCOUNT HOLD')
                ->assertSee('ACCOUNT HOLD')
                ->click('#edit10')
                ->waitForText('Academic Information')
                ->type('#name', 'Perfect Teacher (update)')
                ->type('#email', 'sabojkumarsaha@gmail.com')
                ->click('input[placeholder="Select date"]')
                ->click('.ant-picker-today-btn')
                ->type('#phone', '01616657585')
                ->type('#gender', 'Male')
                ->type('#address', '126/5 Narsingdi, Bangladesh(update)')
                ->press('Next')
                ->type('#highest_degree_name', 'Masters of Business Administration')
                ->type('#institute_name', 'Narsingdi Govt Boys School')
                ->click('input[placeholder="Passing Year"]')
                ->click('td[title="2026"]');
            $browser->script('
            function scrollToBottom() {
                window.scrollTo({ top: document.body.scrollHeight, behavior: "smooth" });
            }

                scrollToBottom();
            ');
            $browser->type('#department', 'com')
                ->keys('#department', '{enter}')
                ->type('#religion', 'Sanatan')
                ->type('#nationality', 'bang')
                ->keys('#nationality', '{enter}')
                ->type('#title0', 'Document (update)')
                ->attach('#document0', $photo)
                ->press('Next');
            $subject = Subject::first();

            $browser->check('#sub'.$subject->slug)
                ->press('Save')
                ->waitForText('ACCOUNT HOLD')
                ->assertSee('ACCOUNT HOLD');

            // Starts  Holiday Page
            // Starts  Holiday Page

            $this->sidebarScroll($browser);

            $browser->clickLink('Holiday')
                ->waitForText('Holiday List')
                ->assertSee('Holiday List');
            $this->scroll($browser);

            // // Starts  Report Page
            // // Starts  Report Page

            $this->sidebarScroll($browser);
            $browser->clickLink('Reports')
                ->waitForText('Income & Expense')
                ->assertSee('Income & Expense')
                ->clickLink('Income & Expense')
                ->waitForText('Transactions Report')
                ->press('Export')
                ->click('#testExport')
                ->pause(2000);

            // // Settings Page
            // // Settings Page

            $this->sidebarScroll($browser);
            $browser->clickLink('Settings')
                ->waitForText('General Settings')
                ->assertSee('General Settings')
                ->type('name', 'Brahamongdi K,K,M, Govt High School')
                ->type('#code', '108')
                ->type('#principal', 'Mr principal')
                ->type('#email', 'School@gmail.com')
                ->type('#phone', '01616657585')
                ->type('#address', 'Narsingdi, Dhaka, Bangladesh')
                ->type('#description', 'No description')
                ->press('Save Changes')
                ->waitForText('Website basic setting update successful')
                ->assertSee('Website basic setting update successful');

            // Scroll to the bottom of the page
            $browser->script('
                function scrollToBottom() {
                    window.scrollTo({ top: document.body.scrollHeight, behavior: "smooth" });
                }

                scrollToBottom();
            ');

            $browser->pause(1500)
                ->check('#sunday')
                ->uncheck('#friday')
                ->uncheck('#saturday')
                ->click('#wSave')
                ->waitForText('Schedule Setting Successfully')
                ->assertSee('Schedule Setting Successfully');

            // Scroll to the top of the page
            $browser->script('
                function scrollToTop() {
                    window.scrollTo({ top: 0, behavior: "smooth" });
                }

                scrollToTop();
            ');

            // // Pause for 1 second after scrolling to the top
            $browser->pause(1000)
                ->clickLink('Website')
                ->waitForText('Slider Gallery')
                ->assertSee('Slider Gallery')
                ->attach('#name', $photo)
                ->press('Add Image')
                ->waitForText('Slider Image Added Successfully')
                ->assertSee('Slider Image Added Successfully')

                //delete image
                ->click('#delete7')
                ->waitForDialog()
                ->acceptDialog()
                ->waitForText('Slider Deleted Successfully')
                ->assertSee('Slider Deleted Successfully');

            $this->scrollToBottom($browser);

            // Social Media Section
            $browser->type('.testSocialName', 'Social media')
                ->type('#url', 'https://www.url.com')
                ->attach('.testFile', $photo)
                ->press('Save Social Media')
                ->waitForText('Social Media Created Successfully')
                ->assertSee('Social Media Created Successfully')

                //Edit Social Media
                ->click('#socialEdit5')
                ->pause(500)
                ->type('.testSocialName', 'Social Medial Update')
                ->type('#url', 'https://www.update-url.com')
                ->attach('.testFile', $photo)
                ->press('Save Social Media')
                ->waitForText('Social Media Updated Successfully')
                ->assertSee('Social Media Updated Successfully');

            // delete Social Media
            $this->scrollToBottom($browser);
            $browser->click('#socialDelete5')
                ->waitForDialog()
                ->acceptDialog()
                ->waitForText('Social Media Deleted Successfully')
                ->assertSee('Social Media Deleted Successfully');

            $this->scrollToTop($browser);
            $browser->pause(1000)
                ->clickLink('Currency')
                ->waitForText('Currency Setting')
                ->assertSee('Currency Setting')
                ->type('#name', 'New Currency')
                ->type('#code', 'NC')
                ->type('#symbol', '&')
                ->press('Save')
                ->waitForText('Currency Created Successfully')
                ->assertSee('Currency Created Successfully')

                // edit Currency
                ->click('#edit5')
                ->pause(500)
                ->type('#name', 'New Currency (Update)')
                ->type('#code', 'NCU')
                ->type('#symbol', '!&')
                ->press('Save')
                ->waitForText('Currency Updated Successfully')
                ->assertSee('Currency Updated Successfully')

                // delete Currency
                ->click('#delete5')
                ->waitForDialog()
                ->acceptDialog()
                ->waitForText('Currency Deleted Successfully')
                ->assertSee('Currency Deleted Successfully');

            // // Role Page
            // // Role Page

            $this->scrollToTop($browser);
            $browser->pause(1000)
                ->clickLink('Roles')
                ->waitForText('Create Role')
                ->assertSee('Create Role')
                ->clickLink('Create Role')
                ->waitForText('Role Create')
                ->assertSee('Role Create')
                ->type('#name', 'Librarian')
                ->type('#description', 'This role is for Librarian')
                ->check('#select-all');

            // create role
            $this->scrollToBottom($browser);
            $browser->uncheck('#transaction-type')
                ->uncheck('#scheduleindex')
                ->uncheck('#currency')
                ->press('Create')
                ->waitForText('Roles & Permissions')
                ->assertSee('Roles & Permissions');

            // // Language Page
            $browser->pause(1000)
                ->clickLink('Language')
                ->waitForText('All Language')
                ->assertSee('All Language')
                ->clickLink('Create')
                ->waitForText('Language Create')
                ->assertSee('Language Create')
                ->type('input[type="search"]', 'span')
                ->keys('input[type="search"]', '{enter}')
                ->pause(500)
                ->press('Save')
                ->waitForText('Language Information')
                ->assertSee('Language Information')

                // //translate page
                ->click('#testTranslate3')
                ->waitForText('Spanish; Castilian - Translate Language')
                ->assertSee('Spanish; Castilian - Translate Language')
                ->type('#login', 'Login (Change)')
                ->type('#addtransaction', 'Add Transaction (Change)')
                ->type('#alltransaction', 'All Transaction (Change)')
                ->type('#transactioncategories', 'Transaction Categories (Change)');

            $this->scrollToBottom($browser);
            $browser->pause(1000)
                ->press('Update')
                ->waitForText('Language Information')
                ->assertSee('Language Information')

                //delete Language
                ->click('#testDelete3')
                ->waitForDialog()
                ->acceptDialog()
                ->waitForText('Language deleted successfully.')
                ->assertSee('Language deleted successfully.');

            // // Recaptcha page
            // // Recaptcha page
            $browser->clickLink('Recaptcha')
                ->waitForText('Recaptcha Setting')
                ->assertSee('Recaptcha Setting')
                ->type('#recaptcha_key', 'MyRecaptachaKey')
                ->type('#recaptcha_secret', 'MySecret')
                ->press('Save')
                ->pause(5000);

            //SMTP page
            //SMTP page
            $browser->waitForText('SMTP')
                ->clickLink('SMTP')
                ->waitForText('Your Application might show an error')
                ->assertSee('Your Application might show an error')
                ->type('#mail_host', 'mail.mail.com')
                ->type('#mail_port', '465')
                ->type('#mail_username', 'lomeyo@adeveloper.info')
                ->type('#mail_password', '12345678')
                ->click('#mail_encryption_tls')
                ->type('#mail_from_address', 'lomeyo@adeveloper.info')
                ->type('#mail_from_name', 'schooling')
                ->press('Submit')
                ->pause(5000);

            //Paypal  Update
            $browser->waitForText('Payment')
                ->clickLink('Payment')
                ->waitForText('Payment Setting')
                ->assertSee('Payment Setting')
                ->type('#paypal_live_client_id', 'paypalId')
                ->type('#paypal_live_client_secret', 'paypalSecret')
                ->type('#paypal_sandbox_client_id', 'paypalSandboxClientId')
                ->type('#paypal_sandbox_client_secret', 'paypal_sandbox_client_secret')
                ->type('#paypal_live_client_id', 'paypalId')
                ->type('#paypal_live_client_id', 'paypalId')
                ->click('#paypalUpdate')
                ->pause(6000);

            //Stripe  Update
            $browser->waitForText('Payment')
                ->waitForText('Stripe')
                ->assertSee('Stripe')
                ->type('#stripe_key', 'stripe_key')
                ->type('#stripe_secret', 'stripe_secret')
                ->click('#stripeUpdate')
                ->pause(6000);

            //Razorpay  Update
            $browser->waitForText('Payment')
                ->waitForText('Razorpay')
                ->assertSee('Razorpay');
            $this->scrollHalf($browser);
            $browser->type('#razorpay_key', 'razorpay_key')
                ->type('#razorpay_secret', 'razorpay_secret')
                ->click('#razorUpdate')
                ->pause(6000);

            //Flutterwave  Update
            $browser->waitForText('Flutterwave')
                ->assertSee('Flutterwave');
            $this->scrollHalf($browser);
            $browser->type('#flw_public_key', 'flw_public_key')
                ->type('#flw_secret', 'flw_secret')
                ->type('#flw_secret_hash', 'flw_secret_hash')
                ->click('#flwUpdate')
                ->pause(6000);

            $browser->waitForText('Payment Setting');
            $this->scrollToBottom($browser);
            //Midtrans  Update
            $browser->waitForText('Midtrans')
                ->pause(1000)
                ->assertSee('Midtrans')
                ->type('#midtrans_merchant_id', 'midtrans_merchant_id')
                ->type('#midtrans_client_key', 'midtrans_client_key')
                ->type('#midtrans_server_key', 'midtrans_server_key')
                ->click('#midUpdate')
                ->pause(6000);
            $this->scrollToTop($browser);

            // // Upgrade page
            // // Upgrade page

            $browser->waitForText('Upgrade')
                ->assertSee('Upgrade')
                ->clickLink('Upgrade')
                ->waitForText('Upgrade Guide')
                ->press('Upgrade Now')
                ->waitForDialog()
                ->acceptDialog()
                ->waitForText('Application Upgrade Successfully')
                ->assertSee('Application Upgrade Successfully');

            // Other Page
            // Other Page

            $browser->waitForText('Other')
                ->assertSee('Other')
                ->clickLink('Other')
                ->waitForText('Other Settings')
                ->click('.testRoute')
                ->waitForText('Route cache cleared')
                ->assertSee('Route cache cleared')
                ->click('.testConfig')
                ->waitForText('Config cache cleared')
                ->assertSee('Config cache cleared')
                ->click('.testMigration')
                ->waitForText('Application migration migrated')
                ->assertSee('Application migration migrated');

            // // Cms page
            // // Cms page

            $browser->waitForText('Cms')
                ->assertSee('Cms')
                ->clickLink('Cms')
                ->waitForText('Cms Management')
                ->type('#title', 'Notice')
                ->type('#description', 'Description');
            $this->scrollToBottom($browser);
            $browser->press('Update')
                ->waitForText('Onboarding content updated.')
                ->assertSee('Onboarding content updated.');
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

    private function sidebarScroll(Browser $browser)
    {

        $browser->script('
            var div = document.querySelector(".sidebar");
            div.scrollTop = div.scrollHeight;
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

    private function scrollToTop(Browser $browser)
    {
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
}
