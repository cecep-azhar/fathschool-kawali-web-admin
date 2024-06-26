<?php

namespace App\Http\Controllers\Sms;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Sms\RequestSMS;
use App\Models\SmsTemplate;

class TemplateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_if(! userCan('sms'), 403);

        $templates = SmsTemplate::get(['title', 'message', 'id']);

        return inertia('Admin/Sms/Template', compact('templates'));
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RequestSMS $request)
    {
        abort_if(! userCan('sms'), 403);

        SmsTemplate::create([
            'title' => $request->title,
            'message' => $request->message,
        ]);

        $this->flashSuccess('Template created');

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RequestSMS $request, SmsTemplate $template)
    {
        abort_if(! userCan('sms'), 403);

        $template->update([
            'title' => $request->title,
            'message' => $request->message,
        ]);

        $this->flashSuccess('Template Updated Successfully');

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(SmsTemplate $template)
    {
        abort_if(! userCan('sms'), 403);

        $template->delete();

        $this->flashSuccess('Template Deleted Successfully');

        return back();
    }
}
