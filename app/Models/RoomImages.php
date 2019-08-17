<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RoomImages extends Model
{
    /*public function uploadRoomImages($image){
    	foreach ($image as $key => $value) {
    		$this->
    	}
    }
    public function room_images(){
    	return $this->hasOne('App\Models\Room','id','room_id');
    }*/
    public function getAllRoomImages(){
    	return $this->with(['room_images'])->get();
    }
    public function getRoomImagesByName($images){
        $room_images=array();
        foreach ($images as $key => $value) {
            $id=$this->where('image',$value)->pluck('id');
            $room_images[] = $id[0];
        }
        return $room_images;
    }

}
