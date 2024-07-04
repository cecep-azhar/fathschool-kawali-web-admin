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
}
