<?php

namespace App\Http\Controllers\Academic;

use App\Http\Controllers\Controller;
use App\Models\StudyProgram;
use Illuminate\Http\Request;

class StudyProgramController extends Controller
{
    public function index()
    {
        abort_if(! userCan('academic.management'), 403);

        $studyPrograms = StudyProgram::latest()->paginate(15)->onEachSide(-1);

        return inertia('Admin/StudyProgram/Index', [
            'studyPrograms' => $studyPrograms,
        ]);
    }

    public function store(Request $request)
    {
        abort_if(! userCan('academic.management'), 403);

        $request->validate([
            'name' => 'required|max:191|unique:study_programs,name,'
        ]);

        StudyProgram::create([
            'name' => $request->name,
        ]);

        $this->flashSuccess('Study program created successfully');

        return back();
    }

    public function update(Request $request, StudyProgram $studyProgram)
    {
        abort_if(! userCan('academic.management'), 403);

        $request->validate([ // validate
            'name' => 'required|max:191|unique:study_programs,name,'.$studyProgram->id,
        ]);

        $studyProgram->update([ // data update
            'name' => $request->name,
        ]);

        $this->flashSuccess('Study Program update successfully.'); // return response

        return back();
    }

    public function destroy(StudyProgram $studyProgram)
    {
        abort_if(! userCan('academic.management'), 403);

        if ($studyProgram->teachers && $studyProgram->teachers->count()) {
            $this->flashWarning('You cannot delete this Study Program because it is already associated with teachers.');

            return back();
        }

        $studyProgram->delete(); // data delete

        $this->flashSuccess('Study Program deleted successfully.'); // return response

        return back();
    }
}
