<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    public $table = 'persons';
    
    public function region(){
        return $this->belongsTo("App\Region");
    }
}
