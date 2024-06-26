<?php

namespace App\Http\Controllers\User;

use App\Actions\File\FileDelete;
use App\Http\Controllers\Controller;
use App\Imports\UsersImport;
use App\Mail\AccountCreated;
use App\Mail\AdmissionRequestAccept;
use App\Mail\AdmissionRequestReject;
use App\Models\AdmissionRequest;
use App\Models\Course;
use App\Models\Currency;
use App\Models\Department;
use App\Models\Plan;
use App\Models\User;
use App\Notifications\StudentAdmissionNotification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        abort_if(! userCan('admission.index'), 403);

        // Admission
        $admission_query = AdmissionRequest::query();

        // filter => keyword
        if ($request->has('keyword') && $request->keyword !== null) {
            $admission_query->where('name', $request->keyword)
                ->orWhere('email', $request->keyword);
        }
        // filter => class
        if ($request->has('course') && $request->course !== null) {
            $admission_query->whereHas('class', function ($q) use ($request) {
                $q->where('slug', $request->course);
            });
        }

        $admission_requests = $admission_query->with('class:id,name', 'department:id,name')
            ->where('isAccept', '!=', 1)
            ->latest()
            ->get()
            ->map(function ($admission) {
                $admission->parent = User::where('email', $admission->parent_email)->value('name');

                return $admission;
            });

        $classes = Course::get(['id', 'name', 'slug']);
        $departments = Department::get(['id', 'name', 'slug']);

        return inertia('Admin/Admission/Index', [
            'admission_requests' => $admission_requests,
            'filter_data' => $request,
            'classes' => $classes,
            'departments' => $departments,
            'admission_requests' => $admission_requests,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_if(! userCan('admission.create'), 403);

        return inertia('Admin/Admission/Form', [
            'parents' => User::latest()->active()->parent()->get(),
            'courses' => Course::latest()->with(['plans.benefits', 'subjects'])->get(['id', 'name']),
            'app_currency' => Currency::where('code', setting('app_currency'))->first(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $admission)
    {
        abort_if(! userCan('admission.edit'), 403);

        $admission->load('profile', 'documents');

        $user_courses = $admission->courses()->get()->map(function ($c) {
            return $c->course_id;
        });

        $admission_parent_ids = $admission->parents()->get()->map(function ($q) {
            return $q->id;
        })->toArray();
        $admission_parents = array_unique($admission_parent_ids);

        return inertia('Admin/Admission/Form', [
            'admission' => $admission,
            'departments' => Department::latest()->get(['id', 'name']),
            'parents' => User::active()->latest()->parent()->get(),
            'admission_parents' => $admission_parents,
            'courses' => Course::latest()->with(['plans', 'subjects'])->get(['id', 'name']),
            'app_currency' => Currency::where('code', setting('app_currency'))->first(),
            'user_courses' => $user_courses,
        ]);
    }

    /**
     * Student send mail for there account information.
     *
     * @param  Request  form data
     * @return \Illuminate\Http\Response
     */
    public function sendMail(Request $request)
    {

        $user = User::FindOrFail($request->user);

        Notification::send($user, new StudentAdmissionNotification($user));

        $this->flashSuccess('Mail successfully sent');

        return back();
    }

    /**
     * Bulk Admission page.
     *
     *
     * @return \Illuminate\Http\Response
     */
    public function bulkAdmission()
    {
        return inertia('Admin/Admission/BulkAdmission', [
            'departments' => Department::latest()->get(['id', 'name']),
            'parents' => User::latest()->parent()->active()->get(['id', 'name']),
            'classes' => Course::latest()->get(['id', 'name']),
            'plans' => Plan::latest()->get(['id', 'title']),
        ]);
    }

    /**
     * File Bulk Admission.
     *
     * @param  Request  form data
     * @return \Illuminate\Http\Response
     */
    public function fromFileBulk(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:csv,xlsx,xls',
        ]);

        try {
            Excel::import(new UsersImport, $request->file);

            $this->flashSuccess('Students admission successfull');

            return redirect()->route('student.admission.all');
        } catch (\Throwable $th) {

            session()->flash('warning', 'Your file structure is not correct.');

            return back();
        }
    }

    /**
     * Admission request page
     *
     * @param  Request  form data
     * @return \Illuminate\Http\Response
     */
    public function admissionAll(Request $request)
    {
        abort_if(! userCan('admission.index'), 403);

        $query = User::active()->student()->latest()->with(['profile', 'courses.course:id,name', 'parents']);

        // filter => keyword
        if ($request->has('keyword') && $request->keyword !== null) {
            $query->where(function($query) use ($request) {
                $query->where('name', 'like', '%'.$request->keyword.'%')
                      ->orWhere('email', 'like', '%'.$request->keyword.'%');
            });
        }
        // filter => class
        if ($request->has('course') && $request->course !== null) {
            $query->whereHas('courses', function ($q) use ($request) {
                $q->whereHas('course', function ($q) use ($request) {
                    $q->where('slug', $request->course);
                });
            });
        }

        $users = $query->paginate(15)->onEachSide(-1)->withQueryString();
        $classes = Course::get(['id', 'name', 'slug']);

        return inertia('Admin/Admission/AllStudent', [
            'users' => $users,
            'filter_data' => $request,
            'classes' => $classes,
        ]);
    }

    /**
     * Show specific admission request
     *
     * @param  Request  $admission_request
     * @return \Illuminate\Http\Response
     */
    public function show(AdmissionRequest $admission)
    {

        $documents = [];
        if (json_decode($admission->documents)) {
            foreach (json_decode($admission->documents) as $key => $value) {
                $doc = [
                    'title' => $value->title,
                    'url' => asset($value->url),
                ];

                array_push($documents, $doc);
            }
        }

        $courses = [];
        if ($admission->courses) {
            $courses = Course::whereIn('id', json_decode($admission->courses))->get();
        }

        return inertia('Admin/Admission/Show', compact('documents', 'courses', 'admission'));
    }

    /**
     * Admission request rejection and deletion
     *
     * @param  Request  $request
     * @return \Illuminate\Http\Response
     */
    public function admissionReject(AdmissionRequest $admission_request)
    {
        abort_if(! userCan('admission.index'), 403);

        // Sending reject mail
        if (checkMailConfig()) {
            if ($admission_request->email) {
                Mail::to($admission_request->email)->send(new AdmissionRequestReject);
            }
        }

        $docs = $admission_request->documents;
        if ($docs) {
            foreach (json_decode($docs) as $doc) {
                FileDelete::deleteImage($doc->url);
            }
        }

        FileDelete::deleteImageStorage($admission_request->profile_photo);
        FileDelete::deleteImageStorage($admission_request->guardian_photo);

        $admission_request->delete();

        $this->flashSuccess('Admission request rejected');

        return back();
    }

    /**
     * Admission request accept
     *
     * @param  Request  form data
     * @return \Illuminate\Http\Response
     */
    public function admissionAccept(AdmissionRequest $admission_request)
    {
        abort_if(! userCan('admission.index'), 403);

        $rand_password = Str::random(10);

        $user = User::create([ // main user create
            'name' => $admission_request->name,
            'email' => $admission_request->email,
            'role' => 'Student',
            'password' => bcrypt($rand_password),
            'profile_photo_path' => $admission_request->profile_photo,
            'phone' => $admission_request->phone,
            'address' => $admission_request->address ?? null,
            'date_of_birth' => $admission_request->date_of_birth,
            'gender' => $admission_request->gender,
        ]);

        $user->profile()->create([
            'roll_no' => Str::slug(Str::random(6).$user->id),
            'session' => $admission_request->session ?? Carbon::now()->format('Y').' - '.Carbon::now()->format('Y'),
            'student_id' => idGenerate(),
            // 'plan_id' => Plan::inRandomOrder()->value('id'),
        ]);

        $parent_id = $this->getParent($admission_request);
        $user->parents()->attach($parent_id);

        if ($admission_request->course_id) { //if request has class id
            $user->courses()->create([ //create user course
                'course_id' => $admission_request->course_id,
            ]);
        }

        // student course assign
        $courses = json_decode($admission_request->courses);
        if ($courses) {
            foreach ($courses as $key => $value) { //loop request courses
                $user->courses()->create([ //create user course
                    'course_id' => $value,
                ]);
            }
        }

        // student documents store
        $documents = json_decode($admission_request->documents);
        if ($documents) {
            foreach ($documents as $key => $value) {
                $user->documents()->create([
                    'file_url' => $value->url,
                    'title' => $value->title,
                ]);
            }
        }

        // student profile update
        $user->profile()->update([
            'roll_no' => Str::slug(Str::random(6).$user->id),
            'note' => $admission_request->note ?? '',
            'blood_group' => $admission_request->blood_group,
            'physical_disability' => $admission_request->physical_disability,
            'religion' => $admission_request->religion,
            'previous_school_name' => $admission_request->previous_school_name,
            'previous_school_year_of_exist' => $admission_request->previous_school_year_of_exist,
            'national_identification_number' => $admission_request->national_identification_number,
            'bank_name' => $admission_request->bank_name,
            'bank_account_number' => $admission_request->bank_account_number,
        ]);

        // change status for admission request
        $admission_request->update(['isAccept' => true]);

        // Sending login credentials
        if (checkMailConfig()) {
            Mail::to($user->email)->send(new AdmissionRequestAccept($user->email, $rand_password));
        }

        $this->flashSuccess('Student created successfully.');

        return redirect()->route('student.admission.edit', $user->id);
    }

    protected function getParent(object $admission)
    {
        $parent = User::where('email', $admission->guardian_email)->where('role', 'parent')->first();

        if (! $parent) {
            $password = Str::random(10);

            $parent = User::create([
                'name' => $admission->guardian_name,
                'email' => $admission->guardian_email,
                'password' => bcrypt($password),
                'profile_photo_path' => $admission->guardian_photo,
                'role' => 'Parent',
            ]);

            // Sending login credentials
            if (checkMailConfig()) {
                Mail::to($parent->email)->send(new AccountCreated($parent->email, $password));
            }
        }

        return $parent->id;
    }
}
