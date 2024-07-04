<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Api\PermissionAttendance;

class PermissionController extends Controller
{

    public function index(Request $request)
    {
        $School = PermissionAttendance::where('user_id', $request->user()->id)->orderBy('id', 'desc')->get();

        if ($School) {
            return response()->json($School, 200);
        } else {
            return response()->json(['message' => 'School not found'], 404);
        }
    }

    //create
    public function store(Request $request)
    {
        $request->validate([
            'date' => 'required',
            'reason' => 'required',
        ]);

        $permission = new PermissionAttendance();
        $permission->user_id = $request->user()->id;
        $permission->date_permission = $request->date;
        $permission->reason = $request->reason;
        $permission->is_approved = 0;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $image->storeAs('public/permissions', $image->hashName());
            $permission->image = $image->hashName();
        }

        $permission->save();

        return response()->json(['message' => 'Permission created successfully'], 201);
    }
}
