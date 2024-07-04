<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Api\School;
use Illuminate\Http\Request;

class ApiSchoolController extends Controller
{
    public function show()
    {
        $school = School::find(1);
        return response(['school' => $school], 200);
    }

    public function showPhone()
    {
        // Ambil data school dengan id 1
        $school = School::find(1);

        // Jika data school tidak ditemukan
        if (!$school) {
            return response(['message' => 'School not found'], 404);
        }

        // Ambil data phone dari school
        $phone = $school->phone;

        // Kembalikan response dengan data phone
        return response(['Whatsapp' => $phone], 200);
    }

}
