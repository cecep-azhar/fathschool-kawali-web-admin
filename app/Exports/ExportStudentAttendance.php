<?php

namespace App\Exports;

use App\Models\StudentAttendance;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ExportStudentAttendance implements FromCollection, WithHeadings, WithMapping
{
    protected $student;

    protected $subject;

    public function __construct($student, $subject)
    {
        $this->student = $student;
        $this->subject = $subject;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $attendances = StudentAttendance::with('student', 'teacher', 'subject')->where('student_id', $this->student)->where('subject_id', $this->subject)->get();

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
            $attendance->teacher->name,
            $attendance->subject->name,
            $attendance->status,
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
            'Teacher',
            'Subject',
            'Status',
            'Late Time',
            'Date',
        ];
    }
}
