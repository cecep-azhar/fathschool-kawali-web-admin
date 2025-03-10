<?php

namespace App\Exports;

use App\Models\AttendanceStudent;
use App\Models\User;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
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
        // 🔹 Ambil bulan dari constructor
        try {
            $start_date = Carbon::createFromFormat('Y-m', $this->month)->startOfMonth()->toDateString();
            $end_date = Carbon::createFromFormat('Y-m', $this->month)->endOfMonth()->toDateString();
        } catch (\Exception $e) {
            return collect([]); // Kosongkan data jika format bulan salah
        }

        // 🔹 Query awal untuk mendapatkan siswa berdasarkan bulan yang difilter
        $studentsQuery = User::where('role', 'student')->with([
            'courses.course:id,name',
            'leaves' => function ($query) use ($start_date, $end_date) {
                $query->whereDate('start', '<=', $end_date)
                    ->whereDate('end', '>=', $start_date);
            }
        ]);

        // 🔹 Eksekusi query setelah filter diterapkan
        $students = $studentsQuery->get();

        // 🔹 Ambil kehadiran hanya untuk bulan yang dipilih
        $attendances = AttendanceStudent::whereBetween('date', [$start_date, $end_date])
            ->get()
            ->groupBy('user_id');

        return $students->map(function ($student) use ($attendances, $start_date, $end_date) {
            $dates = collect(Carbon::parse($start_date)->daysUntil($end_date))->map(fn($date) => $date->toDateString());
            $userAttendances = $attendances->get($student->id, collect());

            // 🔹 Hitung total izin berdasarkan jumlah hari izin dalam rentang bulan
            $leaveDates = collect();
            foreach ($student->leaves as $leave) {
                $leavePeriod = collect(Carbon::parse($leave->start)->daysUntil($leave->end))->map(fn($date) => $date->toDateString());
                $leaveDates = $leaveDates->merge($leavePeriod);
            }

            // 🔹 Inisialisasi data kehadiran per hari dalam bulan
            $attendanceStatus = $dates->mapWithKeys(function ($date) use ($userAttendances, $leaveDates) {
                if ($leaveDates->contains($date)) {
                    return [$date => 'Ijin'];
                }
                $attendance = $userAttendances->firstWhere('date', $date);
                return [$date => $attendance ? 'Hadir' : 'Alfa'];
            });

            // 🔹 Hitung total hadir, alfa, dan izin
            $totalHadir = $attendanceStatus->filter(fn($status) => $status === 'Hadir')->count();
            $totalAlfa = $attendanceStatus->filter(fn($status) => $status === 'Alfa')->count();
            $totalIjin = $attendanceStatus->filter(fn($status) => $status === 'Ijin')->count();

            return collect([
                'user_name' => $student->name,
                'class' => $student->courses->first()->course->name ?? '-',
                'attendance' => $attendanceStatus->values()->toArray(),
                'summary' => [
                    'hadir' => $totalHadir,
                    'sakit' => 0,
                    'ijin' => $totalIjin,
                    'alfa' => $totalAlfa,
                ],
            ]);
        });
    }

    public function map($student): array
    {
        return array_merge(
            [
                $student['user_name'], // Nama Siswa
                $student['class'],     // Kelas
            ],
            $student['attendance'],  // Kehadiran harian
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
        // 🔹 Ambil tanggal berdasarkan bulan yang difilter
        $start_date = Carbon::createFromFormat('Y-m', $this->month)->startOfMonth();
        $end_date = Carbon::createFromFormat('Y-m', $this->month)->endOfMonth();

        $dates = collect(Carbon::parse($start_date)->daysUntil($end_date))->map(fn($date) => $date->format('d/m/Y'))->toArray();

        // 🔹 Header baris pertama (merge cell untuk tanggal)
        $firstRow = array_merge(
            ['Nama Siswa', 'Kelas'],  // Nama dan Kelas tetap di awal
            array_fill(0, count($dates), 'Tanggal'), // Semua tanggal di-merge di Excel
            ['Total'] // Merge untuk total (Hadir, Sakit, Ijin, Alfa)
        );

        // 🔹 Header baris kedua (tanggal harian)
        $secondRow = array_merge(
            ['', ''], // Kosong untuk "Nama Siswa" & "Kelas"
            $dates,  // List tanggal
            ['Hadir', 'Sakit', 'Ijin', 'Alfa'] // Total masing-masing kategori
        );

        return [$firstRow, $secondRow];
    }


    public function styles(Worksheet $sheet)
    {
        $totalColumns = count($this->headings()[1]); // Ambil jumlah kolom dari header kedua

        // Merge cell untuk header pertama
        $sheet->mergeCells("C1:" . $this->getExcelColumn($totalColumns - 4) . "1");
        $sheet->setCellValue("C1", "Tanggal"); // Isi teks di merge cell

        // Merge cell untuk kolom total
        $sheet->mergeCells($this->getExcelColumn($totalColumns - 3) . "1:" . $this->getExcelColumn($totalColumns) . "1");
        $sheet->setCellValue($this->getExcelColumn($totalColumns - 3) . "1", "Total Kehadiran");

        // Buat bold dan rata tengah
        $sheet->getStyle("A1:" . $this->getExcelColumn($totalColumns) . "2")->getFont()->setBold(true);
        $sheet->getStyle("A1:" . $this->getExcelColumn($totalColumns) . "2")->getAlignment()->setHorizontal('center');

        // Set auto-size untuk semua kolom
        for ($i = 1; $i <= $totalColumns; $i++) {
            $sheet->getColumnDimensionByColumn($i)->setAutoSize(true);
        }
    }

    private function getExcelColumn($number)
    {
        $letter = '';
        while ($number > 0) {
            $modulo = ($number - 1) % 26;
            $letter = chr(65 + $modulo) . $letter;
            $number = (int)(($number - $modulo) / 26);
        }
        return $letter;
    }
}
