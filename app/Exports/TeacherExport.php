<?php

namespace App\Exports;

use App\Models\Attendance;
use App\Models\Setting;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class TeacherExport implements FromCollection, WithHeadings, WithMapping, WithStyles
{
    protected $name;
    protected $start_date;
    protected $end_date;
    protected $study_program;

    public function __construct($name = null, $start_date = null, $end_date = null, $study_program = null)
    {
        $this->name = $name;
        $this->start_date = $start_date;
        $this->end_date = $end_date;
        $this->study_program = $study_program;
    }

    public function collection()
    {
        $query = Attendance::query();

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

        if ($this->study_program) {
            $query->whereHas('user.courses.course.study_program', function ($q) {
                $q->where('slug', 'LIKE', '%' . $this->study_program . '%');
            });
        }

        $attendances = $query->get()->map(function ($attendance, $index) {
            $attendance->number = $index + 1;
            return $attendance;
        });

        $settingTimeIn = Setting::select(['time_in'])->first();

        if ($settingTimeIn && $settingTimeIn->time_in) {
            $settingTime = Carbon::createFromFormat('H:i:s', $settingTimeIn->time_in);

            $attendances->map(function ($attendance) use ($settingTime) {
                if ($attendance->time_in) {
                    $attendanceTime = Carbon::createFromFormat('H:i:s', $attendance->time_in);
                    if ($attendanceTime->greaterThan($settingTime)) {
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
            return response()->json(['error' => 'Setting time_in not found or invalid.'], 400);
        }

        return $attendances;
    }

    // Rest of the methods remain the same
    public function map($attendances): array
    {
        return [
            $attendances->number,
            $attendances->user->name,
            $attendances->user->courses->pluck('course.study_program.name')->join(', '),
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
        $sheet->getStyle('A1:I1')->getFont()->setSize(15);
        $sheet->getStyle('A1:I1')->getFont()->setBold(true);
        $sheet->getStyle('A1:I1')->getAlignment()->setHorizontal('center');

        foreach (range('A', 'I') as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }
    }
}
