<?php

namespace App\Services\Teacher\Assignment;

use App\Models\Assignment;
use App\Models\Course;
use App\Models\User;
use App\Notifications\NewAssignmentAlertNotification;
use Carbon\Carbon;
use Illuminate\Support\Facades\Notification;

class CreateAssignmentService
{
    public function create(object $request)
    {
        $start = Carbon::parse($request->date2[0])->startOfDay();
        $end = Carbon::parse($request->date2[1])->endOfDay();

        // data create
        $assignment = Assignment::create([
            'user_id' => $request->teacher,
            'subject_id' => $request->subject,
            'course_id' => $request->class,
            'title' => $request->title,
            'start_date' => $start,
            'end_date' => $end,
            'mark' => $request->mark,
            'description' => $request->description,
        ]);

        $this->sendNotification($request->class, $assignment);
    }

    public function sendNotification(string $course, object $assignment)
    {
        $course = Course::where('id', $course)->first();
        if ($course) {
            $students = $course->students()->get()->map(function ($q) {
                return $q->user_id;
            });
            if ($students) {
                foreach ($students as $key => $student) {
                    $user = User::where('id', $student)->first();
                    if ($user) {
                        Notification::send($user, new NewAssignmentAlertNotification($user, $assignment));
                    }
                }
            }
        }
    }
}
