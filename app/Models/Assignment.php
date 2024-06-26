<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Assignment extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $appends = [
        'status',
        'remaining_days',
        'issue',
        'deadline',
    ];

    //Mutator
    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }

    // accessor |  assignment release date
    public function getIssueAttribute()
    {
        $date = $this->start_date;

        return date('M d , Y', strtotime($date));
    }

    // accessor |  assignment deadline date
    public function getDeadlineAttribute()
    {
        $date = $this->end_date;

        return formatTime($date);
    }

    // accessor |  assignment start date format
    public function getStartDateAttribute($value)
    {
        return date('d-m-Y', strtotime($value));
    }

    // accessor |  assignment end date format
    public function getEndDateAttribute($value)
    {
        return date('d-m-Y', strtotime($value));
    }

    // Scope |  assignment due filter
    public function scopeDue($query)
    {
        return $query->whereDate('end_date', '>=', Carbon::now());
    }

    // Scope |  assignment expired filter
    public function scopeExpired($query)
    {
        return $query->whereDate('end_date', '<=', Carbon::now());
    }

    // accessor |  assignment status
    public function getStatusAttribute()
    {
        $now = Carbon::now()->startOfDay();
        $endDate = Carbon::parse($this->end_date)->endOfDay();

        if ($endDate >= $now) {
            return 'Due';
        } else {
            return 'Expired';
        }
    }

    // accessor |  assignment status 2
    public function getAssignmentStatusAttribute()
    {
        $now = Carbon::now()->startOfDay();
        $endDate = Carbon::parse($this->end_date)->endOfDay();

        if ($endDate >= $now) {
            return 'Ongoing Assignment';
        } else {
            return 'Completed Assignment';
        }
    }

    // accessor |  assignment remaining days get
    public function getRemainingDaysAttribute()
    {
        $start_date = Carbon::now();
        $end_date = Carbon::parse($this->end_date);

        if ($this->status == 'Due') {
            return $start_date->diffInDays($end_date) + 1;
        } else {
            return 0;
        }
    }

    // accessor |  assignment submission percentage
    public function getSubmissionsAttribute()
    {
        $total_submitted = $this->submitted->count();
        $total_students = $this->class->students->count();
        $percentage = 0;
        if ($total_submitted > 0 && $total_students > 0) {
            $percentage = ($total_submitted / $total_students) * 100;
        }

        return number_format((float) $percentage, 2, '.', '');
    }

    // accessor |  assignment submission mark for a student
    public function getTotalMarkAttribute()
    {
        $submitted_item = $this->submitted()->where('student_id', auth()->id())->select('id', 'completed', 'student_id', 'assignment_id', 'gained_mark', 'assignment')->first();

        return $submitted_item;
    }

    // accessor |  assignment Course Total Student Count
    public function getStudentsAttribute()
    {
        $total_students = $this->class->students->count();

        return $total_students;
    }

    // One to one relation with class model to get class details
    public function class()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }

    // One to many relation with Submitted Assignment model to get all Submitted assignments
    public function submitted()
    {
        return $this->hasMany(SubmittedAssignment::class, 'assignment_id');
    }

    // One to one relation with user model as teacher
    public function teacher()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // One to one relation with subject model
    public function subject()
    {
        return $this->belongsTo(Subject::class, 'subject_id');
    }
}
