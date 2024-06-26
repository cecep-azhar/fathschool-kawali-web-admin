<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $appends = [
        'dark_logo_url',
        'light_logo_url',
        'favicon_icon_url',
    ];

    // accessor |  dark logo link
    public function getDarkLogoUrlAttribute()
    {
        $value = $this->dark_logo;
        if ($value) {
            return asset($value);
        }
    }

    // accessor |  light logo link
    public function getLightLogoUrlAttribute()
    {
        $value = $this->light_logo;
        if ($value) {
            return asset($value);
        }
    }

    // accessor |  favicon icon  link
    public function getFaviconIconUrlAttribute()
    {
        $value = $this->favicon_icon;
        if ($value) {
            return asset($value);
        }
    }
}
