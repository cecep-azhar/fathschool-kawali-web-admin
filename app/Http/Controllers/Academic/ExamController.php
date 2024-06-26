<?php

namespace App\Http\Controllers\Academic;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Exam;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ExamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_if(! userCan('academic.management'), 403);

        $exams = Exam::latest()->with('course')->latest()->paginate(15)->onEachSide(-1);
        $courses = Course::orderBy('name', 'asc')->get();
        // $sections = Section::get(['id', 'name', 'slug', 'capacity']);

        return inertia('Admin/Exam/Index', [
            'exams' => $exams,
            'courses' => $courses,
            // 'sections' => $sections
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_if(! userCan('academic.management'), 403);

        $courses = Course::orderBy('name', 'asc')->get();

        return inertia('Admin/Exam/Form', [
            'courses' => $courses,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        abort_if(! userCan('academic.management'), 403);

        $this->validate($request, [
            'name' => 'required|max:95',
            'start_date' => 'required',
            'end_date' => 'required',
            'course' => 'required',
            'grade' => 'required',
            'gpa' => 'required',
        ]);

        Exam::create([
            'name' => $request->name,
            'description' => $request->description,
            'start_date' => Carbon::parse($request->start_date),
            'end_date' => Carbon::parse($request->end_date),
            'course_id' => $request->course,
            'grade' => $request->grade,
            'gpa' => $request->gpa,
        ]);

        $this->flashSuccess('Exam created successfully');

        return redirect()->route('exam.index');
    }

    /**
     * Show the form for editing a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Exam $exam)
    {
        abort_if(! userCan('academic.management'), 403);

        $courses = Course::orderBy('name', 'asc')->get();

        return inertia('Admin/Exam/Form', [
            'courses' => $courses,
            'exam' => $exam,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Exam $exam)
    {
        abort_if(! userCan('academic.management'), 403);

        $this->validate($request, [
            'name' => 'required|max:95',
            'start_date' => 'required',
            'end_date' => 'required',
            'course' => 'required',
            'grade' => 'required',
            'gpa' => 'required',
        ]);

        $exam->update([
            'name' => $request->name,
            'description' => $request->description,
            'start_date' => Carbon::parse($request->start_date),
            'end_date' => Carbon::parse($request->end_date),
            'course_id' => $request->course,
            'grade' => $request->grade,
            'gpa' => $request->gpa,
        ]);

        $this->flashSuccess('Exam updated successfully');

        return redirect()->route('exam.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Exam $exam)
    {
        abort_if(! userCan('academic.management'), 403);

        $exam->delete();

        $this->flashSuccess('Exam deleted successfully.');

        return back();
    }
}
