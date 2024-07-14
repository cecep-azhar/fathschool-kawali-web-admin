<?php

namespace App\Models;

use App\Models\Api\StudentList;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Ramsey\Uuid\Uuid;

class Course extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d',
    ];

    //mutator
    public function setNameAttribute($value)
    {
        $this->attributes['name'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }

    // One to many relation with student model
    public function students()
    {
        return $this->hasMany(UserCourse::class, 'course_id')->with('user');
    }

    public function users()
    {
        return $this->hasMany(User::class, 'course_id')->with('user');
    }

    public function classRoutines()
    {
        return $this->hasMany(ClassRoutine::class);
    }

    public function usersCourse()
    {
        return $this->belongsToMany(User::class, 'student_lists', 'course_id', 'student_id');
    }

    // One to many relation with assignment model
    public function assignments()
    {
        return $this->hasMany(Assignment::class, 'course_id')->latest();
    }

    // One to many relation with subject model
    public function subjects()
    {
        return $this->hasMany(Subject::class, 'course_id', 'id');
    }

    // One to many relation with online-class model
    public function online_classes()
    {
        return $this->hasMany(OnlineClass::class, 'course_id', 'id');
    }

    // One to many relation with exam model
    public function exams()
    {
        return $this->hasMany(Exam::class, 'course_id', 'id');
    }

    // One to many relation with result model
    public function results()
    {
        return $this->hasMany(Result::class, 'course_id', 'id');
    }

    // One to one relation with plan model
    public function plans()
    {
        return $this->hasMany(Plan::class, 'course_id');
    }

    // many to many relation with plan model
    public function examResults()
    {
        return $this->belongsToMany(Exam::class, 'course_result');
    }

}
