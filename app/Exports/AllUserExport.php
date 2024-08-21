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

class AllUserExport implements FromCollection, WithHeadings, WithMapping
{
    protected $query;

    public function __construct($query = null)
    {
        $this->query = $query;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $querys = User::query()->where('role', 'like', '%Student%');

        if ($this->query) {
            // Filter berdasarkan nama pengguna
            $querys->whereHas('user', function ($q) {
                $q->where('role', 'like', '%' . $this->query . '%');
            });
        }

        return $querys->get();
    }

    /**
     * Xls Mapping for relationship data get
     *
     * @return \Illuminate\Support\Collection
     */
    public function map($query): array
    {
        return [
            $query->id,
            $query->name, // assuming you have a relationship 'user' in Attendance model
            $query->username,
            $query->email,
            $query->phone,
            $query->role,
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
            'Phone',
            'Role',
        ];
    }
}
