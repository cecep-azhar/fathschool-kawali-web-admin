<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Laravel\Jetstream\HasProfilePhoto;

class AdmissionRequest extends Model
{
    use HasFactory, HasProfilePhoto;

    protected $guarded = [];

    protected $appends = ['profile_image_url', 'parent_profile_image_url', 'course_names'];

    // accessor |  Admission profile photo url
    public function getProfileImageUrlAttribute()
    {
        return $this->profile_photo
            ? asset($this->profile_photo)
            : $this->defaultProfilePhotoUrl();
    }

    // accessor |  Parent profile photo url
    public function getParentProfileImageUrlAttribute()
    {
        return $this->guardian_photo
            ? asset($this->guardian_photo)
            : $this->defaultProfilePhotoUrl();
    }

    // accessor |  Admission Course Name
    public function getCourseNamesAttribute()
    {
        $courses = json_decode($this->courses);

        return Course::whereIn('id', $courses)->get()->map(function ($q) {
            return $q->name;
        });
    }

    public function class(): BelongsTo
    {
        return $this->belongsTo(Course::class, 'course_id');
    }

    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class, 'department_id');
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(User::class, 'parent_id');
    }
}
