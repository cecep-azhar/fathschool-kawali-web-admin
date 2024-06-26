<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeacherClassSection extends Model
{
    use HasFactory;

    protected $guarded = [];

    // One to one relation sectoin model
    public function section()
    {
        return $this->belongsTo(Section::class, 'section_id');
    }
}
