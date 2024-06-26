<?php

namespace App\Services\Frontend\Admission;

use App\Actions\File\FileUpload;
use App\Models\AdmissionRequest;
use App\Models\Course;
use App\Models\User;
use App\Notifications\Admin\AdmissionRequestPendingNotification;

class AdmissionRequestService
{
    public function admission(object $request): void
    {
        $profile_photo = '';
        $guardian_photo = '';
        $documents = [];
        $courses = $request->classes;

        // for avatar upload
        if ($request->hasFile('avatar')) {
            $url = FileUpload::uploadImage($request->avatar, 'profile-photos');
            $profile_photo = $url;
        }
        // for parent avatar upload
        if ($request->hasFile('parent_avatar')) {
            $url = FileUpload::uploadImage($request->parent_avatar, 'profile-photos');
            $guardian_photo = $url;
        }
        // for documents upload
        if ($request->hasFile('documents')) {
            $document_titles = $request->document_titles;
            foreach ($request->documents as $key => $value) {
                $url = FileUpload::uploadImage($value, 'student-documents');
                $doc = [
                    'title' => $document_titles[$key] ?? '',
                    'url' => $url,
                ];
                array_push($documents, $doc);
            }
        }

        AdmissionRequest::create([
            'name' => $request->name,
            'email' => $request->email,
            'date_of_birth' => $request->date_of_birth,
            'gender' => $request->gender,
            'phone' => $request->phone,
            'address' => $request->address,
            'national_identification_number' => $request->national_identification_number,
            'blood_group' => $request->blood_group,
            'physical_disability' => $request->physical_disability,
            'previous_school_name' => $request->previous_school_name,
            'previous_school_year_of_exist' => $request->previous_school_year_of_exist,
            'religion' => $request->religion,
            'bank_name' => $request->bank_name,
            'bank_account_number' => $request->bank_account_number,
            'note' => $request->note,
            'guardian_name' => $request->parent_name,
            'guardian_email' => $request->parent_email,
            // complicated fields
            'profile_photo' => $profile_photo,
            'guardian_photo' => $guardian_photo,
            // complicated fields => json
            'courses' => $courses ? json_encode($courses) : null,
            'documents' => $documents ? json_encode($documents) : null,
        ]);

        // Sending admission pending mail
        if (checkMailConfig()) {
            $admins = User::admin()->get();

            $course_names = [];
            if ($request->classes) {
                foreach ($request->classes as $key => $course_id) {

                    $course = Course::where('id', $course_id)->first();
                    array_push($course_names, $course->name);
                }
            }

            foreach ($admins as $admin) {
                $admin->notify(new AdmissionRequestPendingNotification($request->name, $course_names));
            }
        }
    }
}
