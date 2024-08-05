<?php
// app/Exports/StudentLeaveExport.php

namespace App\Exports;

use App\Models\Leave;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class StudentLeaveExport implements FromView, WithHeadings, WithMapping
{
    protected $name;
    protected $month;
    protected $courseId;

    public function __construct($name = null, $month = null, $courseId = null)
    {
        $this->name = $name;
        $this->month = $month;
        $this->courseId = $courseId;
    }

    public function view(): View
    {
        $query = Leave::with(['user:id,name', 'type:id,name', 'user.courses.course:id,name'])
            ->whereHas('user', function ($query) {
                $query->where('role', 'Student');
            });

        if ($this->name) {
            $query->whereHas('user', function ($query) {
                $query->where('name', 'like', '%' . $this->name . '%');
            });
        }

        if ($this->month) {
            $query->whereMonth('created_at', Carbon::parse($this->month)->month);
        }

        if ($this->courseId) {
            $query->whereHas('user.courses', function ($query) {
                $query->where('course_id', $this->courseId);
            });
        }

        $leaveStudents = $query->get();

        $leaveStudents->each(function ($leave) {
            $start = Carbon::parse($leave->start);
            $end = Carbon::parse($leave->end);

            $leave->student_name = $leave->user->name;
            $leave->course_name = $leave->user->courses->first()->course->name ?? 'N/A'; // Ambil nama kelas pertama jika ada
            $leave->type_name = $leave->type->name; // Mendapatkan nama leave_type berdasarkan leave_type_id
            $leave->leave_period = "{$start->format('Y-m-d')} to {$end->format('Y-m-d')}"; // Format periode izin
            $leave->created_date = $leave->created_at->format('Y-m-d');
        });

        return view('exports.student_leave', [
            'leaveStudents' => $leaveStudents
        ]);
    }

    public function map($leave): array
    {
        return [
            $leave->student_name,
            $leave->course_name,
            $leave->leave_period,
            $leave->type_name,
            $leave->status,
            $leave->description,
            $leave->created_date
        ];
    }

    public function headings(): array
    {
        return [
            'Name',
            'Class',
            'Leave Period',
            'Leave Type',
            'Status',
            'Description',
            'Created At'
        ];
    }
}
