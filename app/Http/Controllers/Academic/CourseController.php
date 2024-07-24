<?php

namespace App\Http\Controllers\Academic;

use App\Actions\File\FileDelete;
use App\Actions\File\FileUpload;
use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Subject;
use App\Services\Admin\Subject\SubjectChatGroupService;
use Barryvdh\DomPDF\Facade\Pdf;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Http\Request;
use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Writer\PngWriter;
use Illuminate\Support\Facades\Storage;
use Ramsey\Uuid\Uuid;
use Illuminate\Support\Str;


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
            'qr_code_id' => 'required|unique:courses,qr_code_id|max:10',
            'file' => 'required|image',
        ]);

        if ($request->hasFile('file')) {
            $url = FileUpload::uploadImage($request->file, 'course');
        }

        $course = Course::create([
            'name' => $request->name,
            'qr_code_id' => $request->qr_code_id,
            'photo' => $url ?? '',
            'has_multiple_subject' => $request->has_multiple_subject ?? 0,
        ]);

        // Generate QR Code for the new course ID
        $qrCode = Builder::create()
            ->writer(new PngWriter())
            ->data($request->qr_code_id) // Use the QR code ID from the request
            ->size(150)
            ->build();

        $qrCodePath = 'public/qr_codes/' . $request->qr_code_id . '.png';
        Storage::put($qrCodePath, $qrCode->getString());

        // Save the path to the QR Code in the database
        $course->qr_code_path = $qrCodePath;
        $course->save();

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

        // Validasi termasuk file
        $request->validate([
            'name' => 'required|unique:courses,name,'.$course->id,
            'file' => 'nullable|image',
        ], [
            'name.required' => 'The name field is required',
        ]);

        if ($request->hasFile('file')) {
            $url = FileUpload::uploadImage($request->file('file'), 'course');
            FileDelete::deleteImage($course->photo);
        }

        $course->update([
            'name' => $request->name,
            'photo' => $url ?? $course->photo,
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






    public function getAllClassesWithQrCodes()
    {
        abort_if(! userCan('academic.management'), 403);
        // Ambil semua courses beserta path QR Code
        $classes = Course::all(['id', 'qr_code_id', 'name', 'qr_code_path']);

        // Map melalui setiap kelas untuk menambahkan path QR Code
        $coursesWithQrCodes = $classes->map(function ($class) {
            // Ambil path QR Code dari database
            $qrCodePath = Storage::url($class->qr_code_path);

            // Tambahkan path QR Code ke objek class
            $class->qr_code_url = $qrCodePath;

            return $class;
        });

        return inertia('CoursesQrCodes', ['courses' => $coursesWithQrCodes]);
    }

    public function printQrCode($qr_code_id)
    {
        $course = Course::findOrFail($qr_code_id);

        // Generate QR Code
        $qrCode = Builder::create()
            ->writer(new PngWriter())
            ->data($course->qr_code_id)
            ->size(300)
            ->build();

        // Create PDF
        $pdf = Pdf::loadView('qr_code', [
            'course' => $course,
            'qrCode' => $qrCode->getString()
        ]);

        // Download the PDF
        return $pdf->download('course_qr_code.pdf');
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
