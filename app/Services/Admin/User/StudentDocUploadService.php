<?php

namespace App\Services\Admin\User;

use App\Actions\File\FileUpload;

class StudentDocUploadService
{
    public function uploadDoc(object $request, object $user): void
    {
        if ($request->hasFile('documents')) {
            foreach ($request->documents as $key => $value) {

                $url = FileUpload::uploadImage($value, 'student-documents');
                $user->documents()->create([
                    'file_url' => $url,
                    'title' => $request->document_titles[$key] ?? '',
                ]);
            }
        }
    }
}
