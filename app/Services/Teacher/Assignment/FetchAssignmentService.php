<?php

namespace App\Services\Teacher\Assignment;

use App\Models\Course;
use App\Models\Subject;

class FetchAssignmentService
{
    public function fetch(object $request)
    {
        $query = authUser()->assignments()->with('subject', 'teacher', 'class:id,name');

        // filter => keyword
        if ($request->has('keyword') && $request->keyword != null) {
            $query->where('title', 'Like', '%'.$request->keyword.'%');
        }

        // filter
        if ($request->has('status') && $request->status != null) {

            if ($request->status == 'Due') {
                $query->due();
            }
            if ($request->status == 'Expired') {
                $query->expired();
            }
        }

        // subject
        if ($request->has('subject_id') && $request->subject_id != null) {
            $query->where('subject_id', $request->subject_id);
        }

        $assignments = $query
            ->latest('end_date')
            ->paginate(20)->withQueryString();
        // This will replace data property of the pagination
        $assignments->setCollection($assignments->groupBy('assignment_status'));
        $assignments->append(['submissions', 'students', 'total_mark', 'assignment_status']);

        $subjects = authUser()->subjects()->latest()->get();
        $course_ids = $subjects->map(function ($subject) {
            return $subject->subject->course_id;
        });

        $data['classes'] = Course::whereIn('id', $course_ids)->get();
        $data['assignments'] = $assignments;
        $data['subjects'] =$subjects->map(function ($q) {
            return $q->subject;
        });

        $data['request_data'] = $request;

        return $data;
    }
}
