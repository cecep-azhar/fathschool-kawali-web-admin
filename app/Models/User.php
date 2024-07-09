<?php

namespace App\Models;

use App\Models\Api\LearningLesson;
use App\Models\Api\StudentList;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, HasProfilePhoto, Notifiable, TwoFactorAuthenticatable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $guarded = [];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'role',
        'position',
        'department',
        'face_embedding',
        'image_url',
        'fcm_token',
        'id_reference'
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'date_of_birth' => 'date:Y-m-d',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
        'join_date',
    ];

    protected $dates = ['join_date', 'date_of_birth'];

    protected static function boot() // for role wise data create
    {
        parent::boot();

        // static::creating(function (User $user) {
        //     echo $user;
        // });

        static::created(function ($user) {

            $user_role = $user->role; // check user role -> get from user create time
            if ($user_role) {

                $role = Role::where('name', $user_role)->first();
                if ($role) {
                    $user->assignRole($role); //role assign
                }
            }
        });
    }

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = $value;
        $this->attributes['username'] = Str::slug($value).'_'.Str::random(5);
    }

    /**
     * Get the URL to the user's profile photo.
     *
     * @return string
     */
    public function getProfilePhotoUrlAttribute()
    {
        return $this->profile_photo_path
            ? asset($this->profile_photo_path)
            : $this->defaultProfilePhotoUrl();
    }

    // accessor |  user join date
    public function getJoinDateAttribute()
    {
        $date = $this->created_at;
        if ($date) {
            return date('d-m-Y', strtotime($date));
        }
    }

    public function getNextBirthRemainingDaysAttribute()
    {
        $date = $this->date_of_birth;

        if ($date) {
            $date->setYear(now()->year);

            if ($date->isPast()) {
                $date->addYear();
            }

            return Carbon::parse($date)->diffInDays();
        }
    }

    public function getNextBirthDateAttribute()
    {
        $date = $this->date_of_birth;

        if ($date) {
            $date->setYear(now()->year);

            if ($date->isPast()) {
                $date->addYear();
            }

            return Carbon::parse($date)->format('l d F, Y');
        }
    }

    // Scope |  user filter as parent
    public function scopeParent($query)
    {
        return $this->where('role', 'Parent');
    }

    // Scope |  user filter as admin
    public function scopeAdmin($query)
    {
        return $this->where('role', 'Admin');
    }

    // Scope |  user filter as student
    public function scopeStudent($query)
    {
        return $this->where('role', 'Student');
    }

    // Scope |  user filter as teacher
    public function scopeTeacher($query)
    {
        return $this->where('role', 'Teacher');
    }

    // Scope |  user filter as Accountant
    public function scopeAccountant($query)
    {
        return $this->where('role', 'Accountant');
    }

    // Scope |  user filter as active
    public function scopeActive($query)
    {
        return $this->where('status', true);
    }

    // Scope |  user filter as banned
    public function scopeBanned($query)
    {
        return $this->where('status', false);
    }

    // One to one relation with profile model
    public function profile()
    {
        return $this->hasOne(UserProfile::class, 'user_id', 'id')->with('class');
    }

    // One to one relation with department model
    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    // One to many relation with class model
    public function subjects()
    {
        return $this->hasMany(TeacherSubject::class, 'teacher_id');
    }

    // One to many relation with Assignment model
    public function assignments()
    {
        return $this->hasMany(Assignment::class, 'user_id');
    }

    // One to many relation with syllabus model
    public function syllabuses()
    {
        return $this->hasMany(Syllabus::class, 'user_id');
    }

    // One to many relation with leave model
    public function leaves()
    {
        return $this->hasMany(Leave::class, 'user_id');
    }

    // One to many relation with transaction model
    public function transactions()
    {
        return $this->hasMany(Transaction::class, 'user_id');
    }

    // One to many relation with invoice model
    // public function getParentInvoicesAttribute()
    // {
    //     $child_ids = $this->childrens()->get()->map(function ($q) {
    //         return $q->id;
    //     });
    //     $transactions = Transaction::whereIn('user_id', $child_ids)->get();
    //     return $transactions;
    // }

    // One to many relation with invoice model
    public function children()
    {
        return $this->hasOne(Invoice::class, 'user_id');
    }

    // One to many relation with attendance model
    public function attendances()
    {
        return $this->hasMany(StudentAttendance::class, 'student_id', 'id');
    }

    // One to many relation with schedule model
    public function schedules()
    {
        return $this->hasMany(Schedule::class, 'user_id', 'id');
    }

    // One to many relation with online class model
    public function online_classes()
    {
        return $this->hasMany(OnlineClass::class, 'teacher_id', 'id');
    }

    // One to many relation with Submitted Assignment model
    public function submitted_assignments()
    {
        return $this->hasMany(SubmittedAssignment::class, 'student_id', 'id');
    }

    /**
     * One to many relation with user documents model
     * to get all documents under a user
     */
    public function documents()
    {
        return $this->hasMany(UserDocument::class, 'user_id');
    }

    /**
     * One to many relation with User Course model
     * to get all Course under a user
     */
    public function courses()
    {
        return $this->hasMany(UserCourse::class, 'user_id');
    }

    public function course()
    {
        return $this->belongsToMany(Course::class, 'user_courses', 'user_id', 'course_id');
    }

    /**
     * One to many relation with user profile model
     * to get all child under a parent user
     */
    public function childrens()
    {
        return $this->belongsToMany(User::class, 'student_parents', 'parent_id', 'student_id');
    }

    /**
     * One to many relation with user profile model
     * to get all child under a parent user
     */
    public function parents()
    {
        return $this->belongsToMany(User::class, 'student_parents', 'student_id', 'parent_id')->withTimestamps();
    }

    public function groups()
    {
        return $this->hasMany(ChatGroupUser::class, 'user_id', 'id');
    }

    public function learningLessons()
    {
        return $this->hasMany(LearningLesson::class);
    }

    public function classRoutine()
    {
        return $this->hasMany(ClassRoutine::class);
    }

    public function coursesUser()
    {
        return $this->belongsToMany(Course::class, 'student_lists', 'student_id', 'course_id');
    }

    public function studentList()
    {
        return $this->hasOne(StudentList::class, 'student_id');
    }
}
