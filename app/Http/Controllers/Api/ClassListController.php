<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Api\ClassList;
use Illuminate\Http\Request;

class ClassListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $classLists = ClassList::withCount('studentLists')
            ->get(['id', 'name']);

        $result = $classLists->map(function($classList) {
            return [
                'id' => $classList->id,
                'name' => $classList->name,
                'student_count' => $classList->student_lists_count,
            ];
        });

        return response()->json($result);
    }

    /**
     * Display the specified class with its students.
     *
     * @param  int  $class_list_id
     * @return \Illuminate\Http\Response
     */
    public function show($class_list_id)
    {
        $classList = ClassList::with('studentLists.student')
            ->findOrFail($class_list_id);

        $students = $classList->studentLists->map(function($studentList) {
            return [
                'id' => $studentList->student->id,
                'name' => $studentList->student->name,
            ];
        });

        $result = [
            'class_id' => $classList->id,
            'class_name' => $classList->name,
            'students' => $students,
        ];

        return response()->json($result);
    }
}
