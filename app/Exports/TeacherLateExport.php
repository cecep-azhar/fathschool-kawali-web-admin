<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use App\Models\Attendance;
use App\Models\Setting;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class TeacherLateExport implements FromCollection, WithHeadings, WithMapping
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
        // Get the settings for time_in
        $setting = Setting::first(); // Adjust based on how you get the setting
        $timeInSetting = Carbon::parse($setting->time_in);

        // Build the query
        $query = Attendance::with('user');

        // Filter based on teacher's name if provided
        if ($this->name) {
            $query->whereHas('user', function ($q) {
                $q->where('name', 'like', '%' . $this->name . '%');
            });
        }

        // Filter based on month if provided
        if ($this->month) {
            $query->whereMonth('date', '=', date('m', strtotime($this->month)))
                  ->whereYear('date', '=', date('Y', strtotime($this->month)));
        }

        // Get all filtered attendance data
        $attendances = $query->get()
            ->filter(function ($attendance) use ($timeInSetting) {
                $timeIn = Carbon::parse($attendance->time_in);
                return $timeIn > $timeInSetting;
            })
            ->map(function ($attendance) {
                return [
                    'name' => $attendance->user->name,
                    'time_in' => Carbon::parse($attendance->time_in)->format('H:i:s'),
                    'date' => Carbon::parse($attendance->date)->format('Y-m-d'),
                ];
            });

        // Convert to collection
        return collect($attendances);
    }

    public function map($attendance): array
    {
        return [
            $attendance['name'],
            $attendance['time_in'],
            $attendance['date'],
        ];
    }

    public function headings(): array
    {
        return [
            'Name',
            'Time In',
            'Date',
        ];
    }
}
