<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    public function units() {
        return $this->hasMany('App\Models\Unit');
    }
}
