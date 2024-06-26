<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class Exam extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $dates = ['start_date', 'end_date'];

    protected $appends = ['start_time', 'end_time', 'status'];

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }

    // accessor |  event start time
    public function getStartTimeAttribute()
    {
        $date = $this->start_date;

        return formatTime($date);
        // return date('M d , Y', strtotime($date));
    }

    // accessor |  event end time
    public function getEndTimeAttribute()
    {
        $date = $this->end_date;

        return formatTime($date);
        // return date('M d , Y', strtotime($date));
    }

    // accessor |  event status get
    public function getStatusAttribute()
    {
        $end_date = $this->end_date;

        if ($end_date >= Carbon::now()) {

            return 'Running';
        } else {

            return 'Expired';
        }
    }

    // One to one relation with class model to get class details
    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }

    // has many relation with plan model
    public function examResults()
    {
        return $this->hasMany(ExamResult::class);
    }
}
