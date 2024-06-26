<?php

namespace App\Http\Controllers\Academic;

use App\Actions\File\FileUpload;
use App\Http\Controllers\Controller;
use App\Imports\ExamMarkImport;
use App\Models\Course;
use App\Models\Exam;
use App\Models\ExamResult;
use App\Traits\CheckParentOrChildren;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ExamResultController extends Controller
{
    use CheckParentOrChildren;

    public function index()
    {
        abort_if(! userCan('exam-result.index'), 403);
        $user = $this->checkUser();

        if ($user->role == 'Student') {

            $course_ids = $user->courses->pluck('course_id');
            $exams = Exam::whereIn('course_id', $course_ids)->pluck('id');
            $results = ExamResult::with('exam:id,name,slug,start_date,end_date')->whereIn('exam_id', $exams)->latest()->get();

            return inertia('Student/Results', compact('results'));
        } else {

            $teacher_course_ids = authUser()->subjects()->with('subject')->get()->map(function ($query) {
                return $query->subject->course_id ?? '';
            })->toArray();
            $teacher_courses = Course::whereIn('id', $teacher_course_ids)->pluck('id');
            $exams = Exam::whereIn('course_id', $teacher_courses)->get();
            $exam_ids = $exams->pluck('id')->toArray();
            $results = ExamResult::with('exam:id,name,start_date,end_date')->whereIn('exam_id', $exam_ids)->latest()->get();

            return inertia('Teacher/ExamResult/Index', compact('exams', 'results'));
        }
    }

    public function store(Request $request)
    {
        abort_if(! userCan('exam-result.create'), 403);

        $request->validate([
            'exam' => 'required|exists:exams,id',
            'attachment' => 'required|file|mimes:xlsx',
        ]);

        if ($request->hasFile('attachment')) {
            $attachment_url = FileUpload::uploadImage($request->attachment, 'results');
            Excel::import(new ExamMarkImport($request->exam), $attachment_url);
        }

        ExamResult::create([
            'exam_id' => $request->exam,
            'attachment' => $attachment_url ?? '',
        ]);

        $this->flashSuccess('Exam result imported successfully');

        return back();
    }

    public function update(Request $request, ExamResult $examResult)
    {
        abort_if(! userCan('exam-result.edit'), 403);

        $request->validate([
            'exam' => 'required|exists:exams,id',
        ]);

        if ($request->hasFile('attachment')) {
            $request->validate([
                'attachment' => 'required|file|mimes:xlsx',
            ]);
            $attachment_url = FileUpload::uploadImage($request->attachment, 'results');
        }

        $examResult->update([
            'exam_id' => $request->exam,
            'attachment' => $attachment_url ?? $examResult->attachment,
        ]);

        $this->flashSuccess('Exam result updated successfully');

        return back();
    }
}
