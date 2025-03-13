<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Department;
use App\Models\TeacherSubject;
use App\Models\User;
use App\Notifications\TeacherInfoNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Str;

class TeacherController extends Controller
{
    public function index(Request $request)
    {
        abort_if(! userCan('teacher.list'), 403);
        $query = User::active()->teacher()->latest()->with('department')->withCount('subjects');

        // filter => keyword
        if ($request->has('keyword') && $request->keyword !== null) {
            $query->where('name', $request->keyword);
            // ->orWhere('email', $request->keyword);
        }
        // filter => department
        if ($request->has('department') && $request->department !== null) {
            $query->whereHas('department', function ($q) use ($request) {
                $q->where('slug', $request->department);
            });
        }

        $users = $query->latest()->paginate(15)->onEachSide(-1);

        $departments = Department::get(['id', 'name', 'slug']);

        return inertia('Admin/Teacher/Index', [
            'users' => $users,
            'filter_data' => $request,
            'departments' => $departments,
        ]);
    }

    /**
     * Teacher Create
     *
     * @return Response
     */
    public function create()
    {
        abort_if(! userCan('teacher.list'), 403);

        $path = base_path('public/json/nationalities.json');
        $nationalities = json_decode(file_get_contents($path), true);
        $departments = Department::latest()->get();

        return inertia('Admin/Teacher/Form', [
            'courses' => Course::with('subjects')->get(['id', 'name', 'slug']),
            'nationalities' => $nationalities,
            'departments' => $departments,
        ]);
    }

    /**
     * Teacher Edit
     *
     * @return Response
     */
    public function edit(User $teacher)
    {
        abort_if(! userCan('teacher.list'), 403);

        $path = base_path('public/json/nationalities.json');
        $nationalities = json_decode(file_get_contents($path), true);
        $departments = Department::latest()->get();

        $teacher->load('subjects', 'profile', 'documents');

        $subjects = $teacher->subjects->map(function ($q) {
            return $q->subject_id;
        });

        return inertia('Admin/Teacher/Form', [
            'courses' => Course::with('subjects')->get(['id', 'name', 'slug']),
            'nationalities' => $nationalities,
            'teacher' => $teacher,
            'subjects' => $subjects,
            'departments' => $departments,
        ]);
    }

    public function show(Request $request, User $teacher)
    {
        abort_if(! userCan('users.show'), 403);

        $teacher->load('department');
        $leaves = $teacher->leaves()->latest()->paginate(15)->onEachSide(-1)->withQueryString();

        $query = $teacher->assignments()->with('subject', 'teacher', 'class:id,name');
        $assignments = $query
            ->latest('end_date')
            ->paginate(15)->onEachSide(-1)->withQueryString();
        // This will replace data property of the pagination
        $assignments->setCollection($assignments->groupBy('assignment_status'));
        $assignments->append(['submissions', 'students', 'total_mark', 'assignment_status']);

        $subjects = $teacher->subjects()->with(['subject.course'])->latest()->get()->transform(function ($data) {
            $data->total_students = $data->subject->course->students->count();

            return $data;
        });
        $subjects = $subjects->groupBy('subject.course_id');
        $subjects->each(function ($subject) {
            $subject->load(['subject.course.students' => function ($q) {
                return $q->limit(7);
            }]);
        });

        $online_classes_query = $teacher->online_classes()->with(['course:id,name', 'subject:id,name', 'teacher:id,name']);
        $online_classes = $online_classes_query->latest('start_time')->paginate(15)->onEachSide(-1)->withQueryString();
        // This will replace data property of the pagination
        $online_classes->setCollection($online_classes->groupBy('online_class_status'));
        $online_classes->append(['online_class_status']);

        $documents = $teacher->documents()->latest()->paginate(20)->onEachSide(0)->withQueryString();

        return inertia('Admin/Teacher/Show', [
            'teacher' => $teacher,
            'leaves' => $leaves,
            'assignments' => $assignments,
            'subjects' => $subjects,
            'documents' => $documents,
            'request_data' => $request,
            'online_classes' => $online_classes,
        ]);
    }

    public function classes(User $teacher)
    {
        abort_if(! userCan('teacher.list'), 403);

        $teacher->load('subjects.subject.course', 'department', 'profile', 'documents');
        $courses = Course::with('subjects')->get();

        return inertia()->render('Admin/Teacher/Class/Index', [
            'teacher' => $teacher,
            'courses' => $courses,
        ]);
    }

    public function classAssign(Request $request)
    {
        abort_if(! userCan('teacher.list'), 403);

        if ($request->destroy != true) {
            $request->validate([
                'subjects' => 'required',
            ]);
        }

        if ($request->destroy == true) {

            $class = TeacherSubject::FindOrFail($request->class);
            $class->delete();

            $this->flashSuccess('Assigned remove success.');
        } else {

            $teacher = User::FindOrFail($request->teacher);

            foreach ($request->subjects as $subject) {
                $exit = TeacherSubject::where('teacher_id', $teacher->id)->where('subject_id', $subject)->first();
                if (! $exit) {
                    $teacher->subjects()->create([
                        'subject_id' => $subject,
                    ]);
                }
            }

            $this->flashSuccess('Assign success.');
        }

        return back();
    }

    public function sendMail(Request $request)
    {
        $user = User::FindOrFail($request->user);

        $token = Str::random(60);
        DB::table('password_resets')->insert([
            'email' => $user->email,
            'token' => bcrypt($token),
            'created_at' => now(),
        ]);

        Notification::send($user, new TeacherInfoNotification($user, $token));

        $this->flashSuccess('Mail successfully sent');

        return back();
    }
}
