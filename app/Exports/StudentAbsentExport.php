<?php

namespace App\Exports;

use App\Models\AttendanceStudent;
use App\Models\User;
use App\Models\Setting;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class StudentAbsentExport implements FromCollection, WithHeadings, WithMapping, WithStyles
{
    protected $name;
    protected $start_date;
    protected $end_date;
    protected $course;
    protected $study_program;

    public function __construct($name = null, $start_date = null, $end_date = null, $course = null, $study_program = null)
    {
        $this->name = $name;
        $this->start_date = $start_date;
        $this->end_date = $end_date;
        $this->course = $course;
        $this->study_program = $study_program;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        // Start with base query for students
        $query = User::query()
            ->where('role', 'student')
            ->with(['courses.course.study_program', 'leaves.type']); // Eager load relationships

        // Filter berdasarkan nama jika ada
        if ($this->name) {
            $query->where('name', 'LIKE', '%' . $this->name . '%');
        }

        // Filter berdasarkan course
        if ($this->course) {
            $query->whereHas('courses.course', function ($q) {
                $q->where('slug', 'LIKE', '%' . $this->course . '%');
            });
        }

        // Filter berdasarkan study program
        if ($this->study_program) {
            $query->whereHas('courses.course.study_program', function ($q) {
                $q->where('slug', 'LIKE', '%' . $this->study_program . '%');
            });
        }

        // Get the target date
        $targetDate = $this->start_date ?? Carbon::today()->toDateString();

        // Filter students who don't have attendance for the target date
        $query->whereDoesntHave('attendance_student', function ($q) use ($targetDate) {
            $q->whereDate('date', $targetDate);
        });

        // Get the results
        $absents = $query->get();

        // Add number and date to each record
        return $absents->map(function ($absent, $index) use ($targetDate) {
            $absent->number = $index + 1;
            $absent->date = $targetDate;

            // Get leave for this specific date if exists
            $leave = $absent->leaves()
                ->whereDate('start', '<=', $targetDate)
                ->whereDate('end', '>=', $targetDate)
                ->with('type')
                ->first();

            // Store leave info for mapping
            $absent->current_leave = $leave;

            return $absent;
        });
    }

    /**
     * @param $absent
     * @return array
     */
    public function map($absent): array
    {
        return [
            $absent->number,
            $absent->name,
            $absent->courses->pluck('course.name')->first() ?: 'N/A',
            $absent->courses->pluck('course.study_program.name')->first() ?: 'N/A',
            $absent->date,
            $absent->current_leave ? $absent->current_leave->type->name : '-',
            $absent->current_leave ? $absent->current_leave->status : '-'
        ];
    }

    public function headings(): array
    {
        return [
            'No',
            'Name',
            'Class',
            'Study Program',
            'Date',
            'Leave Type',
            'Status'
        ];
    }

    public function styles(Worksheet $sheet)
    {
        // Menyesuaikan ukuran font header
        $sheet->getStyle('A1:G1')->getFont()->setSize(14);
        $sheet->getStyle('A1:G1')->getFont()->setBold(true);
        $sheet->getStyle('A1:G1')->getAlignment()->setHorizontal('center');

        // Menyesuaikan lebar kolom agar sesuai dengan konten
        foreach (range('A', 'G') as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }
    }
}
