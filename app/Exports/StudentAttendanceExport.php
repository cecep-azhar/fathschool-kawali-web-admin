<?php

namespace App\Exports;

use App\Models\AttendanceStudent;
use App\Models\User;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class StudentAttendanceExport implements FromCollection, WithHeadings, WithMapping, WithStyles
{
    protected $start_date;
    protected $end_date;
    protected $name;
    protected $course;
    protected $study_program;

    public function __construct($start_date = null,$end_date = null, $name = null, $course = null, $study_program = null)
    {
        $this->start_date = $start_date ?? Carbon::now()->startOfMonth()->toDateString();
        $this->end_date = $end_date ?? Carbon::now()->endOfMonth()->toDateString();
        $this->name = $name;
        $this->course = $course;
        $this->study_program = $study_program;
    }

    public function collection()
    {
        try {
            $start_date = Carbon::parse($this->start_date)->toDateString();
            $end_date = Carbon::parse($this->end_date)->toDateString();
        } catch (\Exception $e) {
            return collect([]);
        }

        $dates = collect(Carbon::parse($start_date)->daysUntil($end_date))->map(fn($date) => $date->toDateString());

        $studentsQuery = User::where('role', 'student')
        ->with(['courses.course:id,name,slug,study_program_id', 'leaves']);

    if ($this->keyword) {
        $studentsQuery->where('name', 'LIKE', '%' . trim($this->keyword) . '%');
    }

    if ($this->course) {
        $studentsQuery->whereHas('courses.course', function ($query) {
            $query->where('slug', 'LIKE', '%' . $this->course . '%');
        });
    }

    if ($this->study_program) {
        $studentsQuery->whereHas('courses.course.study_program', function ($query) {
            $query->where('slug', 'LIKE', '%' . $this->study_program . '%');
        });
    }

    $students = $studentsQuery->get();

    $attendances = AttendanceStudent::whereBetween('date', [$start_date, $end_date])
        ->get()
        ->groupBy('user_id');

    return $students->map(function ($student, $index) use ($dates, $attendances) {
        $userAttendances = $attendances->get($student->id, collect());

        $totalIjin = $student->leaves->filter(function ($leave) use ($dates) {
            return $leave->start <= $dates->last() && $leave->end >= $dates->first();
        })->sum(function ($leave) {
            return Carbon::parse($leave->start)->diffInDays(Carbon::parse($leave->end)) + 1;
        });

        $leaveDates = collect();
        foreach ($student->leaves as $leave) {
            $leavePeriod = collect(Carbon::parse($leave->start)->daysUntil($leave->end))->map(fn($date) => $date->toDateString());
            $leaveDates = $leaveDates->merge($leavePeriod);
        }

        $attendanceStatus = $dates->mapWithKeys(function ($date) use ($userAttendances, $leaveDates) {
            if ($leaveDates->contains($date)) {
                return [$date => 'I'];
            }

            $attendance = $userAttendances->firstWhere('date', $date);
            return [$date => $attendance ? 'H' : 'A'];
        });

        return [
            'no' => $index + 1,
            'user_name' => $student->name,
            'class' => $student->courses->first()->course->name ?? '-',
            'attendance' => $attendanceStatus->values()->toArray(),
            'summary' => [
                'hadir' => $attendanceStatus->filter(fn($s) => $s === 'H')->count(),
                'sakit' => 0,
                'ijin' => $totalIjin,
                'alfa' => $attendanceStatus->filter(fn($s) => $s === 'A')->count(),
            ],
        ];
    });
    }

    public function map($student): array
    {
        return array_merge(
            [$student['no'], $student['user_name'], $student['class']], // Tambahkan No
            $student['attendance'],
            [
                $student['summary']['hadir'],
                $student['summary']['sakit'],
                $student['summary']['ijin'],
                $student['summary']['alfa'],
            ]
        );
    }

    public function headings(): array
    {
        $start = Carbon::parse($this->start_date);
        $end = Carbon::parse($this->end_date);
        $dates = collect($start->daysUntil($end))->map(fn($date) => $date->format('d/m/Y'))->toArray();

        return [
            array_merge(['No', 'Nama Siswa', 'Kelas'], array_fill(0, count($dates), 'Tanggal'), ['Total']),
            array_merge(['', '', ''], $dates, ['Hadir', 'Sakit', 'Ijin', 'Alfa'])
        ];
    }


    public function styles(Worksheet $sheet)
    {
        $highestColumnIndex = count($this->headings()[1]);
        $lastColumn = Coordinate::stringFromColumnIndex($highestColumnIndex);

        $sheet->mergeCells("C1:{$lastColumn}1");
        $sheet->setCellValue("C1", "Tanggal");

        $totalStartColumn = Coordinate::stringFromColumnIndex($highestColumnIndex - 3);
        $sheet->mergeCells("{$totalStartColumn}1:{$lastColumn}1");
        $sheet->setCellValue("{$totalStartColumn}1", "Total Kehadiran");

        $sheet->mergeCells("A1:A2");
        $sheet->mergeCells("B1:B2");

        $sheet->getStyle("A1:{$lastColumn}2")->applyFromArray([
            'font' => ['bold' => true, 'size' => 12],
            'alignment' => [
                'horizontal' => 'center',
                'vertical' => 'center',
            ],
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => ['argb' => 'FFFFF'],
            ],
        ]);

        $highestRow = $sheet->getHighestRow();
        $sheet->getStyle("A1:{$lastColumn}{$highestRow}")->applyFromArray([
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['argb' => '000000'],
                ],
            ],
        ]);

        foreach (range(1, $highestColumnIndex) as $colIndex) {
            $colLetter = Coordinate::stringFromColumnIndex($colIndex);
            $sheet->getColumnDimension($colLetter)->setAutoSize(true);
        }
    }
}
