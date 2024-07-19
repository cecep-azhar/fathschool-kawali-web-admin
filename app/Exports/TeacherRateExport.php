<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use App\Models\Api\ClassAttendance;
use App\Models\ClassRoutine;
use App\Models\Course;
use App\Models\Rating;
use App\Models\Subject;
use Illuminate\Support\Facades\DB;

class TeacherRateExport implements FromCollection, WithHeadings, WithMapping
{
    protected $name;
    protected $month;

    public function __construct($name = null, $month = null)
    {
        $this->name = $name;
        $this->month = $month;
    }

    public function collection()
    {
        $query = Rating::query();

        if ($this->name) {
            // Filter berdasarkan nama guru
            $query->whereHas('teacher', function ($q) {
                $q->where('name', 'like', '%' . $this->name . '%');
            });
        }

        if ($this->month) {
            // Filter berdasarkan bulan (gunakan tanggal ISO untuk kompatibilitas database)
            $query->whereMonth('created_at', '=', date('m', strtotime($this->month)))
                  ->whereYear('created_at', '=', date('Y', strtotime($this->month)));
        }

        $teacherRatings = $query->with(['teacher:id,name', 'course:id,name'])
                                ->select('id', 'teacher_id', 'course_id', 'rating', 'comment', 'created_at')
                                ->get();

        // Mengubah struktur data untuk menambahkan informasi nama pengguna, nama teacher, dan nama course
        $teacherRatings->each(function ($rating) {
            $rating->teacher_name = $rating->teacher->name;
            $rating->course_name = $rating->course->name;
            $rating->created_date = $rating->created_at->format('Y-m-d'); // Format tanggal
            unset($rating->teacher); // Hapus relasi teacher setelah digunakan
            unset($rating->course); // Hapus relasi course setelah digunakan
            unset($rating->created_at); // Hapus original created_at setelah digunakan
        });

        return $teacherRatings;
    }


    public function map($attendance): array
    {
        return [
            $attendance->teacher_name,
            $attendance->course_name,
            $attendance->rating,
            $attendance->comment,
            $attendance->created_date,
        ];
    }

    public function headings(): array
    {
        return [
            'Name',
            'Class Name',
            'Rating',
            'Comment',
            'Date',
        ];
    }
}
