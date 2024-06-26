<?php

namespace App\Services\Teacher\Assignment;

use Carbon\Carbon;

class UpdateAssignmentService
{
    public function update(object $request, object $assignment)
    {
        $start = Carbon::parse($request->date2[0])->startOfDay();
        $end = Carbon::parse($request->date2[1])->endOfDay();

        // data create
        $assignment->update([
            'user_id' => $request->teacher,
            'subject_id' => $request->subject,
            'course_id' => $request->class,
            'title' => $request->title,
            'start_date' => $start,
            'end_date' => $end,
            'mark' => $request->mark,
            'description' => $request->description,
        ]);
    }
}
