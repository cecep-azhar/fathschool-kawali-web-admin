<?php

namespace App\Exports;

use App\Models\Attendance;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithEvents;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;
use Maatwebsite\Excel\Events\AfterSheet;

class TeacherExport implements FromCollection, WithHeadings, WithMapping, WithStyles, WithEvents
{
    protected $start_date;
    protected $end_date;
    protected $name;
    protected $study_program;
    protected $data;

    public function __construct($start_date = null, $end_date = null, $name = null, $study_program = null)
    {
        $this->start_date = $start_date ?? Carbon::now()->startOfMonth()->toDateString();
        $this->end_date = $end_date ?? Carbon::now()->endOfMonth()->toDateString();
        $this->name = $name;
        $this->study_program = $study_program;
    }

    public function collection()
    {
        try {
            $start = Carbon::parse($this->start_date);
            $end = Carbon::parse($this->end_date);
        } catch (Exception $e) {
            return collect([]);
        }

        $dates = collect($start->daysUntil($end))->map(fn($d) => $d->toDateString());

        $teachersQuery = User::where('role', 'teacher')->with(['department.study_program', 'leaves']);

        if ($this->name) {
            $teachersQuery->where('name', 'LIKE', '%' . trim($this->name) . '%');
        }

        if ($this->study_program) {
            $teachersQuery->whereHas('department.study_program', function ($query) {
                $query->where('slug', 'LIKE', '%' . $this->study_program . '%');
            });
        }

        $teachers = $teachersQuery->get();

        $attendances = Attendance::whereBetween('date', [$start->toDateString(), $end->toDateString()])
            ->get()
            ->groupBy('user_id');

        $this->data = $teachers->map(function ($teacher, $index) use ($dates, $attendances) {
            $userAttendances = $attendances->get($teacher->id, collect());

            $leaveDates = collect();
            foreach ($teacher->leaves as $leave) {
                $period = collect(Carbon::parse($leave->start)->daysUntil($leave->end))
                    ->map(fn($d) => $d->toDateString());
                $leaveDates = $leaveDates->merge($period);
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
                'user_name' => $teacher->name,
                'study_program' => $teacher->department->study_program->name ?? '-',
                'attendance' => $attendanceStatus->values()->toArray(),
                'summary' => [
                    'hadir' => $attendanceStatus->filter(fn($s) => $s === 'H')->count(),
                    'sakit' => 0,
                    'ijin' => $attendanceStatus->filter(fn($s) => $s === 'I')->count(),
                    'alfa' => $attendanceStatus->filter(fn($s) => $s === 'A')->count(),
                ],
            ];
        });

        return $this->data;
    }

    public function map($row): array
    {
        return array_merge(
            [$row['no'], $row['user_name'], $row['study_program']],
            $row['attendance'],
            [
                (int) $row['summary']['hadir'],
                (int) $row['summary']['sakit'],
                (int) $row['summary']['ijin'],
                (int) $row['summary']['alfa'],
            ]
        );
    }

    public function headings(): array
    {
        $start = Carbon::parse($this->start_date);
        $end = Carbon::parse($this->end_date);
        $dates = collect($start->daysUntil($end))->map(fn($date) => $date->format('d/m/Y'))->toArray();

        return array_merge(
            ['No', 'Nama Guru', 'Program Studi'],
            $dates,
            ['Hadir', 'Sakit', 'Ijin', 'Alfa']
        );
    }

    public function styles(Worksheet $sheet)
    {
        $colCount = count($this->headings());
        $lastCol = Coordinate::stringFromColumnIndex($colCount);

        $sheet->getStyle("A1:{$lastCol}1")->applyFromArray([
            'font' => ['bold' => true],
            'alignment' => ['horizontal' => 'center', 'vertical' => 'center'],
        ]);

        $highestRow = $sheet->getHighestRow();
        $sheet->getStyle("A1:{$lastCol}{$highestRow}")->applyFromArray([
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
            ],
        ]);

        foreach (range(1, $colCount) as $i) {
            $colLetter = Coordinate::stringFromColumnIndex($i);
            $sheet->getColumnDimension($colLetter)->setAutoSize(true);
        }

        return [];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $sheet = $event->sheet;

                $totalHadir = $this->data->sum(fn($row) => $row['summary']['hadir']);
                $totalIjin = $this->data->sum(fn($row) => $row['summary']['ijin']);
                $totalAlfa = $this->data->sum(fn($row) => $row['summary']['alfa']);

                $startRow = $this->data->count() + 3;
                $sheet->setCellValue("B{$startRow}", "Total Kehadiran: {$totalHadir}");
                $sheet->setCellValue("B" . ($startRow + 1), "Total Izin: {$totalIjin}");
                $sheet->setCellValue("B" . ($startRow + 2), "Total Alfa: {$totalAlfa}");
            },
        ];
    }
}
