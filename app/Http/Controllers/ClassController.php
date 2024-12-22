<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ClassModel;


class ClassController extends Controller
{
    public function index()
    {
        $classes = ClassModel::all(['id', 'class_name', 'faculty_id']);
        return response()->json($classes);
    }

    public function getClasses($faculty_id)
    {
        try {
            $classes = ClassModel::where('faculty_id', $faculty_id)
                ->select('id', 'class_name', 'faculty_id')
                ->get();

            if ($classes->isEmpty()) {
                return response()->json([
                    'success' => false,
                    'message' => 'No classes found for the given faculty ID.',
                    'data' => []
                ], 404);
            }

            return response()->json([
                'success' => true,
                'data' => $classes,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch classes.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
