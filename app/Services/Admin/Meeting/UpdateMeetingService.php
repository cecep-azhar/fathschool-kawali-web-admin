<?php

namespace App\Services\Admin\Meeting;

use App\Models\User;
use Carbon\Carbon;

class UpdateMeetingService
{
    public function update(array $meeting, object $local_meeting, object $request): void
    {
        $local_meeting->update([
            'meeting_id' => $meeting['data'] ? $meeting['data']['id'] : null,
            'meeting_uuid' => $meeting['data'] ? $meeting['data']['uuid'] : null,
            'host_id' => $meeting['data'] ? $meeting['data']['host_id'] : null,
            'host_email' => $meeting['data'] ? $meeting['data']['host_email'] : null,
            'topic' => $meeting['data'] ? $meeting['data']['topic'] : null,
            'description' => $meeting['data'] ? $meeting['data']['agenda'] : null,
            'type' => $meeting['data'] ? $meeting['data']['type'] : null,
            'status' => $meeting['data'] ? $meeting['data']['status'] : null,
            'start_time' => $meeting['data'] ? Carbon::parse($meeting['data']['start_time']) : null,
            'timezone' => $meeting['data'] ? $meeting['data']['timezone'] : null,
            'meeting_start_url' => $meeting['data'] ? $meeting['data']['start_url'] : null,
            'meeting_join_url' => $meeting['data'] ? $meeting['data']['join_url'] : null,
            'password' => $meeting['data'] ? $meeting['data']['password'] : null,
            'encrypted_password' => $meeting['data'] ? $meeting['data']['encrypted_password'] : null,
        ]);

        $this->updateAttendee($local_meeting, $request);
    }

    public function updateAttendee(object $meeting, object $request): void
    {
        if ($request->all_user) {
            $role = $request->selected_role;
            $users = User::active()->where('role', $role)->get();
        } else {
            $users = User::active()->whereIn('id', $request->participants)->get();
        }

        $meeting->participants()->delete();
        foreach ($users as $key => $user) {
            $meeting->participants()->create([
                'user_id' => $user->id,
            ]);
        }
    }
}
