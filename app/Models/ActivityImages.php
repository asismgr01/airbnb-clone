<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ActivityImages extends Model
{
	protected $fillable=['image','activity_id'];
    public function getActivityImagesId($images){
    	$array=array();
    	foreach ($images as $key => $value) {
    		$data=$this->where('image',$images[$key])->pluck('id');
    		$array[]=$data[0];
    	}
    	return $array;
    }
    public function activity(){
    	return $this->hasOne('App\Models\Activity','id','activity_id');
    }
    public function getActivityImages($id){
        $array = array();
        $data=$this->where('activity_id',$id)->get();
        foreach ($data as $key => $value) {
            $array[] = $value->image;
            break;
        }
        return $array;
    }
}
