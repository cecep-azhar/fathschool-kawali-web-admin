<?php

namespace App\Exports;

use App\Models\StudentAttendance;
use Illuminate\Support\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ExportAdminStudentAttendance implements FromCollection, WithHeadings, WithMapping
{
    protected $student;

    protected $start_date;

    protected $end_date;

    public function __construct($student, $start_date, $end_date)
    {
        $this->student = $student;
        $this->start_date = $start_date;
        $this->end_dte = $end_date;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $attendances = StudentAttendance::with('student')
            ->where('student_id', $this->student)
            ->whereDate('created_at', '>=', Carbon::parse($this->start_date))
            ->whereDate('created_at', '<=', Carbon::parse($this->end_date))
            ->get();

        return $attendances;
    }

    /**
     * Xls Mapping for relationship data get
     *
     * @return \Illuminate\Support\Collection
     */
    public function map($attendance): array
    {
        return [
            $attendance->student->name,
            ucfirst($attendance->status),
            $attendance->status == 'late' ? $attendance->late_amount.' Minutes' : 0,
            $attendance->date_time,
        ];
    }

    /**
     * Xls Heading return
     *
     * @return \Illuminate\Support\Collection
     */
    public function headings(): array
    {
        return [
            'Student',
            'Status',
            'Late Time',
            'Date',
        ];
    }
}
