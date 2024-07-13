<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Course;
use App\Http\Controllers\Controller;


class StudentController extends Controller
{
    /**
     * Display the specified student.
     *
     * @param  int  $student_id
     * @return \Illuminate\Http\Response
     */
    public function show($student_id, $courseId)
    {
        // Find the course by ID
        $course = Course::find($courseId);
    
        // Find the specified student with related information
        $student = User::where('id', $student_id)
                       ->where('role', 'student')
                       ->with(['studentList', 'parents'])
                       ->firstOrFail();
    
        if (!$student) {
            return response()->json('User Not Found', 404);
        }
    
        // Get all students enrolled in the same course, ordered by name
        $students = User::where('role', 'student')
                        ->whereHas('courses', function($query) use ($courseId) {
                            $query->where('course_id', $courseId);
                        })
                        ->orderBy('name', 'asc')
                        ->get();
    
        // Find the position of the specified student within the ordered list
        $absence_number = $students->search(function ($item) use ($student) {
            return $item->id == $student->id;
        });
    
        // If the student is not found in the course, return a response with a message
        if ($absence_number === false) {
            return response()->json(['message' => 'Student Not Found'], 403);
        }
    
        // Prepare the student details with absence number
        $studentDetails = [
            'name' => $student->name,
            'address' => $student->address,
            'phone' => $student->phone,
            'id_reference' => $student->id_reference,
            'absence_number' => $absence_number + 1, // Add 1 because array index starts from 0
            'parents' => $student->parents->map(function($parent) {
                return [
                    'name' => $parent->name,
                    'phone' => $parent->phone,
                ];
            }),
        ];
    
        return response()->json([
            'student_details' => $studentDetails,
        ], 200);
    }    
    

    
}
