<?php

namespace App\Services\Admin\User;

use App\Actions\File\FileDelete;
use App\Actions\File\FileUpload;
use App\Models\Course;
use App\Models\Department;
use App\Models\Invoice;
use App\Models\User;
use App\Notifications\StudentAdmissionNotification;
use App\Notifications\UserAccountSetPasswordNotification;
use App\Services\Accountant\Invoice\DeleteInvoiceService;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class UserService
{
    public function index(object $request): array
    {
        $term = Str::ucfirst($request['query']);

        $data['users'] = User::with('roles', 'profile')->latest()->withCount('subjects')
            ->when($term && $term != null && $term != 'All' && $term == 'Other', function ($query) {
                $query->whereNotIn('role', ['Admin', 'Parent', 'Student', 'Teacher', 'Administration']);
            })
            ->when($term && $term != null && $term != 'All' && $term != 'Other', function ($query) use ($term) {
                $query->where('role', $term);
            })
            ->when($request->has('keyword') && $request->keyword != null, function ($query) use ($request) {
                $query->where(function ($q) use ($request) {
                    $q->where('name', 'Like', '%' . $request->keyword . '%')
                        ->orWhere('email', 'Like', '%' . $request->keyword . '%')
                        ->orWhere('role', 'Like', '%' . $request->keyword . '%');
                });
            })
            ->paginate(15)
            ->withQueryString()
            ->onEachSide(-1);

        $data['term'] = $term;
        $data['admins'] = User::admin()->count();
        $data['parents'] = User::latest()->parent()->count();
        $data['students'] = User::student()->count();
        $data['teachers'] = User::teacher()->count();
        $data['administrations'] = User::administration()->count();
        $data['query'] = $request;
        $data['others'] = User::whereNotIn('role', [
            'Admin',
            'Parent',
            'Student',
            'Teacher',
            'Administration',
        ])->count();


        return $data;
    }

    public function store(object $request): object
    {
        // Cek apakah ada pengguna lain dengan data yang sama
        $errors = [];

        if (!empty($request->nik)) { // Validasi hanya jika NIK tidak kosong
            if (User::where('nik', $request->nik)->exists()) {
                $errors['nik'] = 'NIK sudah digunakan oleh pengguna lain.';
            }
        }

        if (!empty($request->nisn)) { // Validasi hanya jika NISN tidak kosong
            if (User::where('nisn', $request->nisn)->exists()) {
                $errors['nisn'] = 'NISN sudah digunakan oleh pengguna lain.';
            }
        }

        if (!empty($request->rfid)) { // Validasi hanya jika NISN tidak kosong
            if (User::where('rfid', $request->rfid)->exists()) {
                $errors['rfid'] = 'RFID sudah digunakan oleh pengguna lain.';
            }
        }

        if (User::where('name', $request->name)->exists()) {
            $errors['name'] = 'Nama sudah digunakan oleh pengguna lain.';
        }

        if (User::where('email', $request->email)->exists()) {
            $errors['email'] = 'Email sudah digunakan oleh pengguna lain.';
        }

        if (!empty($request->phone)) { // Validasi hanya jika Phone tidak kosong
            if (User::where('phone', $request->phone)->exists()) {
                $errors['phone'] = 'Nomor telepon sudah digunakan oleh pengguna lain.';
            }
        }

        // Jika ada error, lemparkan validation exception
        if (!empty($errors)) {
            throw ValidationException::withMessages($errors);
        }
        // department manage
        if ($request->department) {
            $department_id = $this->departmentStore($request);
        }

        // avatar manage
        if ($request->hasFile('avatar')) {
            $url = FileUpload::uploadImage($request->avatar, 'profile-photos');
        }

        $password = $request->password ? bcrypt($request->password) : bcrypt(Str::random(8));
        $user = User::create([ // main user create
            'nik' => $request->nik ?: null,
            'nisn' => $request->nisn ?: null,
            'rfid' => $request->rfid ?: null,
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->user_type,
            'department_id' => $department_id ?? null,
            'password' => $password,
            'profile_photo_path' => $url ?? '',
            'phone' => $request->phone ?? '',
            'address' => $request->address ?? '',
            'date_of_birth' => Carbon::parse($request->date_of_birth) ?? null,
            'gender' => $request->gender ?? 'male',
        ]);

        if ($request->user_type == 'Student') {  // if user is student
            $this->studentProfile($user, $request);
        }

        if ($request->user_type == 'Teacher') {  // if user is Teacher
            $this->teacherProfile($user, $request);
        }

        $token = Str::random(60);
        DB::table('password_resets')->insert([
            'phone' => $user->phone,
            'token' => bcrypt($token),
            'created_at' => now(),
        ]);

        // send email for reset password
        if (checkMailConfig()) {
            if ($request->user_type == 'Student') {
                // get course name
                $courses_name = [];
                $student_courses = $user->courses;
                if ($student_courses) {
                    foreach ($student_courses as $key => $course) {
                        $student_course = Course::where('id', $course->course_id)->first();
                        if ($student_course) {
                            array_push($courses_name, $student_course->name);
                        }
                    }
                }
                // get course name end
                $parents = $user->parents;
                $parents_name = [];
                if ($parents) {
                    foreach ($parents as $key => $parent) {
                        $parent_user = User::where('id', $parent->id)->first();
                        if ($parent_user) {
                            array_push($parents_name, $parent_user->name);
                            $parent_user->notify((new StudentAdmissionNotification($user, $courses_name, $parents_name, true, $token)));
                        }
                    }
                }

                $user->notify((new StudentAdmissionNotification($user, $courses_name, $parents_name, false, $token)));
            } else {
                $user->notify((new UserAccountSetPasswordNotification($user, $token)));
            }
        }

        if ($request->hasFile('documents')) {
            (new StudentDocUploadService)->uploadDoc($request, $user);
        }

        return $user;
    }

    public function studentProfile(object $user, object $request)
    {
        $user->profile()->create([
            'roll_no' => Str::slug(Str::random(6) . $user->id),
            'session' => Carbon::now()->format('Y') - Carbon::now()->format('Y'),
            'note' => $request->note ?? '',
            'plan_id' => $request->plan,
            'student_id' => idGenerate(),
            'blood_group' => $request->blood_group,
            'physical_disability' => $request->physical_disability,
            'religion' => $request->religion,
            'previous_school_name' => $request->previous_school_name,
            'previous_school_year_of_exist' => $request->previous_school_year_of_exist,
        ]);

        // parents store
        if ($request->parents) { //if request has courses
            foreach ($request->parents as $key => $parent) { //loop request courses
                $user->parents()->attach($parent);
            }
        }

        if ($request->courses) { //if request has courses

            foreach ($request->courses as $key => $value) { //loop request courses
                $user->courses()->create([ //create user course
                    'course_id' => $value,
                ]);
            }
        }

        // create recurring invoice for every month invoice
        if ($request->plan) {
            (new StudentRecurringInvoiceService)->storeInvoice($user, $request->plan);
        }
    }

    public function teacherProfile(object $user, object $request)
    {
        foreach ($request->subjects as $key => $subject) {
            $user->subjects()->create([
                'subject_id' => $subject,
            ]);
        }

        $user->profile()->create([
            'highest_degree_name' => $request->highest_degree_name,
            'institute_name' => $request->institute_name,
            'passing_year' => $request->passing_year,
            'religion' => $request->religion,
            'nationality' => $request->nationality,
        ]);
    }

    public function update(object $request, object $user): void
    {
        // Cek apakah ada pengguna lain dengan data yang sama
        $errors = [];

        if (!empty($request->nik)) { // Cek hanya jika NISN tidak kosong
            if (User::where('nik', $request->nik)->where('id', '!=', $user->id)->exists()) {
                $errors['nik'] = 'NIK sudah digunakan oleh pengguna lain.';
            }
        }

        if (!empty($request->nisn)) { // Cek hanya jika NISN tidak kosong
            if (User::where('nisn', $request->nisn)->where('id', '!=', $user->id)->exists()) {
                $errors['nisn'] = 'NISN sudah digunakan oleh pengguna lain.';
            }
        }

        if (!empty($request->rfid)) { // Cek hanya jika RFID tidak kosong
            if (User::where('rfid', $request->rfid)->where('id', '!=', $user->id)->exists()) {
                $errors['rfid'] = 'RFID sudah digunakan oleh pengguna lain.';
            }
        }

        if (User::where('name', $request->name)->where('id', '!=', $user->id)->exists()) {
            $errors['name'] = 'Nama sudah digunakan oleh pengguna lain.';
        }

        if (User::where('email', $request->email)->where('id', '!=', $user->id)->exists()) {
            $errors['email'] = 'Email sudah digunakan oleh pengguna lain.';
        }

        if (!empty($request->phone)) { // Cek hanya jika Phone tidak kosong
            if (User::where('phone', $request->phone)->where('id', '!=', $user->id)->exists()) {
                $errors['phone'] = 'Nomor telepon sudah digunakan oleh pengguna lain.';
            }
        }

        // Jika ada error, lemparkan validation exception
        if (!empty($errors)) {
            throw ValidationException::withMessages($errors);
        }

        // department manage
        if ($request->department) {
            $department_id = $this->departmentStore($request);
        }

        $user->update([ // main user update
            'nik' => $request->nik ?: null,
            'nisn' => $request->nisn ?: null, // Simpan null jika kosong
            'rfid' => $request->rfid ?: null,
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->user_type,
            'department_id' => $department_id ?? $user->department_id,
            'password' => $request->password ? bcrypt($request->password) : $user->password,
            'phone' => $request->phone ?: null, // Simpan null jika kosong
            'address' => $request->address ?? '',
            'date_of_birth' => Carbon::parse($request->date_of_birth) ?? null,
            'gender' => $request->gender ?? 'male',
        ]);

        if ($request->user_type == 'Student') {  // if user is student

            $old_plan_id = $user->profile->plan_id ?? '';
            if ($request->plan && $request->plan != $old_plan_id) {

                $old_invoices = Invoice::where('user_id', $user->id)->where('recurring', true)->get(); // first invoice delete
                if ($old_invoices) {
                    foreach ($old_invoices as $key => $value_old) {
                        (new DeleteInvoiceService)->delete($value_old);
                    }
                }
                // create recurring invoice for every month invoice
                (new StudentRecurringInvoiceService)->storeInvoice($user, $request->plan);
            }

            $this->studentProfileUpdate($user, $request);

            if ($request->courses) { //if request has courses
                $user->courses()->delete();
                foreach ($request->courses as $key => $value) { //loop request courses
                    $user->courses()->create([ //create user course
                        'course_id' => $value,
                    ]);
                }
            }
        }

        if ($user->role == 'Teacher') {  // if user is Teacher
            $this->teacherProfileUpdate($user, $request);
        }

        if ($request->hasFile('documents')) {
            (new StudentDocUploadService)->uploadDoc($request, $user);
        }

        if ($request->hasFile('avatar')) {

            FileDelete::deleteImage($user->profile_photo_path);

            $url = FileUpload::uploadImage($request->avatar, 'profile-photos');
            $user->update([
                'profile_photo_path' => $url,
            ]);
        }
    }



    public function studentProfileUpdate(object $user, object $request)
    {
        $user->profile()->update([
            'roll_no' => Str::slug(Str::random(6) . $user->id),
            'session' => Carbon::now()->format('Y') - Carbon::now()->format('Y'),
            'note' => $request->note ?? '',
            'plan_id' => $request->plan,
            'blood_group' => $request->blood_group,
            'physical_disability' => $request->physical_disability,
            'religion' => $request->religion,
            'previous_school_name' => $request->previous_school_name,
            'previous_school_year_of_exist' => $request->previous_school_year_of_exist,
        ]);

        // parents store
        if ($request->parents) { //if request has courses
            $user->parents()->detach();
            foreach ($request->parents as $key => $parent) { //loop request courses
                $user->parents()->attach($parent);
            }
        }
    }

    public function teacherProfileUpdate(object $user, object $request)
    {
        if ($request->subjects) {
            $user->subjects()->delete();
            foreach ($request->subjects as $key => $subject) {
                $user->subjects()->create([
                    'subject_id' => $subject,
                ]);
            }
        }

        $user->profile()->update([
            'highest_degree_name' => $request->highest_degree_name,
            'institute_name' => $request->institute_name,
            'passing_year' => $request->passing_year,
            'religion' => $request->religion,
            'nationality' => $request->nationality,
        ]);
    }

    public function departmentStore(object $request): string
    {
        $department = Department::where('id', $request->department)->orWhere('name', $request->department)->first();

        if (! $department) {
            $new_department = Department::create(['name' => $request->department]);

            return $new_department->id;
        } else {
            return $department->id;
        }
    }
}
