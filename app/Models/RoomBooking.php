<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RoomBooking extends Model
{
    public function user(){
    	return $this->hasOne('App\User','id','user_id');
    }

    public function hotel(){
    	return $this->hasOne('App\Models\Hotel','id','hotel_id');
    } 

    public function room(){
    	return $this->hasOne('App\Models\Room','id','room_id');
    }
}
