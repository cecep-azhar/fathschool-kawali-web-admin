<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResultRule extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'gpa',
        'min_mark',
        'max_mark',
        'grade_remark',
    ];
}
