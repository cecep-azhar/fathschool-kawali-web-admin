<?php

namespace App\Exports;

use App\Models\User;
use App\Models\Attendance;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;

class TeacherExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize, WithStyles
{
    protected $month;

    public function __construct($month)
    {
        $this->month = $month;
    }

    public function collection()
    {
        $start_date = Carbon::createFromFormat('Y-m', $this->month)->startOfMonth()->toDateString();
        $end_date = Carbon::createFromFormat('Y-m', $this->month)->endOfMonth()->toDateString();
        $dates = collect(Carbon::parse($start_date)->daysUntil($end_date))->map(fn($date) => $date->toDateString());

        $teachers = User::where('role', 'teacher')->with(['department.study_program', 'leaves'])->get();
        $attendances = Attendance::whereBetween('date', [$start_date, $end_date])->get()->groupBy('user_id');

        return $teachers->map(function ($teacher) use ($dates, $attendances) {
            $userAttendances = $attendances->get($teacher->id, collect());

            $leaveDates = collect();
            foreach ($teacher->leaves as $leave) {
                $leavePeriod = collect(Carbon::parse($leave->start)->daysUntil($leave->end))
                    ->map(fn($date) => $date->toDateString());
                $leaveDates = $leaveDates->merge($leavePeriod);
            }

            $attendanceStatus = $dates->mapWithKeys(function ($date) use ($userAttendances, $leaveDates) {
                if ($leaveDates->contains($date)) {
                    return [$date => 'Ijin'];
                }
                $attendance = $userAttendances->firstWhere('date', $date);
                return [$date => $attendance ? 'Hadir' : 'Alfa'];
            });

            $totalHadir = $attendanceStatus->filter(fn($status) => $status === 'Hadir')->count();
            $totalAlfa = $attendanceStatus->filter(fn($status) => $status === 'Alfa')->count();
            $totalIjin = $attendanceStatus->filter(fn($status) => $status === 'Ijin')->count();
            $totalSakit = 0;

            return collect([
                'name' => $teacher->name,
                'study_program' => $teacher->department->study_program->name ?? '-',
            ])->merge($attendanceStatus)->merge([
                'total_hadir' => $totalHadir,
                'total_sakit' => $totalSakit,
                'total_ijin' => $totalIjin,
                'total_alfa' => $totalAlfa,
            ]);
        });
    }

    public function headings(): array
    {
        $month = Carbon::createFromFormat('Y-m', $this->month);
        $dates = collect(Carbon::parse($month->startOfMonth())->daysUntil($month->endOfMonth()))
            ->map(fn($date) => $date->format('d/m/Y'));

        $firstRow = array_merge(
            ['Nama Guru', 'Program Studi'],
            ['Tanggal'],
            array_fill(0, count($dates) - 1, ''),
            ['Total']
        );

        $secondRow = array_merge(
            ['', ''],
            $dates->toArray(),
            ['Hadir', 'Sakit', 'Ijin', 'Alfa']
        );

        return [$firstRow, $secondRow];
    }

    public function map($row): array
    {
        return $row->toArray();
    }

    public function styles(Worksheet $sheet)
    {
        $highestColumnIndex = count($this->headings()[1]);
        $lastColumn = Coordinate::stringFromColumnIndex($highestColumnIndex);

        // Merge "Tanggal" di tengah
        $sheet->mergeCells("C1:{$lastColumn}1");
        $sheet->mergeCells("A1:A2");
        $sheet->mergeCells("B1:B2");

        // Merge "Total" agar rapi
        $totalStartColumn = Coordinate::stringFromColumnIndex($highestColumnIndex - 3);
        $sheet->mergeCells("{$totalStartColumn}1:{$lastColumn}1");

        // Styling header
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

        // Tambahkan border ke seluruh tabel
        $highestRow = $sheet->getHighestRow();
        $sheet->getStyle("A1:{$lastColumn}{$highestRow}")->applyFromArray([
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['argb' => '000000'],
                ],
            ],
        ]);

        // Atur lebar kolom otomatis
        foreach (range('A', $lastColumn) as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }
    }
}
