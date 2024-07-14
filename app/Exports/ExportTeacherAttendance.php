<?php

namespace App\Exports;

use App\Models\Attendance;
use App\Models\TeacherAttendance;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ExportTeacherAttendance implements FromCollection, WithHeadings, WithMapping
{
    protected $user;

    public function __construct($user)
    {
        $this->user = $user;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $attendances = Attendance::with('user')->where('user_id', $this->user)->get();

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
            $attendance->user->name,
            $attendance->date,
            $attendance->time_in,
            $attendance->time_out,
            $attendance->latlon_in,
            $attendance->latlon_out,
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
            'User',
            'Date',
            'Time In',
            'Time Out',
            'Latlon In',
            'Latlon Out',
        ];
    }
}
