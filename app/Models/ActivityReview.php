<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ActivityReview extends Model
{
    protected $fillable = ['name','user_id','activity_id','rate','review','status'];

    public function getRules(){
    	return [
            'name' => 'nullable|string',
            'email' => 'nullable|email',
            'review' => 'required|string',
            'rate' => 'nullable|numeric',
            //'activity_id' => 'required|exists:activity_reviews,id'
    	];
    }
    public function user(){
    	return $this->hasOne('App\User','id','user_id');
    }
    public function activity(){
        return $this->hasOne('App\Models\Activity','id','activity_id');
    }
}
