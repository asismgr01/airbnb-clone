<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    protected $fillable = ['title','description','link','status','banner','added_by'];

    public function getRules($option = 'add'){
    	return [
            'title' => 'nullable|string',
            'description' => 'nullable|string',
            'link' => 'nullable|url',
            'status' => 'required|in:active,inactive',
            'banner' => (($option == 'add') ? 'required' : 'sometimes').'|image|max:5000|dimensions:min_width=1900'
    	];
    }
    public function user(){
    	return $this->hasOne('App\User','id','user_id');
    }
}
