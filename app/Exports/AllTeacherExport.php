<?php

namespace App\Exports;

use App\Models\Attendance;
use App\Models\AttendanceStudent;
use App\Models\Course;
use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Illuminate\Support\Facades\DB;

class AllTeacherExport implements FromCollection, WithHeadings, WithMapping
{
    protected $departement;

    public function __construct($departement = null)
    {
        $this->departement = $departement;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $query = User::query();

        if ($this->departement) {
            // Filter berdasarkan nama pengguna
            $query->whereHas('user', function ($q) {
                $q->where('role', 'like', '%' . $this->departement . '%');
            });
        }

        return $query->get();
    }

    /**
     * Xls Mapping for relationship data get
     *
     * @return \Illuminate\Support\Collection
     */
    public function map($allteacher): array
    {
        return [
            $allteacher->id,
            $allteacher->name, // assuming you have a relationship 'user' in Attendance model
            $allteacher->username,
            $allteacher->email,
            $allteacher->role,
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
            'Username',
            'Email',
            'Role',
        ];
    }
}
