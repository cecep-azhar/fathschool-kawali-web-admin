<?php

namespace App\Http\Controllers\Academic;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\StudyProgram;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_if(! userCan('academic.management'), 403);

        $departments = Department::latest()->paginate(15)->onEachSide(-1);

        $study_programs = StudyProgram::latest()->get();

        return inertia('Admin/Department/Index', [
            'departments' => $departments,
            'study_programs' => $study_programs,
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

        $request->validate([ // validate
            'name' => 'required|max:191|unique:departments,name',
        ]);

        Department::create([ // data store
            'name' => $request->name,
            'study_program_id' => $request->study_program_id,
        ]);

        $this->flashSuccess('Department created successfully.'); // return response

        return back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Department $department)
    {
        abort_if(! userCan('academic.management'), 403);

        $request->validate([ // validate
            'name' => 'required|max:191|unique:departments,name,'.$department->id,
        ]);

        $department->update([ // data update
            'name' => $request->name,
            'study_program_id' => $request->study_program_id,
        ]);

        $this->flashSuccess('Department update successfully.'); // return response

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Department $department)
    {
        abort_if(! userCan('academic.management'), 403);

        if ($department->teachers && $department->teachers->count()) {
            $this->flashWarning('You cannot delete this department because it is already associated with teachers.');

            return back();
        }

        $department->delete(); // data delete

        $this->flashSuccess('Department deleted successfully.'); // return response

        return back();
    }
}
