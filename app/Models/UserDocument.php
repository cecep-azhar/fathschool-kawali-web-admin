<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserDocument extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $appends = ['file_url_format'];

    /**
     * Accessor
     * File format url
     */
    public function getFileUrlFormatAttribute()
    {
        $url = $this->file_url;
        if ($url) {
            return asset($url);
        }
    }
}
