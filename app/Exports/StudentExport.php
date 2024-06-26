<?php

namespace App\Exports;

use App\Models\Course;
use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class StudentExport implements FromCollection, WithHeadings, WithMapping
{
    public $type;

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
            $students = $course->students()->get()->map(function ($q) {
                return $q->user_id;
            });

            return User::whereIn('id', $students)->get();
        }
    }

    /**
     * Xls Mapping for relationship data get
     *
     * @return \Illuminate\Support\Collection
     */
    public function map($student): array
    {
        return [
            $student->id,
            $student->name,
            $student->email,
            $student->gender,
            $student->date_of_birth,
            $student->crated_at,
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
            'Email',
            'Gender',
            'Date Of Birth',
            'Created At',
        ];
    }
}
