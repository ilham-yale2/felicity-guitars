<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Amplifier extends Model
{
    public function brand(){
        return $this->belongsTo('App\Brand');
    }
}
