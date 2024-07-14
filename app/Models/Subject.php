<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class Subject extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $appends = ['session'];

    protected $dates = ['session'];

    protected $fillable = ['name', 'course_id'];

    //mutator
    public function setNameAttribute($value)
    {
        $this->attributes['name'] = $value;
        $this->attributes['slug'] = Str::slug($value).Str::random(3);
    }

    // accessor | subject session format
    public function getSessionAttribute()
    {
        $start_year = $this->session_start;
        $end_year = $this->session_end;

        $formatted_start_year = $start_year ? date('Y', strtotime($start_year)) : null;
        $formatted_end_year = $end_year ? date('Y', strtotime($end_year)) : null;

        return $formatted_start_year && $formatted_end_year
            ? $formatted_start_year.' - '.$formatted_end_year
            : null;
    }

    // accessor | subject session start
    public function getSessionStartAttribute($value)
    {
        return $value ? date('Y-m-d', strtotime($value)) : null;
    }

    // accessor | subject session end
    public function getSessionEndAttribute($value)
    {
        return $value ? date('Y-m-d', strtotime($value)) : null;
    }

    // One to one relation with Course model
    public function scopeByCourseId($query, $courseId)
    {
        return $query->where('course_id', $courseId);
    }
    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class, 'course_id');
    }

    // One to one relation with Course model
    public function chat_group()
    {
        return $this->hasOne(ChatGroup::class, 'subject_id', 'id');
    }

    // One to many relation with teacher model
    public function teachers()
    {
        return $this->hasMany(TeacherSubject::class, 'subject_id');
    }

    public function classRoutines()
    {
        return $this->hasMany(ClassRoutine::class);
    }

    /**
     * One to many relation with online class model
     * to get all the classes under a subject
     */
    public function online_classes()
    {
        return $this->hasMany(OnlineClass::class, 'subject_id', 'id');
    }

    /**
     * One to many relation with syllabus model
     * to get all the syllabuses under a subject
     */
    public function syllabuses()
    {
        return $this->hasMany(Syllabus::class, 'subject_id');
    }
}
