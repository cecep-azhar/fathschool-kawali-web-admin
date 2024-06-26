<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\AdmissionFormField;
use App\Models\Course;
use Illuminate\Http\Request;

class AdmissionFormController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_if(! userCan('admission.form'), 403);
        $fields = AdmissionFormField::orderBy('order', 'ASC')->get();
        $active_fields = AdmissionFormField::active()->orderBy('order', 'ASC')->get();
        $courses = Course::select('id', 'name')->get();

        return inertia('Admin/AdmissionForm/Index', compact(
            'fields',
            'active_fields',
            'courses'
        ));
    }

    /**
     * Status change the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function statusChange(Request $request, $id)
    {
        abort_if(! userCan('admission.form'), 403);
        $field = AdmissionFormField::FindOrFail($id);
        $field->update([
            'status' => $request->value ? true : false,
        ]);

        $this->flashSuccess('Field Status successfully Change.');

        return back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        abort_if(! userCan('admission.form'), 403);

        $new_index = $request->index;
        $old_index = $request->old_index;

        $old_field_item = AdmissionFormField::where('order', $new_index)->first();
        $old_field_item->update([
            'order' => $old_index,
        ]);

        $new_field_item = AdmissionFormField::FindOrFail($id);
        $new_field_item->update([
            'order' => $new_index,
        ]);

        $this->flashSuccess('Field Sorted successfully.');

        return back();
    }
}
