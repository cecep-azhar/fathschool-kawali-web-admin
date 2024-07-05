<?php

namespace App\Models\Api;

use App\Models\User;
use App\Models\Api\ClassList;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentList extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'absence_number',
        'class_list_id',
    ];

    public function classList()
    {
        return $this->belongsTo(ClassList::class);
    }

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }
}
