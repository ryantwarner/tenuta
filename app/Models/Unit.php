<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    public function availability() {
        return $this->hasOne('App\Models\Unit\Availability');
    }
    
    public function location() {
        return $this->belongsTo('App\Models\Location');
    }
    
    public static function getAvailableUnitsInBounds($north, $east, $south, $west) {
        return self::has('availability')->whereHas('location', function($location) use ($north, $east, $south, $west) {
            $location->whereBetween('lat', [$south, $north])->whereBetween('lng', [$east, $west]);
        })->with('location');
    }
}
