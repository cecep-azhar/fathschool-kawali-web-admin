<?php

namespace App\Exports;

use App\Models\AttendanceStudent;
use App\Models\Setting;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Illuminate\Support\Collection;

class StudentAttendanceExport implements FromCollection, WithHeadings, WithMapping, WithStyles
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
        $query = AttendanceStudent::query();

        if ($this->name) {
            $query->whereHas('user', function ($q) {
                $q->where('name', 'like', '%' . $this->name . '%');
            });
        }

        // Filter berdasarkan date range
        if ($this->start_date) {
            $query->whereDate('date', '>=', $this->start_date);
        }
        if ($this->end_date) {
            $query->whereDate('date', '<=', $this->end_date);
        }

        // Jika tidak ada date range, gunakan hari ini
        if (!$this->start_date && !$this->end_date) {
            $query->whereDate('date', '=', Carbon::today()->toDateString());
        }

        if($this->course) {
            $query->whereHas('user.courses.course', function ($q) {
                $q->where('slug', 'LIKE', '%' . $this->course . '%');
            });
        }

        if($this->study_program) {
            $query->whereHas('user.courses.course.study_program', function ($q) {
                $q->where('slug', 'LIKE', '%' . $this->study_program . '%');
            });
        }

        // Get all attendance records
        $attendances = $query->get();

        // Group attendances by user_id and date to remove duplicates
        $uniqueAttendances = $attendances->groupBy(function ($attendance) {
            return $attendance->user_id . '_' . $attendance->date;
        })->map(function ($group) {
            // Take the first record from each group
            return $group->first();
        })->values();

        // Re-number the filtered records
        $uniqueAttendances = $uniqueAttendances->map(function ($attendance, $index) {
            $attendance->number = $index + 1;
            return $attendance;
        });

        // Ambil setting waktu 'time_in'
        $settingTimeIn = Setting::select(['time_in'])->first();

        // Cek apakah settingTimeIn ada dan time_in tidak kosong
        if ($settingTimeIn && $settingTimeIn->time_in) {
            // Parsing waktu dari settingTimeIn
            $settingTime = Carbon::createFromFormat('H:i:s', $settingTimeIn->time_in);

            // Loop untuk menghitung keterlambatan setiap attendance
            $uniqueAttendances->map(function ($attendance) use ($settingTime) {
                // Parsing waktu dari attendance
                if ($attendance->time_in) {
                    $attendanceTime = Carbon::createFromFormat('H:i:s', $attendance->time_in);

                    // Jika waktu attendance lebih lambat dari setting time, hitung keterlambatan
                    if ($attendanceTime->greaterThan($settingTime)) {
                        // Hitung keterlambatan dalam menit
                        $latenessMinutes = $attendanceTime->diffInMinutes($settingTime);
                        $attendance->lateness = $latenessMinutes . ' minute';
                    } else {
                        $attendance->lateness = '0 minute';
                    }
                } else {
                    $attendance->lateness = 'Not Recorded';
                }

                return $attendance;
            });
        } else {
            return new Collection(); // Return empty collection if setting not found
        }

        return $uniqueAttendances;
    }

    public function map($attendances): array
    {
        return [
            $attendances->number,
            $attendances->user ? $attendances->user->name : 'N/A',
            $attendances->user && $attendances->user->courses ?
                $attendances->user->courses->pluck('course.name')->join(', ') : 'N/A',
            $attendances->user && $attendances->user->courses ?
                $attendances->user->courses->pluck('course.study_program.name')->join(', ') : 'N/A',
            $attendances->date,
            $attendances->time_in,
            $attendances->time_out,
            $attendances->lateness,
            $attendances->latlon_in,
            $attendances->latlon_out,
        ];
    }

    public function headings(): array
    {
        return [
            'No',
            'Name',
            'Course',
            'Study Program',
            'Date',
            'Time In',
            'Time Out',
            'Lateness',
            'Latlon In',
            'Latlon Out',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->getStyle('A1:J1')->getFont()->setSize(15);
        $sheet->getStyle('A1:J1')->getFont()->setBold(true);
        $sheet->getStyle('A1:J1')->getAlignment()->setHorizontal('center');

        foreach (range('A', 'J') as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }
    }
}
