<?php

namespace App\Http\Controllers\Academic;

use App\Http\Controllers\Controller;
use App\Http\Requests\Teacher\Assignment\AssignmentCreateRequest;
use App\Http\Requests\Teacher\Assignment\AssignmentUpdateRequest;
use App\Models\Assignment;
use App\Models\SubmittedAssignment;
use App\Models\User;
use App\Notifications\RemindAssignmentSubmitNotification;
use App\Services\Teacher\Assignment\CreateAssignmentService;
use App\Services\Teacher\Assignment\FetchAssignmentService;
use App\Services\Teacher\Assignment\UpdateAssignmentService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class AssignmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        abort_if(!userCan('assignment.index', 'academic.management'), 403);

        $user = authUser();
        if ($user->role == 'Student') {
            abort(403);
        }

        $data = (new FetchAssignmentService)->fetch($request);

        return inertia('Teacher/Assignment/Index', $data);
    }

    public function create()
    {
        return redirect()->route('assignment.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(AssignmentCreateRequest $request)
    {
        abort_if(!userCan('assignment.create', 'academic.management'), 403);

        (new CreateAssignmentService)->create($request);

        $this->flashSuccess('Assignment created successfully.'); // return response

        return back();
    }

    public function remindThem(Request $request)
    {
        $students = User::whereIn('id', $request->data)->get();
        $assignment = Assignment::FindOrFail($request->assignment);

        if (checkMailConfig()) {
            foreach ($students as $key => $value) {
                Notification::send($value, new RemindAssignmentSubmitNotification($value, $assignment));
            }
            session()->flash('success', 'Mail Sent !');
        }

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  object  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Assignment $assignment)
    {
        abort_if(!userCan('assignment.show', 'academic.management'), 403);

        // check view permission
        if ($assignment->user_id != auth()->id()) {
            abort(403);
        }
        // check view permission end

        $assignment->load('teacher', 'class', 'subject');

        $students = $assignment->class->students->count();
        $submissions = SubmittedAssignment::where('assignment_id', $assignment->id)->count();

        $all_student_ids = $assignment->class->students->map(function ($q) {
            return $q->user_id;
        });

        $submitted_student_ids = SubmittedAssignment::where('assignment_id', $assignment->id)->get()->map(function ($q) {
            return $q->student_id;
        });

        $submissions_list = SubmittedAssignment::where('assignment_id', $assignment->id)
            ->with(['student.profile'])
            ->paginate(15)->onEachSide(-1);

        $all_student_query = User::query()->with('profile')->whereIn('id', $all_student_ids);
        $all_student_query->whereNotIn('id', $submitted_student_ids);
        $remaining_students = $all_student_query->paginate(20);
        $all_student_query_ids = User::query()->with('profile')->whereIn('id', $all_student_ids);
        $all_student_query_ids->whereNotIn('id', $submitted_student_ids);
        $remaining_student_ids = $all_student_query->get()->map(function ($q) {
            return $q->id;
        });
        $all_students = User::query()
            ->with('profile')->whereIn('id', $all_student_ids)->get()->map(function ($q) use ($assignment) {
                $q->assignment = $this->fromSubmittedAssignmentGetSP($assignment->id, $q->id);

                return $q;
            });

        return inertia('Teacher/Assignment/Show', [
            'assignment' => $assignment,
            'students' => $students,
            'submissions' => $submissions,
            'remaining_students' => $remaining_students,
            'all_students' => $all_students,
            'submissions_list' => $submissions_list,
            'remaining_student_ids' => $remaining_student_ids,
        ]);
    }

    public function fromSubmittedAssignmentGetSP(string $assignment, string $student)
    {
        $assignments = SubmittedAssignment::where('assignment_id', $assignment)->where('student_id', $student)->first();

        return $assignments;
    }

    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\Response
     */

    public function edit()
    {
        return redirect()->route('assignment.index');
    }
    public function update(AssignmentUpdateRequest $request, Assignment $assignment)
    {
        abort_if(!userCan('assignment.edit', 'academic.management'), 403);

        (new UpdateAssignmentService)->update($request, $assignment);

        $this->flashSuccess('Assignment updated successfully.'); // return response

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Assignment $assignment)
    {
        abort_if(!userCan('assignment.destroy', 'academic.management'), 403);

        $assignment->delete();

        $this->flashSuccess('Assignment deleted successfully.'); // return response

        return back();
    }

    /**
     *  Student give marks there submitted assignment
     *
     * @return \Illuminate\Http\Response
     */
    public function giveAssignmentMark(Request $request)
    {
        abort_if(!userCan('assignment.edit', 'academic.management'), 403);

        $request->validate([
            'mark' => 'required|integer',
            'assignment' => 'required',
        ]);

        $student_assignment = SubmittedAssignment::FindOrFail($request->assignment);

        $student_assignment->update([
            'gained_mark' => $request->mark,
            'completed' => $request->completed ?? false,
        ]);

        $this->flashSuccess('Mark updated');

        return back();
    }
}
