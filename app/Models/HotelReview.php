<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HotelReview extends Model
{
    protected $fillable= ['user_id','hotel_id','rate','review','status'];
    
    public function user_info(){
        return $this->hasOne('App\User','id', 'user_id');
    }
    public function hotel(){
        return $this->hasOne('App\Models\Hotel','id','hotel_id');
    }
    public function getRules(){
    	return [
            'hotel_id' => 'required|exists:hotels,id',
            'rate' => 'nullable|numeric',
            'review' => 'required|string',           
    	];
    }
}
