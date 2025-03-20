<?php

namespace App\Exports;

use App\Models\Attendance;
use App\Models\AttendanceStudent;
use App\Models\Course;
use App\Models\User;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Reader\Xml\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class AllAdministartionExport implements FromCollection, WithHeadings, WithMapping, WithColumnWidths, WithStyles
{
    protected $departement;
    private $index = 0; // Menyimpan nomor urut

    public function __construct($departement = null)
    {
        $this->departement = $departement;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $query = User::query()->where('role', 'like', '%Administration%');

        if ($this->departement) {
            $query->where('department', 'like', '%' . $this->departement . '%'); // ✅ Perbaiki filter departemen
        }

        return $query->get();
    }

    /**
     * Xls Mapping for relationship data get
     *
     * @return array
     */
    public function map($allteacher): array
    {
        $this->index++;

        return [
            $this->index,
            ' ' . ($allteacher->nik ?? '-'), // Tambahkan spasi di awal agar Excel membaca sebagai teks
            $allteacher->name ?? '-',
            $allteacher->date_of_birth ? Carbon::parse($allteacher->date_of_birth)->format('d-m-Y') : '-', // ✅ Format Tanggal dengan default "-"
            $allteacher->email ?? '-',
            $allteacher->phone ?? '-',
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
            'NO',
            'NIK',
            'Nama',
            'Tanggal Lahir',
            'Email',
            'Nomor Telepon',
        ];
    }

    /**
     * Mengatur lebar kolom agar tidak terlalu rapat
     */
    public function columnWidths(): array
    {
        return [
            'A' => 5,  // No
            'B' => 18, // NIK
            'C' => 25, // Name
            'D' => 15, // Tanggal Lahir
            'E' => 30, // Email
            'F' => 15, // Nomor Telepon
        ];
    }

    public function columnFormats(): array
    {
        return [
            'B' => NumberFormat::FORMAT_TEXT, // Pastikan kolom B (NIK) diperlakukan sebagai teks
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
