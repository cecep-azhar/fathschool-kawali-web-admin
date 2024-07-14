<?php

namespace App\Exports;

use App\Models\Attendance;
use App\Models\Course;
use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Illuminate\Support\Facades\DB;

class TeacherExport implements FromCollection, WithHeadings, WithMapping
{
    protected $name;
    protected $month;

    public function __construct($name = null, $month = null)
    {
        $this->name = $name;
        $this->month = $month;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $query = Attendance::query();

        if ($this->name) {
            // Filter berdasarkan nama pengguna
            $query->whereHas('user', function ($q) {
                $q->where('name', 'like', '%' . $this->name . '%');
            });
        }

        if ($this->month) {
            // Filter berdasarkan bulan
            $query->whereMonth('date', $this->month);
        }

        return $query->get();
    }

    /**
     * Xls Mapping for relationship data get
     *
     * @return \Illuminate\Support\Collection
     */
    public function map($attendance): array
    {
        return [
            $attendance->id,
            $attendance->user->name, // assuming you have a relationship 'user' in Attendance model
            $attendance->date,
            $attendance->time_in,
            $attendance->time_out,
            $attendance->latlon_in,
            $attendance->latlon_out,
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
            'Id',
            'Name',
            'Date',
            'Time In',
            'Time Out',
            'Latlon In',
            'Latlon Out',
        ];
    }
}
