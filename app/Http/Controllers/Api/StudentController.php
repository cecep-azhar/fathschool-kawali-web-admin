<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Controllers\Controller;

class StudentController extends Controller
{
    /**
     * Display the specified student.
     *
     * @param  int  $student_id
     * @return \Illuminate\Http\Response
     */
    public function show($student_id)
    {
        $student = User::where('id', $student_id)
                       ->where('role', 'student')
                       ->with(['studentList', 'parents'])
                       ->firstOrFail();

        if (!$student) {
            return response()->json('User Not Found', 404);
        }

        $studentDetails = [
            'name' => $student->name,
            'address' => $student->address,
            'phone' => $student->phone,
            'id_reference' => $student->id_reference,
            'absence_number' => $student->studentList->absence_number,
            'parents' => $student->parents->map(function($parent) {
                return [
                    'name' => $parent->name,
                    'phone' => $parent->phone,
                ];
            }),
        ];

        if ($studentDetails) {
            return response()->json($studentDetails, 200);
        } else {
            return response()->json(['message' => 'Student Not Found'], 403);
        }
    }
}
