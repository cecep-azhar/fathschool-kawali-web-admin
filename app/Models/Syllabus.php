<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Syllabus extends Model
{
    use HasFactory;

    protected $guarded = [];

    // One to one relation user model as teacher

    public function teacher()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // One to one relation subject model
    public function subject()
    {
        return $this->belongsTo(Subject::class, 'subject_id');
    }

    // One to one relation class model
    public function class()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }

    // accessor |  syllabus document url gen
    public function getSyllabusAttribute($value)
    {
        if ($value) {
            return asset($value);
        }
    }
}
