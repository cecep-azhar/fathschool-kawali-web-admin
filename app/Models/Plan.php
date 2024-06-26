<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Plan extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }

    // One to many relationship with course model
    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }

    // One to many relationship with plan benefit model
    public function benefits()
    {
        return $this->hasMany(PlanBenefit::class, 'plan_id');
    }
}
