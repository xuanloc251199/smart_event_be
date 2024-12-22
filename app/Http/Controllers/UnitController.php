<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Unit;

class UnitController extends Controller
{
    public function getUnits()
    {
        try {
            $units = Unit::select('id', 'full_name', 'abbreviation')->get();

            return response()->json([
                'success' => true,
                'data' => $units,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch units.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
