<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use App\Models\Api\ClassAttendance;
use App\Models\ClassRoutine;
use App\Models\Course;
use App\Models\Subject;
use Illuminate\Support\Facades\DB;

class TeacherClassExport implements FromCollection, WithHeadings, WithMapping
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
        // Query data dari ClassAttendance dengan filter nama dan bulan
        $query = ClassAttendance::query();

        if ($this->name) {
            // Filter berdasarkan nama pengguna
            $query->whereHas('user', function ($q) {
                $q->where('name', 'like', '%' . $this->name . '%');
            });
        }

        if ($this->month) {
            // Filter berdasarkan bulan (gunakan tanggal ISO untuk kompatibilitas database)
            $query->whereMonth('date', '=', date('m', strtotime($this->month)));
            $query->whereYear('date', '=', date('Y', strtotime($this->month)));
        }

        // Ambil data yang difilter
        $teacherAttendances = $query
            ->with('user')
            ->select('class_attendances.*')
            ->join('class_routines', function ($join) {
                $join->on('class_attendances.user_id', '=', 'class_routines.teacher_id')
                     ->on('class_attendances.course_id', '=', 'class_routines.course_id');
            })
            ->get();

        // Ambil informasi tambahan seperti nama kelas dan mata pelajaran dari class_routines
        foreach ($teacherAttendances as $attendance) {
            $classRoutine = ClassRoutine::where('teacher_id', $attendance->user_id)
                ->where('course_id', $attendance->course_id)
                ->first();

            if ($classRoutine) {
                // Ambil informasi kelas dari model Course yang terhubung dengan ClassRoutine
                $course = Course::find($classRoutine->course_id);
                $attendance->class_name = $course ? $course->name : 'Nama Kelas Tidak Ditemukan';

                // Ambil informasi mata pelajaran dari model Subject yang terhubung dengan ClassRoutine
                $subject = Subject::find($classRoutine->subject_id);
                $attendance->subject_name = $subject ? $subject->name : 'Nama Mata Pelajaran Tidak Ditemukan';
            }
        }

        return $teacherAttendances;
    }

    public function map($attendance): array
    {
        return [
            $attendance->user->name,
            $attendance->class_name,
            $attendance->subject_name,
            $attendance->date,
            $attendance->time_in,
            $attendance->time_out,
        ];
    }

    public function headings(): array
    {
        return [
            'Name',
            'Class Name',
            'Subject',
            'Date',
            'Time In',
            'Time Out',
        ];
    }
}
