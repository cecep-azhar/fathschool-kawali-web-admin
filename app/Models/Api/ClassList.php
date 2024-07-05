<?php

namespace App\Models\Api;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassList extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function learningLessons()
    {
        return $this->hasMany(LearningLesson::class, 'class_lists_id');
    }

    public function studentLists()
    {
        return $this->hasMany(StudentList::class);
    }
}
