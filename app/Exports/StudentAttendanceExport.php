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
    protected $month;
    protected $name;
    protected $course;
    protected $study_program;

    public function __construct($month = null, $name = null, $course = null, $study_program = null)
    {
        $this->month = $month ?? Carbon::now()->format('Y-m');
        $this->name = $name;
        $this->course = $course;
        $this->study_program = $study_program;
    }

    public function collection()
    {
        try {
            $start_date = Carbon::createFromFormat('Y-m', $this->month)->startOfMonth()->toDateString();
            $end_date = Carbon::createFromFormat('Y-m', $this->month)->endOfMonth()->toDateString();
        } catch (\Exception $e) {
            return collect([]);
        }

        $studentsQuery = User::where('role', 'student')->with([
            'courses.course:id,name,slug',
            'leaves' => function ($query) use ($start_date, $end_date) {
                $query->whereDate('start', '<=', $end_date)
                    ->whereDate('end', '>=', $start_date);
            }
        ]);

        if ($this->name) {
            $studentsQuery->where('name', 'LIKE', '%' . $this->name . '%');
        }

        if ($this->course) {
            $studentsQuery->whereHas('courses.course', function ($query) {
                $query->where('slug', 'LIKE', '%' . $this->course . '%');
            });
        }

        $students = $studentsQuery->get();
        $attendances = AttendanceStudent::whereBetween('date', [$start_date, $end_date])
            ->get()
            ->groupBy('user_id');

        $dates = collect(Carbon::parse($start_date)->daysUntil($end_date))->map(fn($date) => $date->toDateString());
        $dailyPresentCount = array_fill(0, $dates->count(), 0);

        $data = $students->map(function ($student) use ($attendances, $dates, &$dailyPresentCount) {
            $userAttendances = $attendances->get($student->id, collect());

            $leaveDates = collect();
            foreach ($student->leaves as $leave) {
                $leavePeriod = collect(Carbon::parse($leave->start)->daysUntil($leave->end))->map(fn($date) => $date->toDateString());
                $leaveDates = $leaveDates->merge($leavePeriod);
            }

            $attendanceStatus = $dates->mapWithKeys(function ($date, $index) use ($userAttendances, $leaveDates, &$dailyPresentCount) {
                if ($leaveDates->contains($date)) {
                    return [$date => 'I'];
                }
                $attendance = $userAttendances->firstWhere('date', $date);
                if ($attendance) {
                    $dailyPresentCount[$index]++;
                    return [$date => 'H'];
                }
                return [$date => 'A'];
            });

            return [
                'user_name' => $student->name,
                'class' => $student->courses->first()->course->name ?? '-',
                'attendance' => $attendanceStatus->values()->toArray(),
                'summary' => [
                    'hadir' => $attendanceStatus->filter(fn($status) => $status === 'H')->count(),
                    'sakit' => 0,
                    'ijin' => $attendanceStatus->filter(fn($status) => $status === 'I')->count(),
                    'alfa' => $attendanceStatus->filter(fn($status) => $status === 'A')->count(),
                ],
            ];
        });

        $dstRow = [
            'user_name' => 'Dst',
            'class' => '',
            'attendance' => $dailyPresentCount,
            'summary' => ['hadir' => '', 'sakit' => '', 'ijin' => '', 'alfa' => ''],
        ];

        $totalRow = [
            'user_name' => 'Total',
            'class' => '',
            'attendance' => array_fill(0, $dates->count(), ''),
            'summary' => [
                'hadir' => $data->sum(fn($student) => $student['summary']['hadir']),
                'sakit' => 0,
                'ijin' => $data->sum(fn($student) => $student['summary']['ijin']),
                'alfa' => $data->sum(fn($student) => $student['summary']['alfa']),
            ],
        ];

        return $data->push($dstRow)->push($totalRow);
    }

    public function map($student): array
    {
        return array_merge(
            [$student['user_name'], $student['class']],
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
        $start_date = Carbon::createFromFormat('Y-m', $this->month)->startOfMonth();
        $end_date = Carbon::createFromFormat('Y-m', $this->month)->endOfMonth();
        $dates = collect(Carbon::parse($start_date)->daysUntil($end_date))->map(fn($date) => $date->format('d/m/Y'))->toArray();

        return [
            array_merge(['Nama Siswa', 'Kelas'], array_fill(0, count($dates), 'Tanggal'), ['Total']),
            array_merge(['', ''], $dates, ['Hadir', 'Sakit', 'Ijin', 'Alfa'])
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
                'startColor' => ['argb' => 'FFC000'],
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
