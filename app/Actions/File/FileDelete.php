<?php

namespace App\Actions\File;

class FileDelete
{
    public static function deleteImage($image)
    {
        if (file_exists($image)) {
            @unlink($image);
        }
    }

    public static function deleteImageStorage($image)
    {
        $path = 'storage/'.$image;
        if (file_exists($path)) {
            @unlink($path);
        }
    }
}
