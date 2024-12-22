<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Faculty;

class FacultyController extends Controller
{
    public function index()
    {
        $faculties = Faculty::all(['id', 'faculty']);
        return response()->json($faculties);
    }

    public function getFaculties($unit_id)
    {
        try {
            $faculties = Faculty::where('unit_id', $unit_id)
                ->select('id', 'faculty', 'unit_id')
                ->get();

            if ($faculties->isEmpty()) {
                return response()->json([
                    'success' => false,
                    'message' => 'No faculties found for the given unit ID.',
                    'data' => []
                ], 404);
            }

            return response()->json([
                'success' => true,
                'data' => $faculties,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch faculties.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
