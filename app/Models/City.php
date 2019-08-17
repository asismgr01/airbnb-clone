<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $fillable=['city','status','image','summary'];

    public function getRules($option='add'){
        return [
        	'city' => 'required|string',
        	'status' => 'required|in:active,inactive',
        	'summary' => 'nullable|string',
        	'image' => (($option == 'add') ? 'required' : 'sometimes').'|image|max:5000|dimensions:min_width=1200,min_height= 1486'
        ];
    }

    public function getCity(){
    	$array=array();
    	$city=$this->get();
    	foreach ($city as $key => $value) {
    		$array[$value->city]=$value->city;
    	}
    	return $array;
    }
    public function getCityFront(){
        $array=array();
        $city = $this->get();
        foreach ($city as $key => $value) {
            $array[$key]['city']=$value->city;
            $array[$key]['image'] = $value->image;
        }
        return $array;
    }
}
