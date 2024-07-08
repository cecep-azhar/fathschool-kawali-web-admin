<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Api\ClassList;
use App\Models\Course;
use App\Models\User;
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
        // Ambil semua course
        $courses = Course::all();

        // Map hasil untuk menyesuaikan format dan menghitung jumlah pengguna
        $result = $courses->map(function($course) {
            // Hitung jumlah pengguna yang terdaftar di course tertentu
            $userCount = User::active()->student()->whereHas('courses', function($query) use ($course) {
                $query->where('course_id', $course->id);
            })->count();

            return [
                'id' => $course->id,
                'name' => $course->name,
                'total_users' => $userCount,
            ];
        });

        // Kembalikan sebagai respons JSON
        return response()->json($result);
    }





    public function show($courseId)
    {
        // Ambil course berdasarkan courseId
        $course = Course::find($courseId);

        // Jika course tidak ditemukan, kembalikan respons error
        if (!$course) {
            return response()->json(['error' => 'Course not found'], 404);
        }

        // Ambil pengguna yang terdaftar di course tertentu
        $users = User::active()->student()->whereHas('courses', function($query) use ($courseId) {
            $query->where('course_id', $courseId);
        })->get();

        // Map hasil untuk menyesuaikan format
        $usersResult = $users->map(function($user) {
            return [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
            ];
        });

        // Buat hasil akhir yang menyertakan data course dan pengguna
        $result = [
            'course' => [
                'id' => $course->id,
                'name' => $course->name
            ],
            'users' => $usersResult,
        ];

        // Kembalikan sebagai respons JSON
        return response()->json($result);
    }



}
