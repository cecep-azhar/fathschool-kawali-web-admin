<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserCourse extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $guarded = [];

    // One to one relation with user model
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // One to one relation with course model
    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }

    // course subject get for easy get subject
    public function getSubjectsAttribute()
    {
        return $this->course->subjects;
    }
}
