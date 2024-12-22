<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Unit;
use App\Models\Faculty;
use App\Models\ClassModel;
use App\Models\UserDetail;

class ProfileController extends Controller
{
    // Lấy danh sách Units
    public function getUnits()
    {
        $units = Unit::select('id', 'abbreviation')->get();
        return response()->json($units);
    }

    // Lấy danh sách Faculties theo Unit
    public function getFaculties(Request $request)
    {
        $unitId = $request->query('unitId');
        if (!$unitId) {
            return response()->json(['error' => 'unitId is required'], 400);
        }

        $faculties = Faculty::where('unit_id', $unitId)
            ->select('id', 'faculty as name')
            ->get();
        return response()->json($faculties);
    }

    // Lấy danh sách Classes theo Faculty
    public function getClasses(Request $request)
    {
        $facultyId = $request->query('facultyId');
        if (!$facultyId) {
            return response()->json(['error' => 'facultyId is required'], 400);
        }

        $classes = ClassModel::where('faculty_id', $facultyId)
            ->select('id', 'class_name')
            ->get();
        return response()->json($classes);
    }

    // Cập nhật thông tin User
    public function updateUser(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:user_details,user_id',
            'unit_id' => 'nullable|exists:units,id',
            'faculty_id' => 'nullable|exists:faculties,id',
            'class_id' => 'nullable|exists:classes,id',
        ]);

        $userDetail = UserDetail::where('user_id', $validated['user_id'])->first();

        if (!$userDetail) {
            return response()->json(['error' => 'User not found'], 404);
        }

        $userDetail->update([
            'unit_id' => $validated['unit_id'] ?? $userDetail->unit_id,
            'faculty_id' => $validated['faculty_id'] ?? $userDetail->faculty_id,
            'class_id' => $validated['class_id'] ?? $userDetail->class_id,
        ]);

        return response()->json(['message' => 'User profile updated successfully']);
    }
}
