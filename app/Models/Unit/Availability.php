<?php

namespace App\Models\Unit;

use Illuminate\Database\Eloquent\Model;

class Availability extends Model
{
    
    public function unit() {
        return $this->hasOne('App\Models\Unit');
    }
}
