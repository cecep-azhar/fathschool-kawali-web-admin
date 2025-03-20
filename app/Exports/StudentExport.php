<?php

namespace App\Exports;

use App\Models\Course;
use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Carbon\Carbon;

class StudentExport implements FromCollection, WithHeadings, WithMapping, WithColumnWidths, WithStyles
{
    public $type;
    private $index = 0; // Menyimpan nomor urut

    public function __construct($type)
    {
        $this->type = $type;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        if ($this->type == 'all') {
            return User::student()->get();
        } else {
            $course = Course::where('id', $this->type)->first();
            $students = $course->students()->pluck('user_id');

            return User::with('courses')->whereIn('id', $students)->get();
        }
    }

    /**
     * Xls Mapping for relationship data get
     *
     * @return array
     */
    public function map($student): array
    {
        $this->index++; // Menambah nomor urut

        $courseNames = $student->courses->first()->course->name ?? '-';

        return [
            $this->index,
            $student->nisn,
            $student->name,
            $courseNames,
            $student->email,
            $student->date_of_birth ? Carbon::parse($student->date_of_birth)->format('d-m-Y') : '', // Format Tanggal
            $student->phone,
            $student->gender,
        ];
    }

    /**
     * Xls Heading return
     *
     * @return array
     */
    public function headings(): array
    {
        return [
            'No',
            'NISN',
            'Nama',
            'Kelas',
            'Email',
            'Tanggal Lahir',
            'Nomor Telepon',
            'Jenis Kelamin',
        ];
    }

    /**
     * Mengatur lebar kolom agar tidak terlalu rapat
     */
    public function columnWidths(): array
    {
        return [
            'A' => 5,  // No
            'B' => 15, // NISN
            'C' => 25, // Name
            'D' => 15, // Kelas
            'E' => 25, // Email
            'F' => 15, // Tanggal Lahir
            'G' => 15, // Nomor Telepon
            'H' => 10, // Jenis Kelamin
        ];
    }

    /**
     * Mengatur gaya tampilan header
     */
    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true]], // Membuat header menjadi tebal
        ];
    }
}
