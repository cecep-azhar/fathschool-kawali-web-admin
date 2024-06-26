<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Onboarding extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $appends = ['menu_slug_text'];

    // accessor
    public function getMenuSlugTextAttribute($value)
    {
        $value = $this->menu_slug;
        $substring = '_';

        return ucwords(str_replace($substring, ' ', $value));
    }
}
