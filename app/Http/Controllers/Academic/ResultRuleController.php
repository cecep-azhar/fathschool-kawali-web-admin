<?php

namespace App\Http\Controllers\Academic;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Result\ResultRuleSaveRequest;
use App\Models\ResultRule;

class ResultRuleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_if(! userCan('academic.management'), 403);

        $rules = ResultRule::get();

        return inertia('Admin/ResultRule/Index', compact('rules'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(ResultRuleSaveRequest $request)
    {
        abort_if(! userCan('academic.management'), 403);
        ResultRule::create([
            'name' => $request->name,
            'gpa' => $request->gpa,
            'min_mark' => $request->min_mark,
            'max_mark' => $request->max_mark,
            'grade_remark' => $request->grade_remark,
        ]);

        $this->flashSuccess('Result Rule Created Successfully');

        return back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ResultRuleSaveRequest $request, ResultRule $rule)
    {
        abort_if(! userCan('academic.management'), 403);

        $rule->update([
            'name' => $request->name,
            'gpa' => $request->gpa,
            'min_mark' => $request->min_mark,
            'max_mark' => $request->max_mark,
            'grade_remark' => $request->grade_remark,
        ]);

        $this->flashSuccess('Result Rule Updated Successfully');

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(ResultRule $rule)
    {
        abort_if(! userCan('academic.management'), 403);

        $rule->delete();

        $this->flashSuccess('Result Rule Deleted Successfully');

        return back();
    }
}
