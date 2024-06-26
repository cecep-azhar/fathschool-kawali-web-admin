<?php

namespace App\Http\Controllers\Academic;

use App\Http\Controllers\Controller;
use App\Models\Grade;
use Illuminate\Http\Request;

class GradeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_if(! userCan('academic.management'), 403);

        $grades = Grade::latest()->paginate(15)->onEachSide(-1);

        return inertia('Admin/Grade/Index', [
            'grades' => $grades,
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

        $request->validate([
            'marks' => 'required',
            'grade' => 'required',
            'gpa' => 'required',
        ]);

        Grade::create([
            'marks' => $request->marks,
            'grade' => $request->grade,
            'gpa' => $request->gpa,
        ]);

        $this->flashSuccess('Grade created');

        return back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Grade $grade)
    {
        abort_if(! userCan('academic.management'), 403);

        $request->validate([
            'marks' => 'required',
            'grade' => 'required',
            'gpa' => 'required',
        ]);

        $grade->update([
            'marks' => $request->marks,
            'grade' => $request->grade,
            'gpa' => $request->gpa,
        ]);

        $this->flashSuccess('Grade updated');

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Grade $grade)
    {
        abort_if(! userCan('academic.management'), 403);

        $grade->delete();

        $this->flashSuccess('Grade deleted');

        return back();
    }
}
