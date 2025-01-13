<?php

namespace App\Http\Controllers\User;

use App\Actions\File\FileDelete;
use App\Exports\StudentExport;
use App\Exports\TeacherClassExport;
use App\Exports\TeacherExport;
use App\Exports\TeacherRateExport;
use App\Exports\StudentAttendanceExport;
use App\Exports\StudentLeaveExport;
use App\Exports\TeacherLateExport;
use App\Exports\AllTeacherExport;
use App\Exports\AllUserExport;
use App\Exports\StudentAbsentExport;
use App\Exports\TeacherAbsentExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UserRequest;
use App\Models\Course;
use App\Models\Department;
use App\Models\Notice;
use App\Models\Plan;
use App\Models\StudentAttendance;
use App\Models\User;
use App\Models\UserCourse;
use App\Models\UserDocument;
use App\Services\Admin\User\StudentDetailsService;
use App\Services\Admin\User\UserService;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Maatwebsite\Excel\Facades\Excel;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, UserService $userService)
    {
        abort_if(! userCan('users.index'), 403);

        $data = $userService->index($request);

        return Inertia::render('Admin/User/Index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_if(! userCan('users.create'), 403);

        return inertia('Admin/User/Create', [
            'roles' => Role::whereNotIn('name', ['Teacher', 'Student'])->latest()->get(['id', 'name']),
            'parents' => User::latest()->parent()->get(['id', 'name']),
            'plans' => Plan::latest()->get(['id', 'title']),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request, UserService $userService)
    {
        abort_if(! userCan('users.create'), 403);

        $userService->store($request);

        $this->flashSuccess($request->user_type . ' created successfully.');

        if ($request->has('admission')) {
            return redirect()->route('student.admission.all');
        }
        if ($request->user_type == 'Teacher') {
            return redirect()->route('teachers.index');
        }

        return redirect()->route('users.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        abort_if(! userCan('users.show'), 403);

        return view('admin.user.create');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        abort_if(! userCan('users.edit'), 403);

        $user->load('profile');

        return inertia('Admin/User/Edit', [
            'roles' => Role::whereNotIn('name', ['Teacher', 'Student'])->latest()->get(['id', 'name']),
            'departments' => Department::latest()->get(['id', 'name']),
            'parents' => User::latest()->parent()->get(['id', 'name']),
            'classes' => Course::latest()->get(['id', 'name']),
            'user' => $user,
            'plans' => Plan::latest()->get(['id', 'title']),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, User $user, UserService $userService)
    {
        abort_if(! userCan('users.edit'), 403);

        $userService->update($request, $user);

        $this->flashSuccess($request->user_type . ' updated successfully.'); // return response

        if ($request->has('admission')) {
            return redirect()->route('student.admission.all');
        }
        if ($request->user_type == 'Teacher') {
            return redirect()->route('teachers.index');
        }

        return redirect()->route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        abort_if(! userCan('users.destroy'), 403);

        if ($user->role == 'Parent') {
            $has_child = $user->childrens->count();
            if ($has_child > 0) {
                $this->flashWarning('This parent have child . Please removed child first');

                return redirect()->back();
            }
        }

        FileDelete::deleteImage($user->profile_photo_path);
        $profile = $user->profile;
        $parents = $user->parents()->detach();
        $user_notices = Notice::where('user_id', $user->id)->get();

        if ($profile) {
            $profile->delete();
        }

        if ($parents) {
            $user->parents()->detach();
        }

        if ($user_notices) {
            Notice::where('user_id', $user->id)->delete();
        }

        $user->delete();

        $this->flashSuccess('User deleted successfully.'); // return response

        return back();
    }

    public function studentShow(Request $request, User $student)
    {
        abort_if(! userCan('users.show') || authUser()->role == 'Student', 403);

        $data = (new StudentDetailsService)->execute($request, $student);

        return inertia('Admin/User/StudentDetails', $data);
    }

    public function studentPromotion()
    {
        abort_if(! userCan('student.promotion'), 403);

        $students = User::active()->student()->with('profile')->latest()->get();
        $classes = Course::latest()->get();

        return inertia('Admin/Promotion/Index', [
            'students' => $students,
            'classes' => $classes,
        ]);
    }

    public function studentPromotionUpdate(Request $request)
    {
        abort_if(! userCan('student.promotion'), 403);

        try {
            foreach ($request->data as $data) {
                $user_id = $data['user_id'];
                $from_course_id = $data['from_course_id'];
                $to_course_id = $data['to_course_id'];
                $is_passed = $data['is_passed'];
                $next_course_status = $data['next_course_status'];
                $from_course = UserCourse::where('course_id', $from_course_id)->where('user_id', $user_id)->first();
                $to_course = UserCourse::where('course_id', $to_course_id)->where('user_id', $user_id)->first();

                if ($from_course && $is_passed && ! $from_course->is_passed) {
                    $from_course->update(['is_passed' => 1]);
                }

                if ($from_course && ! $is_passed && $from_course->is_passed) {
                    $from_course->update(['is_passed' => 0]);
                }

                if (! $to_course) {
                    $to_course = UserCourse::create([
                        'user_id' => $user_id,
                        'course_id' => $to_course_id,
                    ]);
                }

                if (! $next_course_status) {
                    $from_course->delete();
                }
            }
        } catch (\Throwable $th) {
            $this->flashError('Something went wrong:' . $th->getMessage());

            return back();
        }

        $this->flashSuccess('Student promotion data updated successfully.');

        return back();
    }

    /**
     * Parent Show Page
     *
     * @param  Request  $user
     */
    public function parentShow(User $user)
    {
        $childrens = $user->childrens;

        return inertia('Admin/User/ParentDetails', compact('user', 'childrens'));
    }

    /**
     * Parent Create By Axios For Admission Page
     *
     * @param  Request  $request
     */
    public function parentStore(UserRequest $request)
    {
        $user = User::create([ // main user create
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->user_type,
            'password' => bcrypt($request->password),
        ]);

        return response()->json(['success' => true, 'data' => $user]);
    }

    /**
     * Student Export Page
     *
     * @return Response
     */
    public function studentExport(Request $request)
    {
        return Excel::download(new StudentExport($request->course), 'students.xlsx');
    }

    /**
     * Teacher Export Page
     *
     * @return Response
     */
    public function teacherExport(Request $request)
    {
        $name = $request->name;
        $month = $request->month;

        $course = $request->course;
        $study_program = $request->study_program;

        $export = new TeacherExport($name, $month, $course, $study_program);

        return Excel::download($export, 'teachers.xlsx');
        // if ($name && $month) {
        //     // Filter berdasarkan nama dan bulan
        //     return Excel::download(new TeacherExport($name, $month), 'teachers.xlsx');
        // } elseif ($name) {
        //     // Filter berdasarkan nama
        //     return Excel::download(new TeacherExport($name), 'teachers.xlsx');
        // } elseif ($month) {
        //     // Filter berdasarkan bulan
        //     return Excel::download(new TeacherExport(null, $month), 'teachers.xlsx');
        // } else {
        //     // Tanpa filter (semua data)
        //     return Excel::download(new TeacherExport(), 'teachers.xlsx');
        // }
    }

    public function teacherAbsentExport(Request $request)
    {
        $name = $request->name;
        $month = $request->month;

        $course = $request->course;
        $study_program = $request->study_program;

        $export = new TeacherAbsentExport($name, $month, $course, $study_program);

        return Excel::download($export, 'teachers.xlsx');
    }

    public function teacherClassExport(Request $request)
    {
        $name = $request->name;
        $month = $request->month;

        // Lakukan filter dan sesuaikan sesuai dengan nilai yang diberikan
        $export = new TeacherClassExport($name, $month);

        // Download file Excel sesuai dengan filter
        return Excel::download($export, 'teachers.xlsx');
    }

    public function teacherRateExport(Request $request)
    {
        $name = $request->name;
        $month = $request->month;

        // Lakukan filter dan sesuaikan sesuai dengan nilai yang diberikan
        $export = new TeacherRateExport($name, $month);

        // Download file Excel sesuai dengan filter
        return Excel::download($export, 'teachers.xlsx');
    }

    public function teacherLateExport(Request $request)
    {
        $name = $request->name;
        $month = $request->month;

        // Lakukan filter dan sesuaikan sesuai dengan nilai yang diberikan
        $export = new TeacherLateExport($name, $month);

        // Download file Excel sesuai dengan filter
        return Excel::download($export, 'teachers.xlsx');
    }

    public function AllUserExport(Request $request)
    {
        $query = $request->query;

        if ($query == 'All') {
            $query = '';
        }

        // Lakukan filter dan sesuaikan sesuai dengan nilai yang diberikan
        $export = new AllUserExport($query);

        // Download file Excel sesuai dengan filter
        return Excel::download($export, 'students.xlsx');
    }

    public function AllTeacherExport(Request $request)
    {
        $departement = $request->departement;

        // Lakukan filter dan sesuaikan sesuai dengan nilai yang diberikan
        $export = new AllTeacherExport($departement);

        // Download file Excel sesuai dengan filter
        return Excel::download($export, 'students.xlsx');
    }

    public function StudentAttendanceExport(Request $request)
    {
        $name = $request->name;
        $month = $request->month;

        // Filter tambahan
        $course = $request->course;
        $study_program = $request->study_program;

        // Lakukan filter dan sesuaikan sesuai dengan nilai yang diberikan
        $export = new StudentAttendanceExport($name, $month, $course, $study_program);

        // Download file Excel sesuai dengan filter
        return Excel::download($export, 'students.xlsx');
    }

    public function StudentAbsentExport(Request $request)
    {
        $name = $request->name;
        $month = $request->month;

        // Filter tambahan
        $course = $request->course;
        $study_program = $request->study_program;

        // Lakukan filter dan sesuaikan sesuai dengan nilai yang diberikan
        $export = new StudentAbsentExport($name, $month, $course, $study_program);

        // Download file excel sesuai dengan filter
        return Excel::download($export, 'students.xlsx');
    }

    public function exportStudentLeave(Request $request)
    {
        $name = $request->name;
        $month = $request->month;
        $courseId = $request->course_id;


        // Lakukan filter dan sesuaikan sesuai dengan nilai yang diberikan
        $export = new StudentLeaveExport($name, $month, $courseId);

        // Download file Excel sesuai dengan filter
        return Excel::download($export, 'students-leave.xlsx');
    }


    /**
     * Parent get By Axios For Admission Page
     *
     * @return Response
     */
    public function parentGet()
    {
        $parents = User::latest()->parent()->get(['id', 'name']);

        return response()->json(['success' => true, 'data' => $parents]);
    }

    /**
     * User Status Update For Active OR Ban
     *
     * @return Response
     */
    public function apiStatusUpdate(Request $request, User $user)
    {
        $user->update([
            'status' => $request->status ? true : false,
        ]);

        $this->flashSuccess('User Status Updated');

        return redirect()->back();
    }

    /**
     * User Account Hold Process
     *
     * @return Response
     */
    public function apiAccountHold(Request $request, User $user)
    {
        $user->update([
            'account_hold' => $request->status ? true : false,
        ]);

        // dd($request, $user);

        $this->flashSuccess('User Account Hold Date Updated');

        return redirect()->back();
    }

    public function apiAccountManual(Request $request, User $user)
    {
        $user->update([
            'manual' => $request->status ? true : false,
        ]);

        // dd($request->status);

        $this->flashSuccess('User Maanual Attendance Date Updated');

        return redirect()->back();
    }

    /**
     * User Status Update For Active OR Ban
     *
     * @param  Request  $request
     * @param  User  $user
     * @return Response
     */
    public function docDestroy(UserDocument $doc)
    {
        FileDelete::deleteImage($doc->file_url);
        $doc->delete();

        $this->flashSuccess('User document deleted');

        return back();
    }

    public function getUsersByRole(Request $request)
    {
        $role = $request->query('role');

        // Ensure role is valid
        if (!in_array($role, ['Teacher', 'Student', 'Accountant'])) {
            return response()->json([], 400);
        }

        $users = User::where('role', $role)->get(['id', 'name']);

        return response()->json($users);
    }
}
