<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Storage;

use App\Models\Unit;

class AvailabilitiesController extends Controller
{
    public function unit(Request $request) {
        $unit = Unit::with('location')->find($request->id);
        $images = collect(Storage::files("units/" . $request->id . "/images"))->map(function($filename) {
            return substr(
                $filename, 
                strripos($filename, "/") + 1, 
                strlen($filename)
            );
        });
//        $files = Files::where(['unit_id' => $request->id])->get(); @todo: make files happen
        $files = collect([]);
        return view('frontend.availabilities.unit')->with(['unit' => $unit, 'images' => $images, 'files' => $files]);
    }
    
    public function image(Request $request) {
        return response()->file(storage_path() . '/app/units/' . $request->id . '/images/' . $request->filename);
    }
    
    public function apply(Request $request) {
        return view('frontent.availabilities.apply');
    }
}
