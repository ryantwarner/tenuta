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
}
