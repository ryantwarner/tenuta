<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Unit;

class AvailabilitiesController extends Controller
{
    public function index(Request $request) {
        $availabilities = Unit::getAvailableUnitsInBounds($request->north, $request->east, $request->south, $request->west)->paginate(config('app.units_per_page'));
        
        return response()->json($availabilities);
    }
}
