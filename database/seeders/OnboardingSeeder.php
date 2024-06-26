<?php

namespace Database\Seeders;

use App\Models\Onboarding;
use Illuminate\Database\Seeder;

class OnboardingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $contents = [
            [
                'menu_slug' => 'welcome',
                'title' => 'Welcome',
                'description' => 'Welcome to our Schooling App! Explore all the features and resources available to students, teachers, accountants, and parents.',
            ],
            [
                'menu_slug' => 'notice_board_top_section',
                'title' => 'Notice Board',
                'description' => 'Stay up to date with the latest news, announcements, and events through the Notice Board menu.',
            ],
            [
                'menu_slug' => 'leave_request_top_section',
                'title' => 'Leave Request',
                'description' => 'Easily request time off and track the status of your leave requests through the Leave Request menu.',
            ],
            [
                'menu_slug' => 'notification',
                'title' => 'Notifications',
                'description' => 'You can easilly get your all notifications from here',
            ],
            [
                'menu_slug' => 'currency',
                'title' => 'Currencies',
                'description' => 'You can easilly change your all from here',
            ],
            [
                'menu_slug' => 'language',
                'title' => 'Languages',
                'description' => 'You can easilly change your all from here',
            ],
            [
                'menu_slug' => 'darkMode',
                'title' => 'Light and Dark Mode',
                'description' => 'Easily change your website mode from light to dark or dark to light.',
            ],
            [
                'menu_slug' => 'academic_section',
                'title' => 'Academic Menu',
                'description' => 'Access all academic resources and tools in one place, including course materials, grades, and schedules.',
            ],
            [
                'menu_slug' => 'leave_request_section',
                'title' => 'Leave Request',
                'description' => 'Easily request time off and track the status of your leave requests through the Leave Request menu.',
            ],
            [
                'menu_slug' => 'transaction_section',
                'title' => 'All Transactions',
                'description' => 'Manage your finances effectively with the All Transactions menu. View and organize all your transactions in one place.',
            ],
            [
                'menu_slug' => 'notice_board_section',
                'title' => 'Notice Board',
                'description' => 'Stay up to date with the latest news, announcements, and events through the Notice Board menu.',
            ],
            [
                'menu_slug' => 'website_settings_section',
                'title' => 'Website Settings',
                'description' => 'Customize and manage your website easily with the Website Settings feature. Update design, add pages, and optimize settings.',
            ],
            [
                'menu_slug' => 'add_transaction_section',
                'title' => 'Add Transaction',
                'description' => 'Easily add new transactions to keep track of your finances and stay organized.',
            ],
            [
                'menu_slug' => 'recurring_invoices_section',
                'title' => 'Recurring Invoices',
                'description' => 'Save time and automate your billing with recurring invoices. Set up automatic billing schedules for your customers.',
            ],
            [
                'menu_slug' => 'my_course_section',
                'title' => 'My Course',
                'description' => 'Access all of your course information in one place. View lectures, assignments, and grades, and stay up to date on course announcements.',
            ],
            [
                'menu_slug' => 'assignment_section',
                'title' => 'Assignment Page',
                'description' => 'Manage and track your course assignments, deadlines, and grades on a single page. Stay organized and never miss a deadline.',
            ],
            [
                'menu_slug' => 'online_class_section',
                'title' => 'Online Class',
                'description' => 'Join live classes, access course materials, and interact with your peers using the Online Class feature. Stay engaged and learn from anywhere.',
            ],
            [
                'menu_slug' => 'group_chat_section',
                'title' => 'Group Chat',
                'description' => 'Connect and collaborate with your classmates using Group Chat. Share ideas, ask questions, and stay in touch with the community.',
            ],
            [
                'menu_slug' => 'your_children_section',
                'title' => 'Your Children',
                'description' => "Get started with managing your child's academic progress, attendance, and more with our easy-to-use Children section.",
            ],
            [
                'menu_slug' => 'unpaid_invoice_section',
                'title' => 'Unpaid Invoices',
                'description' => 'Manage your unpaid invoices easily and keep track of outstanding payments with our user-friendly interface. Stay on top of your finances and never miss a payment again.',
            ],
            [
                'menu_slug' => 'meeting',
                'title' => 'Meetings',
                'description' => 'Manage your meetings from here.',
            ],
            [
                'menu_slug' => 'event_section',
                'title' => 'Events',
                'description' => 'Manage your events from here.',
            ],
            [
                'menu_slug' => 'admission_plan_section',
                'title' => 'Admission Plan',
                'description' => 'Create a comprehensive plan for the admission process, track progress, and manage applications efficiently.',
            ],
            [
                'menu_slug' => 'student_section',
                'title' => 'Student Management',
                'description' => 'Manage your students from here.',
            ],
            [
                'menu_slug' => 'admission_section',
                'title' => 'Admission Section',
                'description' => 'Manage your admissions from here.',
            ],
            [
                'menu_slug' => 'promotion_section',
                'title' => 'Promotion Section',
                'description' => 'Manage your student promotions from here.',
            ],
            [
                'menu_slug' => 'admission_form_section',
                'title' => 'Admission Form Section',
                'description' => 'Manage your Admission form fields from here.',
            ],
            [
                'menu_slug' => 'users_section',
                'title' => 'User Management',
                'description' => 'Manage your users from here.',
            ],
            [
                'menu_slug' => 'teachers_section',
                'title' => 'Teacher Management',
                'description' => 'Manage your teachers from here.',
            ],
            [
                'menu_slug' => 'holiday_section',
                'title' => 'Holiday Section',
                'description' => 'Manage your holiday section from here.',
            ],
            [
                'menu_slug' => 'report_section',
                'title' => 'Report Section',
                'description' => 'Export your reports from here.',
            ],
            [
                'menu_slug' => 'sms_section',
                'title' => 'SMS Section',
                'description' => 'You can send sms from here to your app users',
            ],
            [
                'menu_slug' => 'syllabus_section',
                'title' => 'Syllabus Section',
                'description' => 'Manage your subject syllabus from here.',
            ],
            [
                'menu_slug' => 'my_schedule_section',
                'title' => 'My Schedule',
                'description' => 'Manage your schedule from here.',
            ],
            [
                'menu_slug' => 'attendance_section',
                'title' => 'Attendance Section',
                'description' => 'Teachers can record student attendance from here.',
            ],
            [
                'menu_slug' => 'exam_section',
                'title' => 'Exam Section',
                'description' => 'Teachers can record all exam data here.',
            ],
            [
                'menu_slug' => 'student_attendance_section',
                'title' => 'Student Attendance Section',
                'description' => 'View subject-wise attendance from here.',
            ],
            [
                'menu_slug' => 'student_result_section',
                'title' => 'Student Result Section',
                'description' => 'View your results from here.',
            ],
            [
                'menu_slug' => 'student_fees_section',
                'title' => 'Student Fees Section',
                'description' => 'View your fees information from here.',
            ],
            [
                'menu_slug' => 'topbar_section',
                'title' => 'Easy topbar',
                'description' => 'Most used settings items are listed in here, you can quickly change your settings from here',
            ],
            [
                'menu_slug' => 'sidebar_section',
                'title' => 'Sidelink bar',
                'description' => 'You can easily visit any page from here',
            ],
        ];

        foreach ($contents as $key => $content) {
            Onboarding::create([
                'menu_slug' => $content['menu_slug'],
                'title' => $content['title'],
                'description' => $content['description'],
            ]);
        }
    }
}
