<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChatGroup extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function users()
    {
        return $this->hasOne(ChatGroupUser::class);
    }

    public function groupUsers()
    {
        return $this->hasMany(ChatGroupUser::class);
    }

    /**
     * One to one relationship with subject model
     */
    public function subject()
    {
        return $this->belongsTo(Subject::class, 'subject_id');
    }
}
