<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ActivityCategory extends Model
{
    protected $fillable=['category','status','image'];

    public function getRules($option='add'){
    	return[
    		'category' => 'required|string',
    		'status' => 'required|in:active,inactive',
    		'image' => (($option == 'add') ? 'required' : 'sometimes').'|image|max:5000|dimensions:min_width=300'
    	];
    }
    public function getActivityCategory(){
    	$array=array();
    	$data=$this->where('status','active')->get();
    	if ($data) {
    		foreach ($data as $key => $value) {
    			$array[$value->category]=$value->category;
    		}
    	}
    	return $array;
    }
}
