<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class ApiSchoolController extends Controller
{
    public function show()
    {
        $setting = Setting::find(1);
        return response(['setting' => $setting], 200);
    }

    public function showPhone()
    {
        // Ambil data setting dengan id 1
        $setting = Setting::find(1);

        // Jika data setting tidak ditemukan
        if (!$setting) {
            return response(['message' => 'Setting not found'], 404);
        }

        // Ambil data phone dari setting
        $phone = $setting->app_phone;

        // Kembalikan response dengan data phone
        return response(['Whatsapp' => $phone], 200);
    }

}
