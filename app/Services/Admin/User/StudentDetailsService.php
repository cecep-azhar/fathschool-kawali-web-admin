<?php

namespace App\Services\Admin\User;

use App\Models\Exam;
use App\Models\ExamResult;

class StudentDetailsService
{
    public function execute(object $request, object $student): array
    {
        $student->load('profile', 'department', 'documents');
        $leaves = $student->leaves()->latest()->take(20)->get();
        $transactions = $student->transactions()->latest()->paginate(15)->onEachSide(-1);
        $attendances_data = $student->attendances()->latest()->with('subject')->paginate(15)->onEachSide(-1);

        $assignment_marks = round($student->submitted_assignments()->avg('gained_mark'), 2);

        $attendances = $student->attendances()->count();
        $attendance_present_marks = $student->attendances()->latest()->present()->count();
        $attendance_marks = $attendances ? round(($attendance_present_marks / $attendances) * 100, 2) : 0;

        $courses_id = $student->courses()->get()->map(function ($q) {
            return $q->course_id;
        });
        $parents = $student->parents;
        $exams = Exam::whereIn('course_id', $courses_id)->latest()->paginate(15)->onEachSide(-1);
        $courses = $courses_id = $student->courses()->get()->map(function ($q) {
            return $q->course->name ?? '';
        });

        $all_exams = Exam::whereIn('course_id', $courses_id)->pluck('id');
        $results = ExamResult::with('exam:id,name,start_date,end_date')
            ->whereIn('exam_id', $all_exams)
            ->latest()
            ->paginate(5)
            ->onEachSide(0);

        return [
            'student' => $student,
            'leaves' => $leaves,
            'transactions' => $transactions,
            'assignment_marks' => $assignment_marks,
            'attendance_marks' => $attendance_marks,
            'attendances_data' => $attendances_data,
            'exams' => $exams,
            'results' => $results,
            'parents' => $parents,
            'courses' => $courses,
            'request_data' => $request,
        ];
    }
}
