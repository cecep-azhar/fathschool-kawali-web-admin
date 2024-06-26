<?php

namespace App\Actions\File;

class FileUpload
{
    public static function uploadImage($file, $path)
    {
        $fileName = time().'_'.uniqid().'.'.$file->getClientOriginalExtension();
        $file->move(public_path('/uploads/'.$path.'/'), $fileName);

        return "uploads/$path/".$fileName;
    }

    public static function uploadImageStorage($file, $path)
    {
        $fileName = time().'_'.uniqid().'.'.$file->getClientOriginalExtension();
        $file->move(storage_path('app/public/'.$path.'/'), $fileName);

        return $path.'/'.$fileName;
    }
}
