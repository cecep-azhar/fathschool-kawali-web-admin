<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GallerySlider extends Model
{
    use HasFactory;

    protected $fillable = ['image'];

    /**
     * The accessors that should be return image full path
     *
     * @param  string  $image
     * @return array
     */
    public function getImageAttribute($image)
    {
        return $image ? asset($image) : asset('images/default.png');
    }
}
