<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DummyController extends Controller
{
    public function condition()
    {
        $data = [
            'airQuality' => 'Baik',
            'temperature' => '45°C',
            'humidity' => '75%',
            'rainfall' => '20mm',
            'waterQuality' => 'Bersih',
            'electricityEfficiency' => '90%',
            'lightingCondition' => 'Cukup',
            'deviceStatus' => [
                ['name' => 'Sensor Suhu', 'status' => 'Aktif'],
                ['name' => 'Sensor Kelembaban', 'status' => 'Aktif'],
                ['name' => 'Lampu Ruang Kelas', 'status' => 'Menyala'],
                ['name' => 'CCTV', 'status' => 'Aktif'],
                ['name' => 'Pompa Air', 'status' => 'Mati'],
            ],
            'warningSystem' => 'Normal',
            'history' => [
                ['date' => '25 Feb 2025', 'event' => 'Hujan Ringan'],
                ['date' => '24 Feb 2025', 'event' => 'Kualitas Udara Sedang'],
            ],
        ];

        return response()->json([
            'status' => 200,
            'message' => 'Success Menggambil Data Dummy Kondisi Sekolah',
            'data' => $data
        ], 200);
    }
}
