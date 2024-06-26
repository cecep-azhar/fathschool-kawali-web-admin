<?php

namespace App\Services\Teacher\Class;

use App\Models\Course;
use App\Models\OnlineClass;
use App\Notifications\NewClassAlertNotification;
use App\Traits\ZoomMeetingTrait;
use Carbon\Carbon;
use Illuminate\Support\Facades\Notification;

class CreateOnlineClassService
{
    use ZoomMeetingTrait;

    const MEETING_TYPE_INSTANT = 1;

    const MEETING_TYPE_SCHEDULE = 2;

    const MEETING_TYPE_RECURRING = 3;

    const MEETING_TYPE_FIXED_RECURRING_FIXED = 8;

    public function create(object $request)
    {
        $meeting = $this->create_zoom($request);
        $class = OnlineClass::create([
            'class_id' => $meeting['data'] ? $meeting['data']['id'] : null,
            'class_uuid' => $meeting['data'] ? $meeting['data']['uuid'] : null,
            'host_id' => $meeting['data'] ? $meeting['data']['host_id'] : null,
            'host_email' => $meeting['data'] ? $meeting['data']['host_email'] : null,
            'topic' => $meeting['data'] ? $meeting['data']['topic'] : null,
            'description' => $meeting['data'] ? $meeting['data']['agenda'] ?? null : null,
            'type' => $meeting['data'] ? $meeting['data']['type'] : null,
            'status' => $request->status,
            'start_time' => $meeting['data'] ? Carbon::parse($meeting['data']['start_time']) : null,
            'timezone' => $meeting['data'] ? $meeting['data']['timezone'] : null,
            'start_url' => $meeting['data'] ? $meeting['data']['start_url'] : null,
            'join_url' => $meeting['data'] ? $meeting['data']['join_url'] : null,
            'password' => $meeting['data'] ? $meeting['data']['password'] : null,
            'encrypted_password' => $meeting['data'] ? $meeting['data']['encrypted_password'] : null,
            'teacher_id' => auth()->id(),
            'subject_id' => $request->subject,
            'course_id' => $request->course,
        ]);

        $this->sendAlertToStudent($class, $request->course);
    }

    public function sendAlertToStudent(object $meeting, string $class): void
    {
        $class = Course::where('id', $class)->first();
        if ($class) {
            $students = $class->students()->with('user')->get();
            foreach ($students as $key => $student) {
                if ($student->user) {
                    Notification::send($student->user, new NewClassAlertNotification($student, $meeting));
                }
            }
        }
    }
}
