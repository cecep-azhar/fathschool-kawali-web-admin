<?php

namespace App\Exports;

use App\Models\AttendanceStudent;
use App\Models\User;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithEvents;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Events\AfterSheet;

class StudentAttendanceExport implements FromCollection, WithHeadings, WithMapping, WithStyles, WithColumnFormatting, WithEvents
{
    protected $start_date;
    protected $end_date;
    protected $name;
    protected $course;
    protected $study_program;
    protected $data;

    public function __construct($start_date = null, $end_date = null, $name = null, $course = null, $study_program = null)
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

        if ($this->name) {
            $studentsQuery->where('name', 'LIKE', '%' . trim($this->name) . '%');
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

        $this->data = $students->map(function ($student, $index) use ($dates, $attendances) {
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

        return $this->data;
    }

    public function map($student): array
    {
        $attendance = array_map(fn($val) => $val ?? 'A', $student['attendance']);

        return array_merge(
            [$student['no'], $student['user_name'], $student['class']],
            $attendance,
            [
                (int) ($student['summary']['hadir'] ?? 0),
                (int) ($student['summary']['sakit'] ?? 0),
                (int) ($student['summary']['ijin'] ?? 0),
                (int) ($student['summary']['alfa'] ?? 0),
            ]
        );
    }

    public function headings(): array
    {
        $start = Carbon::parse($this->start_date);
        $end = Carbon::parse($this->end_date);
        $dates = collect($start->daysUntil($end))->map(fn($date) => $date->format('d/m/Y'))->toArray();

        return array_merge(
            ['No', 'Nama Siswa', 'Kelas'],
            $dates,
            ['Hadir', 'Sakit', 'Ijin', 'Alfa']
        );
    }

    public function styles(Worksheet $sheet)
    {
        $headings = $this->headings();
        $highestColumnIndex = count($headings);
        $lastColumn = Coordinate::stringFromColumnIndex($highestColumnIndex);

        $sheet->getStyle("A1:{$lastColumn}1")->applyFromArray([
            'font' => ['bold' => true, 'size' => 12],
            'alignment' => [
                'horizontal' => 'center',
                'vertical' => 'center',
            ],
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => ['argb' => 'FFFFFF'],
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

        return [];
    }

    public function columnFormats(): array
    {
        $start = Carbon::parse($this->start_date);
        $end = Carbon::parse($this->end_date);
        $dateCount = $start->diffInDays($end) + 1;

        $base = 4 + $dateCount;
        $colLetters = [
            Coordinate::stringFromColumnIndex($base),
            Coordinate::stringFromColumnIndex($base + 1),
            Coordinate::stringFromColumnIndex($base + 2),
            Coordinate::stringFromColumnIndex($base + 3),
        ];

        return collect($colLetters)->mapWithKeys(fn($col) => [$col => NumberFormat::FORMAT_NUMBER])->toArray();
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $startRow = count($this->data) + 3;

                $totalHadir = $this->data->sum(fn($item) => $item['summary']['hadir']);
                $totalIjin = $this->data->sum(fn($item) => $item['summary']['ijin']);
                $totalAlfa = $this->data->sum(fn($item) => $item['summary']['alfa']);

                $event->sheet->setCellValue("B{$startRow}", "Total Kehadiran: {$totalHadir}");
                $event->sheet->setCellValue("B" . ($startRow + 1), "Total Izin: {$totalIjin}");
                $event->sheet->setCellValue("B" . ($startRow + 2), "Total Alfa: {$totalAlfa}");
            },
        ];
    }
}
