<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class ClassRoutine extends Model
{
    use HasFactory;

    protected $guarded = [];

    const WEEK_DAYS = [
        '1' => 'Monday',
        '2' => 'Tuesday',
        '3' => 'Wednesday',
        '4' => 'Thursday',
        '5' => 'Friday',
        '6' => 'Saturday',
        '7' => 'Sunday',
    ];

    protected $appends = [
        'full_date',
    ];

    public function getStartTimeAttribute($value)
    {
        return $value ? date('H:i', strtotime($value)) : null;
    }

    // full date accessor
    public function getFullDateAttribute()
    {
        $startDatetime = '';

        if ($this->start_date) {
            $startDatetime = $this->start_date.' '.$this->start_time;
        } else {
            $startDatetime = $this->start_time;
        }

        return $startDatetime;
    }

    public function getEndTimeAttribute($value)
    {
        return $value ? date('H:i', strtotime($value)) : null;
    }

    // One to one relation with user model as teacher
    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id', 'id');
    }

    // One to one relation with class model to get class details
    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id', 'id');
    }

    // One to one relation with subject model to get subject details
    public function subject()
    {
        return $this->belongsTo(Subject::class, 'subject_id', 'id');
    }

    public function subjects()
    {
        return $this->belongsTo(Subject::class);
    }

    public function getDifferenceAttribute()
    {
        return Carbon::parse($this->end_time)->diffInMinutes($this->start_time);
    }
}
