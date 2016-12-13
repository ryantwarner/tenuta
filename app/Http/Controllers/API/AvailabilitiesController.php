<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Unit;

class AvailabilitiesController extends Controller
{
    public function index(Request $request) {
        $availabilities = Unit::getAvailableUnitsInBounds($request->north, $request->east, $request->south, $request->west)->map(function ($unit) {
            return [
                'id' => $unit->id,
                'name' => $unit->name,
                'lat' => $unit->location->lat,
                'lng' => $unit->location->lng,
                'type' => 'farm'
            ];
        });
        
        return response()->json($availabilities);
    }
}
