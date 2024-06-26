<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class OnlineClass extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $appends = ['start_date_format'];

    // accessor |  online-class date format
    public function getStartDateFormatAttribute()
    {
        $value = $this->start_time;

        return formatTime($value, '', 'h:i A');

    }

    // // accessor |  online-class status
    // public function getStatusAttribute($value)
    // {
    //     return Str::ucfirst($value);
    // }

    // accessor |  class status 2
    public function getOnlineClassStatusAttribute()
    {
        $start_date = Carbon::parse($this->start_time)->format('d-m-y');
        $now = Carbon::parse(Carbon::now())->format('d-m-y');

        if ($now >= $start_date) {
            return 'Upcoming Class';
        } else {
            return 'Completed Class';
        }
    }

    // One to one relation with class model
    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id', 'id');
    }

    // One to one relation with user model as teacher
    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id', 'id');
    }

    // accessor |  online-class full time format
    public function getFullTimeAttribute()
    {
        $value = $this->time;

        return date('Y-m-d h:i', strtotime($value));
    }

    // One to one relation with subject model
    public function subject()
    {
        return $this->belongsTo(Subject::class, 'subject_id', 'id');
    }
}
