<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\LeaveType;
use App\Models\MobileSetting;
use App\Models\Setting;
use Illuminate\Http\Request;

class GetSettings extends Controller
{
    public function index(){
        $settings = Setting::get()->first();
        $mobile_settings = MobileSetting::get()->first();
        $leave_types = LeaveType::get();

        return response()->json([
            'status' => 200,
            'messages' => 'Succesfully Retrieved Data',
            'data' => [
                'app_phone' => $settings->app_phone,
                'location' => [
                    'radius' => $settings->radius,
                    'latitude' => $settings->latitude,
                    'longtitude' => $settings->longtitude
                ],
                'time_settings' => [
                    'time_in' => $settings->time_in,
                    'time_out' => $settings->time_out
                ],
                'mobile_settings' => [
                    'conclusion_apps' => $mobile_settings->conclusion_apps
                ],
                'types_leave' => $leave_types
            ]
        ], 200);
    }
}
