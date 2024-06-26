<?php

namespace App\Http\Controllers\Subject;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Subject\SubjectCreateRequest;
use App\Http\Requests\Admin\Subject\SubjectUpdateRequest;
use App\Models\Course;
use App\Models\Subject;
use App\Models\TeacherSubject;
use App\Services\Admin\Subject\SubjectChatGroupService;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        abort_if(! userCan('academic.management'), 403);

        if ($request->has('course_id') && $request->filled('course_id')) {
            $subjects = Subject::with('course')->where('course_id', $request->course_id)->latest()->paginate(9);
        } else {
            $subjects = Subject::with('course')->latest()->paginate(9);
        }

        $classes = Course::latest()->get();

        return inertia('Admin/Subject/Index', [
            'subjects' => $subjects,
            'classes' => $classes,
            'query' => $request,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(
        SubjectCreateRequest $request,
        SubjectChatGroupService $subjectChatGroupService
    ) {
        abort_if(! userCan('academic.management'), 403);

        $sub = Subject::create([ // data store part
            'course_id' => $request->class,
            'name' => $request->name,
            'color' => $request->color,
        ]);

        $subjectChatGroupService->subjectChatGroupStore($sub);

        $this->flashSuccess('Subject created successfully.'); // return response

        return back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(
        SubjectUpdateRequest $request,
        Subject $subject,
        SubjectChatGroupService $subjectChatGroupService
    ) {
        abort_if(! userCan('academic.management'), 403);

        $subject->update([ // data update part
            'course_id' => $request->course,
            'name' => $request->name,
            'color' => $request->color,
        ]);

        $subjectChatGroupService->subjectChatGroupUpdate($subject);

        $this->flashSuccess('Subject updated successfully.'); // return response

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subject $subject)
    {
        abort_if(! userCan('academic.management'), 403);

        $subject->delete(); // delete

        $this->flashSuccess('Subject deleted successfully.'); // return response

        return back();
    }

    public function fetchTeachers(Subject $subject)
    {
        return TeacherSubject::with(['teacher'])->where('subject_id', $subject->id)->first();
    }
}
