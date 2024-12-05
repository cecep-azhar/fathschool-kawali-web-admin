<?php

namespace App\Exports;

use App\Models\AttendanceStudent;
use App\Models\Setting;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class StudentAttendanceExport implements FromCollection, WithHeadings, WithMapping
{
    protected $name;
    protected $month;
    protected $course;
    protected $study_program;

    public function __construct($name = null, $month = null, $course = null, $study_program = null)
    {
        $this->name = $name;
        $this->month = $month;
        $this->course = $course;
        $this->study_program = $study_program;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $query = AttendanceStudent::query();

        if ($this->name) {
            // Filter berdasarkan nama pengguna
            $query->whereHas('user', function ($q) {
                $q->where('name', 'like', '%' . $this->name . '%');
            });
        }

        if($this->month) {
            $query->whereDate('date', '=', date('Y-m-d', strtotime($this->month)));
        }

        if($this->course) {
            $query->whereHas('user.courses.course', function ($q) {
                $q->where('slug', 'LIKE', '%' . $this->course . '%');
            });
        }

        if($this->study_program) {
            $query->whereHas('user.courses.course.study_program', function ($q) {
                $q->where('slug', 'LIKE', '%' . $this->study_program . '%');
            });
        }

        $attendances = $query->get()->map(function ($attendance, $index) {
            $attendance->number = $index + 1;
            return $attendance;
        });

          // Ambil setting waktu 'time_in'
          $settingTimeIn = Setting::select(['time_in'])->first();

          // Cek apakah settingTimeIn ada dan time_in tidak kosong
          if ($settingTimeIn && $settingTimeIn->time_in) {
              // Parsing waktu dari settingTimeIn
              $settingTime = Carbon::createFromFormat('H:i:s', $settingTimeIn->time_in);

              // Loop untuk menghitung keterlambatan setiap attendance
              $attendances->map(function ($attendance) use ($settingTime) {
                  // Parsing waktu dari attendance
                  if ($attendance->time_in) {
                      $attendanceTime = Carbon::createFromFormat('H:i:s', $attendance->time_in);

                      // Jika waktu attendance lebih lambat dari setting time, hitung keterlambatan
                      if ($attendanceTime->greaterThan($settingTime)) {
                          // Hitung keterlambatan dalam menit
                          $latenessMinutes = $attendanceTime->diffInMinutes($settingTime);

                          // Setel keterlambatan dalam format teks "X minutes"
                          $attendance->lateness = $latenessMinutes . ' minute';
                      } else {
                          // Jika tidak terlambat, lateness 0
                          $attendance->lateness = '0 minute';
                      }
                  } else {
                      // Jika tidak ada time_in di attendance, set lateness sebagai 'Not Recorded'
                      $attendance->lateness = 'Not Recorded';
                  }

                  return $attendance;
              });
          } else {
              // Handle jika settingTimeIn tidak ada atau time_in kosong
              return response()->json(['error' => 'Setting time_in not found or invalid.'], 400);
          }

        // Kembalikan attendances dengan nomor urut dan lateness
        return $attendances;
    }


    /**
     * Xls Mapping for relationship data get
     *
     * @return \Illuminate\Support\Collection
     */
    public function map($attendances): array
    {
        return [
            $attendances->number,
            $attendances->user->name, // assuming you have a relationship 'user' in Attendance model
            $attendances->user->courses->pluck('course.study_program.name')->join(', '),
            $attendances->date,
            $attendances->time_in,
            $attendances->time_out,
            $attendances->lateness,
            $attendances->latlon_in,
            $attendances->latlon_out,
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
            'Time In',
            'Time Out',
            'Lateness',
            'Latlon In',
            'Latlon Out',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        // Menyesuaikan ukuran font header
        $sheet->getStyle('A1:I1')->getFont()->setSize(15);  // Perbaikan untuk mencakup hingga kolom 'J'
        $sheet->getStyle('A1:I1')->getFont()->setBold(true);
        $sheet->getStyle('A1:I1')->getAlignment()->setHorizontal('center');

        // Menyesuaikan lebar kolom agar sesuai dengan konten
        foreach (range('A', 'I') as $columnID) {  // Memperbaiki untuk mencakup kolom 'J'
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }
    }

}
