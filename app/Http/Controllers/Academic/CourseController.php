<?php

namespace App\Http\Controllers\Academic;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Subject;
use App\Services\Admin\Subject\SubjectChatGroupService;
use Barryvdh\DomPDF\Facade\Pdf;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Http\Request;


class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_if(! userCan('academic.management'), 403);

        $courses = Course::withCount('students')->with(['subjects', 'plans'])->orderBy('created_at', 'desc')->get();

        $courses->each(function ($assignment) {
            $assignment->load(['students' => function ($q) {
                return $q->limit(7)->with('user:id,name,username,profile_photo_path');
            }]);
        });

        return inertia('Admin/Course/Index', compact(['courses']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, SubjectChatGroupService $subjectChatGroupService)
    {
        abort_if(! userCan('academic.management'), 403);

        $request->validate([
            'name' => 'required|unique:courses,name',
        ]);

        $course = Course::create([
            'name' => $request->name,
            'has_multiple_subject' => $request->has_multiple_subject ?? 0,
        ]);

        if ($request->has_multiple_subject) {
            $subjects = $request->subjects;

            foreach ($subjects as $subject) {
                $sub = $course->subjects()->create([
                    'name' => $subject['name'],
                    'color' => $subject['color'],
                ]);

                $subjectChatGroupService->subjectChatGroupStore($sub);
            }
        } else {
            $sub = $course->subjects()->create([
                'name' => $request->name.' Subject',
                'color' => '#C93737',
            ]);
            $subjectChatGroupService->subjectChatGroupStore($sub);
        }

        $this->flashSuccess('Course created successfully.');

        return back();
    }

    public function getAllClassesWithQrCodes()
{
    $classes = Course::all();

    $coursesWithQrCodes = $classes->map(function ($class) {
        // Generate QR Code
        $qrCode = QrCode::size(300)->generate($class->id);

        // Encode QR Code to base64
        $qrCodeBase64 = 'data:image/png;base64,' . base64_encode($qrCode);

        // Add QR Code to class object
        $class->qr_code = $qrCodeBase64;

        return $class;
    });

    return inertia('CoursesQrCodes', ['courses' => $coursesWithQrCodes]);
}


    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, SubjectChatGroupService $subjectChatGroupService)
    {
        abort_if(! userCan('academic.management'), 403);

        $course = Course::findOrFail($id);

        $request->validate([
            'name' => 'required|unique:courses,name,'.$course->id,
        ], [
            'name.required' => 'The name field is required',
        ]);

        $course->update([
            'name' => $request->name,
            'has_multiple_subject' => $request->has_multiple_subject ?? 0,
        ]);

        if ($request->has_multiple_subject) {
            $course->subjects()->delete();
            $subjects = $request->subjects;

            foreach ($subjects as $subject) {
                $sub = $course->subjects()->create([
                    'name' => $subject['name'],
                    'color' => $subject['color'],
                ]);

                $subjectChatGroupService->subjectChatGroupStore($sub);
            }
        } else {
            $course->subjects()->delete();
            $sub = $course->subjects()->create([
                'name' => $request->name.' Subject',
                'color' => '#C93737',
            ]);
            $subjectChatGroupService->subjectChatGroupStore($sub);
        }

        $this->flashSuccess('Course updated successfully.');

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        abort_if(! userCan('academic.management'), 403);

        $course = Course::findOrFail($id);
        if ($course) {
            $course->delete();
            $this->flashSuccess('Course deleted successfully.');
        }

        return back();
    }

    /**
     * Course store by API
     */
    public function apiClassStore(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:courses,name',
            // 'sections' => 'required',
        ]);

        $course = Course::create([
            'name' => $request->name,
        ]);

        return response()->json(['success' => true, 'data' => $course]);
    }

    /**
     * Get Class store by API
     *
     * @return Response
     */
    public function apiClassIndex()
    {
        $courses = Course::latest()->get(['id', 'name']);

        return response()->json(['success' => true, 'courses' => $courses]);
    }

    /**
     * Fetch Subjects by class
     *
     * @return Response
     */
    public function fetchSubjects(Course $course)
    {
        return Subject::where('course_id', $course->id)->get(['id', 'name']);
    }

    /**
     * Fetch Students by course
     *
     * @return Response
     */
    public function fetchStudent(Course $course)
    {
        $course = $course->load('students:id,user_id,course_id,is_passed', 'students.user:id,name,username,date_of_birth', 'students.user.parents:id,name,phone', 'students.user.profile:id,user_id,student_id');

        return $course->students;
    }
}
