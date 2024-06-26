<?php

namespace App\Http\Controllers;

use App\Actions\File\FileDelete;
use App\Actions\File\FileUpload;
use App\Models\Assignment;
use App\Models\Course;
use App\Models\Department;
use App\Models\Notice;
use App\Models\SubmittedAssignment;
use App\Models\User;
use App\Models\UserProfile;
use App\Rules\MatchOldPassword;
use App\Services\Accountant\AccountantDashboardService;
use App\Services\Admin\AdminDashboardService;
use App\Services\Parent\DashboardService;
use App\Services\Parent\ParentDashboardService;
use App\Services\Student\StudentDashboardService;
use App\Services\Teacher\TeacherDashboardService;
use Illuminate\Http\Request;

class AuthDashboardController extends Controller
{
    public function dashboard(Request $request)
    {
        if (userCan('admin.dashboard')) {
            if(auth()->user()->tour_completed == 0){
                return redirect()->route('settings.general');
            }else{
                $data = (new AdminDashboardService)->dashboard($request);

                return inertia('Admin/Dashboard', $data);
            }
        }

        // for accountant
        if (userCan('accountant.dashboard')) {
            $data = (new AccountantDashboardService)->dashboard($request);

            return inertia('Accountant/Dashboard', $data);
        }

        // for teacher dashboard
        if (userCan('teacher.dashboard')) {
            $data = (new TeacherDashboardService)->dashboard();

            return inertia('Teacher/Dashboard', $data);
        }

        // for parent
        if (userCan('parent.dashboard')) {
            $data = (new ParentDashboardService)->dashboard($request);

            return inertia('Parent/Dashboard', $data);
        }

        // for student
        if (userCan('student.dashboard')) {
            $data = (new StudentDashboardService)->dashboard($request);

            // return $data;
            return inertia('Student/Dashboard', $data);
        }

        // if all condition fails
        $data = (new AdminDashboardService)->dashboard($request);

        return inertia('Dashboard', $data);
    }

    public function noticeBoardDetails(Notice $notice)
    {
        $comments = $notice->comments()->with('user')->latest()->paginate(20)->onEachSide(-1);

        return Inertia('NoticeDetails', compact('notice', 'comments'));
    }

    public function profile()
    {
        return inertia('Profile/Profile', [
            'departments' => Department::latest()->get(['id', 'name']),
            'classes' => Course::latest()->get(['id', 'name']),
            'user' => authUser()->load('parents', 'profile'),
        ]);
    }

    public function assignmentDetails($assignment)
    {
        abort_if(! userCan('assignment.show'), 403);

        $assignment = Assignment::withCount(['submitted as submitted_done' => function ($q) {
            $q->where('student_id', auth()->id()); // check auth student assignment does submit
        }])
            ->withCasts(['submitted_done' => 'boolean'])
            ->where('slug', $assignment)
            ->firstOrFail();

        // check view permission
        // abort_if($assignment->user_id != auth()->id() || $assignment->teacher_id != auth()->id(), 403);

        // check view permission
        $user = authUser();
        $role = $user->role;
        // for student
        if ($role == 'Student') {
            $student_classes = $user->courses()->get()->map(function ($q) {
                return $q->course_id;
            })->toArray();

            if (! in_array($assignment->course_id, $student_classes)) {
                abort(403);
            }
        }

        // check view permission end
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

        return inertia('Teacher/Assignment/Show', [
            'assignment' => $assignment,
            'students' => $students,
            'submissions' => $submissions,
            'remaining_students' => $remaining_students,
            'submissions_list' => $submissions_list,
        ]);

        return inertia('Teacher/Assignment/Show');
    }

    public function profileUpdate(Request $request)
    {

        $user = User::FindOrFail(auth()->id());

        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'avatar' => 'sometimes|nullable|mimes:svg,jpeg,png,gif',
        ]);

        // if user is student
        if ($user->role == 'Student') {
            $request->validate([
                'roll_no' => 'required',
                'session' => 'required',
            ]);
        }
        // if user is teacher
        if ($user->role == 'Teacher') {
            $request->validate([
                'department' => 'required',
            ]);
        }

        // if user want to update there password
        if ($request->password_update) {
            $request->validate([
                'password' => 'required|min:6|confirmed',
                'current_password' => ['required', new MatchOldPassword],
            ]);
        }

        // user update
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password ? bcrypt($request->password) : $user->password,
            'phone' => $request->phone,
            'address' => $request->address,
            'department_id' => $request->department,
        ]);

        if ($user->role == 'Student') {  // if user is student

            $user->profile()->update([
                'roll_no' => $request->roll_no,
                'session' => $request->session,
                'blood_group' => $request->blood_group,
                'physical_disability' => $request->physical_disability,
                'religion' => $request->religion,
                'previous_school_name' => $request->previous_school_name,
                'previous_school_year_of_exist' => $request->previous_school_year_of_exist,
            ]);
        }

        // for avatar upload
        if ($request->hasFile('avatar')) {

            FileDelete::deleteImage($user->profile_photo_path);

            $url = FileUpload::uploadImage($request->avatar, 'profile-photos');
            $user->update([
                'profile_photo_path' => $url,
            ]);
        }

        $this->flashSuccess('Your profile successfully updated.');

        return back();
    }

    /**
     * User tour completed for first time visit
     */
    public function tourCompleted()
    {
        $user = auth()->user();
        $user->update([
            'tour_completed' => true,
        ]);

        return redirect()->route('dashboard');
    }

    /**
     * Kid dashboard visit with details
     *
     * @param roll no String
     * @return \Illuminate\Http\Response
     */
    public function kidDashboard(Request $request, $roll_no, DashboardService $dashboardService)
    {
        abort_if(! userCan('parent.dashboard'), 403);

        $child_profile = UserProfile::where('roll_no', $roll_no)->first();
        $child = $child_profile->user;
        session()->put('children_view', $child_profile->user_id);

        $data = $dashboardService->kidDashboard($request, $roll_no, $child, $child_profile);

        // return $data;
        return inertia('Parent/ChildDashboard', $data);
    }
}
