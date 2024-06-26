<?php

namespace App\Services\Teacher\Class;

use App\Traits\ZoomMeetingTrait;
use Carbon\Carbon;

class UpdateOnlineClassService
{
    use ZoomMeetingTrait;

    const MEETING_TYPE_INSTANT = 1;

    const MEETING_TYPE_SCHEDULE = 2;

    const MEETING_TYPE_RECURRING = 3;

    const MEETING_TYPE_FIXED_RECURRING_FIXED = 8;

    public function update(object $request, object $class)
    {
        $this->update_zoom($request, $class->class_id);
        $updated_class = $this->get_zoom($class->class_id);
        $class->update([
            'course_id' => $updated_class['data'] ? $updated_class['data']['id'] : null,
            'class_uuid' => $updated_class['data'] ? $updated_class['data']['uuid'] : null,
            'host_id' => $updated_class['data'] ? $updated_class['data']['host_id'] : null,
            'host_email' => $updated_class['data'] ? $updated_class['data']['host_email'] : null,
            'topic' => $updated_class['data'] ? $updated_class['data']['topic'] : null,
            'description' => $updated_class['data'] ? $updated_class['data']['agenda'] : null,
            'type' => $updated_class['data'] ? $updated_class['data']['type'] : null,
            'status' => $request->status,
            'start_time' => $updated_class['data'] ? Carbon::parse($updated_class['data']['start_time']) : null,
            'timezone' => $updated_class['data'] ? $updated_class['data']['timezone'] : null,
            'start_url' => $updated_class['data'] ? $updated_class['data']['start_url'] : null,
            'join_url' => $updated_class['data'] ? $updated_class['data']['join_url'] : null,
            'password' => $updated_class['data'] ? $updated_class['data']['password'] : null,
            'encrypted_password' => $updated_class['data'] ? $updated_class['data']['encrypted_password'] : null,
            'subject_id' => $request->subject,
            'course_id' => $request->course,
        ]);
    }
}
