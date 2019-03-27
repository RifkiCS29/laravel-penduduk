<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    public function persons(){
        return $this->hasMany("App\Person");
    }
}
