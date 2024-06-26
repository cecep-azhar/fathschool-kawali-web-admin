<?php

namespace App\Http\Controllers\Cms;

use App\Http\Controllers\Controller;
use App\Models\Onboarding;
use Illuminate\Http\Request;

class CmsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_if(! userCan('settings'), 403);

        $onboarding_contents = Onboarding::latest()->get(['id', 'menu_slug', 'title', 'description']);

        return inertia('Admin/Settings/Cms/Index', compact('onboarding_contents'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function onboardingUpdate(Request $request)
    {
        abort_if(! userCan('settings'), 403);

        $request->validate([
            'titles.*' => 'required',
            'descriptions.*' => 'required',
        ]);

        $titles = $request->titles;
        $descriptions = $request->descriptions;

        // first title update operation
        foreach ($titles as $key => $title) {

            $item = Onboarding::where('id', $key)->first();
            if ($item) {
                $item->update([
                    'title' => $title,
                ]);
            }
        }

        // second haf description update operation
        foreach ($descriptions as $key => $description) {

            $item = Onboarding::where('id', $key)->first();
            if ($item) {
                $item->update([
                    'description' => $description,
                ]);
            }
        }

        session()->flash('success', 'Onboarding content updated.');

        return redirect()->back();
    }
}
