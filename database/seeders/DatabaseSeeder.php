<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->devVersion();
        $this->prodVersion();
    }

    // This prodVersion use for packaging time
    public function prodVersion()
    {
        $this->call([
            RolePermissionSeeder::class,
            UserSeeder2::class,
            LanguageSeeder::class,
            SettingSeeder::class,
            CurrencySeeder::class,
            AdmissionFormSeeder::class,
            LeaveTypeSeeder::class,
            OnboardingSeeder::class,
        ]);
    }

    // This devVersion use for development time
    public function devVersion()
    {
        $this->call([
            DepartmentSeeder::class,
            RolePermissionSeeder::class,
            CourseSeeder::class,
            CurrencySeeder::class,
            PlanSeeder::class,
            UserSeeder::class,
            LanguageSeeder::class,
            SubjectSeeder::class,
            GradeSeeder::class,
            UserSubjectAssignSeeder::class,
            ExamSeeder::class,
            ResultRuleSeeder::class,
            ExamResultSeeder::class,
            ExamMarkSeeder::class,
            EventSeeder::class,
            AssignmentSeeder::class,
            SyllabusSeeder::class,
            InvoiceSeeder::class,
            TransactionTypeSeeder::class,
            TransactionSeeder::class,
            LeaveTypeSeeder::class,
            LeaveSeeder::class,
            StudentAttendanceSeeder::class,
            MeetingSeeder::class,
            ScheduleSeeder::class,
            OnlineClassSeeder::class,
            NoticeSeeder::class,
            CommentSeeder::class,
            ClassRoutineSeeder::class,
            SubmittedAssignmentSeeder::class,
            CommentReplySeeder::class,
            SettingSeeder::class,
            OrderSeeder::class,
            ChatGroupSeeder::class,
            ChatGroupUserSeeder::class,
            ChatGroupConversationSeeder::class,
            HolidaySeeder::class,
            GallerySliderSeeder::class,
            UserCourseSeeder::class,
            SocialLinkSeeder::class,
            AdmissionFormSeeder::class,
            OnboardingSeeder::class,
            SmsTemplateSeeder::class,
        ]);
    }
}
