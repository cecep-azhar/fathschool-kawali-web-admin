<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $appends = ['assignment_average_mark', 'attendance_present_average'];

    // One to one relation with class model
    public function class()
    {
        return $this->hasOne(Course::class, 'id', 'course_id');
    }

    // One to one relation with user model
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // One to one relation with submitted assignment model to get user all submitted assignment
    public function submitted_assignments()
    {
        return $this->hasMany(SubmittedAssignment::class, 'student_id', 'user_id');
    }

    // One to many relation with Attendance model
    public function attendances()
    {
        return $this->hasMany(StudentAttendance::class, 'student_id', 'user_id');
    }

    // Accessor submitted assignment avg mark
    public function getAssignmentAverageMarkAttribute()
    {
        return round($this->submitted_assignments()->avg('gained_mark'), 2);
    }

    // Accessor attendance avg mark
    public function getAttendancePresentAverageAttribute()
    {
        $attendances = $this->user->attendances()->count();
        $attendance_present_marks = $this->user->attendances()->latest()->present()->count();
        $attendance_marks = $attendances > 0 ? round(($attendance_present_marks / $attendances) * 100, 2) : 0;

        return $attendance_marks;
    }
}
