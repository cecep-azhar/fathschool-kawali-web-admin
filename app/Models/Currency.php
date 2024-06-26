<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Currency extends Model
{
    use HasFactory;

    protected $guarded = [];

    /**
     * The mutators defined to ignore extra space the currency code
     *
     * @var array
     */
    public function setCodeAttribute($code)
    {
        $this->attributes['code'] = Str::upper(str_replace(' ', '', $code));
    }

    // Scope |  status active
    public function scopeActive($query)
    {
        return $this->where('status', true);
    }

    // Scope |  status Not active
    public function scopeInactive($query)
    {
        return $this->where('status', false);
    }
}
