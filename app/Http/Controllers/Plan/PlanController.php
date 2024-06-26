<?php

namespace App\Http\Controllers\Plan;

use App\Http\Controllers\Controller;
use App\Http\Requests\Accountant\PlanRequest;
use App\Models\Course;
use App\Models\Currency;
use App\Models\Plan;

class PlanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_if(! userCan('plan.index'), 403);

        $plans = Plan::latest()->with(['course:id,name', 'benefits'])->get();

        return inertia('Accountant/Plan/Index', [
            'plans' => $plans,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_if(! userCan('plan.create'), 403);

        $courses = Course::latest()->get();
        $currencies = Currency::active()->latest()->get();

        return inertia('Accountant/Plan/Form', compact('courses', 'currencies'));
    }

    /**
     * Show the form for editing a resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Plan $plan)
    {
        abort_if(! userCan('plan.edit'), 403);

        $courses = Course::latest()->get();
        $benefits = $plan->benefits()->get()->map(function ($q) {
            return $q->title;
        });
        $amounts = $plan->benefits()->get()->map(function ($q) {
            return $q->amount;
        });
        $courses = Course::latest()->get();
        $currencies = Currency::active()->latest()->get();

        return inertia('Accountant/Plan/Form', compact('courses', 'plan', 'benefits', 'amounts', 'currencies'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PlanRequest $request)
    {
        abort_if(! userCan('plan.create'), 403);

        $price = array_sum($request->amounts);
        $plan = Plan::create([
            'title' => $request->title,
            'price' => $price,
            'description' => $request->description,
            'course_id' => $request->course,
            'currency' => $request->currency,
        ]);

        if ($request->has('benefits')) {
            foreach ($request->benefits as $key => $value) {
                $plan->benefits()->create([
                    'title' => $value,
                    'amount' => $request->amounts[$key] ?? 0,
                ]);
            }
        }

        $this->flashSuccess('Plan Added Successful');

        return redirect()->route('plan.index');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PlanRequest $request, Plan $plan)
    {
        abort_if(! userCan('plan.edit'), 403);

        $price = array_sum($request->amounts);
        $plan->update([
            'title' => $request->title,
            'price' => $price,
            'description' => $request->description,
            'course_id' => $request->course,
            'currency' => $request->currency,
        ]);

        if ($request->has('benefits')) {
            $plan->benefits()->delete();
            foreach ($request->benefits as $key => $value) {
                $plan->benefits()->create([
                    'title' => $value,
                    'amount' => $request->amounts[$key] ?? 0,
                ]);
            }
        }

        $this->flashSuccess('Plan Updated Successful');

        return redirect()->route('plan.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Plan $plan)
    {
        if ($plan->courses && $plan->courses->count()) {
            $this->flashWarning('You cannot delete this plan because it is already associated with courses.');

            return back();
        }

        abort_if(! userCan('plan.destroy'), 403);

        $plan->delete();

        $this->flashSuccess('Plan Deleted Successful');

        return back();
    }
}
