<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Notice;
use Illuminate\Http\Request;

class NoticeController extends Controller
{
    public function index(Request $request)
    {
        // Mendapatkan role dari pengguna yang sedang login
        $userRole = $request->user()->role;

        // Mengambil semua notices berdasarkan role pengguna yang sedang login
        $notices = Notice   ::where('roles', $userRole)->get();

        // Mengembalikan data notices sebagai respon JSON
        return response()->json($notices);
    }
}
