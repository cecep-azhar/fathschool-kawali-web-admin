<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\User; // Pastikan untuk mengimpor model User
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class ClassListController extends Controller
{
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
                'photo_url' => $course->photo_url, // Pastikan ada properti photo_url di model Course
                'total_users' => $userCount,
            ];
        });

        // Kembalikan sebagai respons JSON
        return response()->json($result);
    }

    public function store(Request $request)
    {
        // Validasi request untuk memastikan gambar ada dan valid
        $request->validate([
            'photo' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Buat instance baru dari model Course
        $course = new Course();

        // Ambil file gambar dari request
        $image = $request->file('photo');

        // Jika ada foto lama, hapus sebelum menyimpan yang baru
        if ($course->photo) {
            Storage::delete('public/images/' . $course->photo);
        }

        // Simpan gambar baru ke penyimpanan
        $path = $image->store('public/images');

        // Simpan nama file gambar ke dalam kolom 'photo' pada model Course
        $course->photo = basename($path);
        
        // Simpan instance Course ke database
        $course->save();

        // Kembalikan respons JSON dengan instance Course yang telah disimpan
        return response()->json($course, 201);
    }
    
    public function show($courseId)
    {
        // Ambil course berdasarkan courseId
        $course = Course::find($courseId);
    
        // Jika course tidak ditemukan, kembalikan respons error
        if (!$course) {
            return response()->json(['error' => 'Course not found'], 404);
        }
    
        // Ambil pengguna yang terdaftar di course tertentu dan urutkan berdasarkan nama
        $users = User::active()->student()->whereHas('courses', function($query) use ($courseId) {
            $query->where('course_id', $courseId);
        })->orderBy('name')->get();
    
        // Inisialisasi nomor absen
        $absenNumber = 1;
    
        // Map hasil untuk menyesuaikan format
        $usersResult = $users->map(function($user) use (&$absenNumber) {
            // Increment nomor absen
            $absen = $absenNumber;
            $absenNumber++;
    
            return [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'absen_number' => $absen,
            ];
        });
    
        // Buat hasil akhir yang menyertakan data course dan pengguna
        $result = [
            'course' => [
                'id' => $course->id,
                'name' => $course->name,
                'photo_url' => $course->photo_url, // Pastikan ada properti photo_url di model Course
            ],
            'users' => $usersResult,
        ];
    
        // Kembalikan sebagai respons JSON
        return response()->json($result);
    }
}
