<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Jobs\ClearExpiredSecurityCodes;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @return void
     */
    protected function schedule(Schedule $schedule): void
    {
        // Tugas untuk mereset kolom 'is_spaced' menjadi 1 setiap minggu
        $schedule->call(function () {
            DB::table('class_routines')->update(['is_spaced' => 1]);
        })->weeklyOn(0, '23:59'); // Hari Minggu pukul 23:59

        // Tugas yang akan dijalankan setiap 5 menit
        $schedule->call(function () {
            $currentTimeForChecking = now();
            $endTimeForChecking = $currentTimeForChecking->copy()->addMinutes(6);

            // Periksa dan update jadwal
            DB::table('class_routines')
                ->whereBetween('start_time', [$currentTimeForChecking->format('H:i:s'), $endTimeForChecking->format('H:i:s')])
                ->update(['is_spaced' => 0]);

            // Ambil teacher_id yang memiliki jadwal dalam rentang 6 menit
            $teacherIds = DB::table('class_routines')
                ->whereBetween('start_time', [$currentTimeForChecking->format('H:i:s'), $endTimeForChecking->format('H:i:s')])
                ->pluck('teacher_id')
                ->unique(); // Mengambil ID unik

            // Ambil fcm_token untuk setiap teacher
            $fcmTokens = DB::table('users')
                ->whereIn('id', $teacherIds)
                ->whereNotNull('fcm_token')
                ->pluck('fcm_token');

            // Log atau proses fcm_token (contoh: logging untuk keperluan debugging)
            // Log::info('FCM Tokens:', $fcmTokens->toArray());
            foreach ($fcmTokens as $token) {
                Controller::sendNotificationToUser($token, 'Pemberitahuan', 'Ada jadwal kelas yang akan dimulai');
            }

            // Anda bisa menambahkan logika lain di sini, misalnya mengirim notifikasi
        })->everyFiveMinutes(); // Menjalankan setiap 5 menit
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }

    protected $routeMiddleware = [
        // ...
        'log.activity' => \App\Http\Middleware\LogActivity::class,
    ];

}
