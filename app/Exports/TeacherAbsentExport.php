<?php

namespace App\Exports;

use App\Models\Attendance;
use App\Models\Setting;
use App\Models\User;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class TeacherAbsentExport implements FromCollection, WithHeadings, WithMapping, WithStyles
{
    protected $name;
    protected $month;
    protected $study_program;

    public function __construct($name = null, $month = null, $study_program = null)
    {
        $this->name = $name;
        $this->month = $month;
        $this->study_program = $study_program;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $query = User::query()->whereNotIn('role', ['parent', 'student', 'admin', 'accountant']);

        if ($this->name) {
            $query->where('name', 'LIKE', '%' . $this->name . '%');
        }

        if ($this->month) {
            // Jika bulan diberikan, pastikan tidak ada kehadiran untuk bulan tersebut
            $query->whereDoesntHave('attendance', function ($q) {
                $q->whereDate('date', $this->month)
                    ->whereNotNull('time_in'); // Pastikan time_in ada (kehadiran)
            });
        } else {
            // Jika bulan tidak diberikan, ambil data tanpa mempertimbangkan kehadiran
            $query->whereDoesntHave('attendance');
        }

        if ($this->study_program) {
            $query->whereHas('courses.course.study_program', function ($q) {
                $q->where('slug', 'LIKE', '%' . $this->study_program . '%');
            });
        }

        // Ambil data user dengan relasi yang dibutuhkan
        $absents = $query->with(['leaves' => function ($q) {
            if ($this->month) {
                $q->whereDate('start', $this->month)
                    ->with('type');
            } else {
                $q->with('type');
            }
        }])->get();

        // Menambahkan properti `date` dan nomor urut pada setiap student
        $absents = $absents->map(function ($absent, $index) {
            $absent->date = $this->month ?? Carbon::today()->toDateString();
            $absent->number = $index + 1;
            return $absent;
        });

        return $absents;
    }

    /**
     * Xls Mapping for relationship data get
     *
     * @return \Illuminate\Support\Collection
     */
    public function map($absents): array
    {
        return [
            $absents->number,
            $absents->name, // assuming you have a relationship 'user' in Attendance model
            $absents->courses->pluck('course.study_program.name')->join(', '),
            $absents->date,
            $absents->leaves->pluck('type.name')->join(', ') ?? '-',
            $absents->leaves->pluck('status')->join(', ') ?? '-',
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
            'No',
            'Name',
            'Study Program',
            'Date',
            'Leave Type',
            'Status'
        ];
    }

    public function styles(Worksheet $sheet)
    {
        // Menyesuaikan ukuran font header
        $sheet->getStyle('A1:H1')->getFont()->setSize(15);  // Perbaikan untuk mencakup hingga kolom 'J'
        $sheet->getStyle('A1:H1')->getFont()->setBold(true);
        $sheet->getStyle('A1:H1')->getAlignment()->setHorizontal('center');

        // Menyesuaikan lebar kolom agar sesuai dengan konten
        foreach (range('A', 'H') as $columnID) {  // Memperbaiki untuk mencakup kolom 'J'
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }
    }
}
