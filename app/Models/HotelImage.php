<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HotelImage extends Model
{
  public function getImageId($image){
  	 $array=array();
  	 foreach ($image as $key => $value) {
  	 	$id = $this->where('image',$value)->pluck('id');
  	 	$array[] = $id[0];
  	 }
  	 return $array;
  }
  public function getHotelImages($hotel){
  	$array=array();
  	$hotel_images=$this->where('hotel_id',$hotel)->get();
  	foreach ($hotel_images as $key => $value) {
  		 $array[]= $value->image;
  	}
  	return $array;
  }
}
