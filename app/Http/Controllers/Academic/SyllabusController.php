<?php

namespace App\Http\Controllers\Academic;

use App\Actions\File\FileDelete;
use App\Actions\File\FileUpload;
use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Subject;
use App\Models\Syllabus;
use Illuminate\Http\Request;

class SyllabusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        abort_if(! userCan('syllabus.index'), 403);

        $query = Syllabus::query()->latest()->with('teacher:id,name,profile_photo_path,email', 'subject:id,name', 'class');

        // title filter
        if ($request->has('title') && $request->title != null) {
            $query->whereHas('subject', function ($q) use ($request) {
                $q->where('name', 'Like', '%'.$request->title.'%')
                    ->orWhere('slug', 'Like', '%'.$request->title.'%');
            })->orWhereHas('class', function ($q) use ($request) {
                $q->where('name', 'Like', '%'.$request->title.'%')
                    ->orWhere('slug', 'Like', '%'.$request->title.'%');
            });
        }

        // class filter
        if ($request->has('class') && $request->class != null) {
            $query->whereHas('class', function ($q) use ($request) {
                $q->where('slug', $request->class);
            });
        }

        $syllabuses = $query->paginate(15)->onEachSide(-1);

        $subject_ids = authUser()->subjects()->get()->pluck('subject_id')->toArray();
        $subjects = Subject::whereIn('id', $subject_ids)->latest()->get();
        $course_ids = $subjects->pluck('course_id')->toArray();
        $classes = Course::whereIn('id', $course_ids)->latest()->get(['id', 'name', 'slug']);

        // $course_ids = authUser()->subjects()->get()->map(function ($q) {
        //     return $q->subject->course_id ?? '';
        // });

        return inertia('Teacher/Syllabus', [
            'syllabuses' => $syllabuses,
            'classes' => $classes,
            'subjects' => $subjects,
            'filter_data' => $request,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        abort_if(! userCan('syllabus.create'), 403);

        $request->validate([
            'teacher' => 'required',
            'subject' => 'required',
            'class' => 'required',
            'syllabus' => 'required|mimes:pdf,doc,docx,zip,7z,jpeg,png,jpg,gif,svg',
        ]);

        $syllabus = Syllabus::create([
            'user_id' => $request->teacher,
            'course_id' => $request->class,
            'subject_id' => $request->subject,
        ]);

        // for ducument upload
        if ($request->hasFile('syllabus')) {

            $url = FileUpload::uploadImage($request->syllabus, 'syllabus');
            $syllabus->update([
                'syllabus' => $url,
            ]);
        }

        $this->flashSuccess('Syllabus saved !');

        return back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Syllabus $syllabu)
    {
        abort_if(! userCan('syllabus.edit'), 403);

        $request->validate([
            'teacher' => 'required',
            'class' => 'required',
            'subject' => 'required',
        ]);

        if ($request->hasFile('syllabus')) {
            $request->validate([
                'syllabus' => 'required|mimes:pdf,doc,docx,zip,7z,jpeg,png,jpg,gif,svg',
            ]);
        }

        $syllabu->update([
            'user_id' => $request->teacher,
            'course_id' => $request->class,
            'subject_id' => $request->subject,
        ]);

        // for ducument upload
        if ($request->hasFile('syllabus')) {

            FileDelete::deleteImage($syllabu->syllabus); // delete old one

            $url = FileUpload::uploadImage($request->syllabus, 'syllabus');
            $syllabu->update([
                'syllabus' => $url,
            ]);
        }

        $this->flashSuccess('Syllabus updated !');

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Syllabus $syllabu)
    {
        abort_if(! userCan('syllabus.destroy'), 403);

        FileDelete::deleteImage($syllabu->syllabus); // delete old one

        $syllabu->delete();

        $this->flashSuccess('Syllabus deleted !');

        return back();
    }
}
