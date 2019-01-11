<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReservationEvent extends Model
{
    public function department(){
    	return $this->belongsTo('App\Department');
    }

    public function room(){
    	return $this->belongsTo('App\Room');
    }
}
