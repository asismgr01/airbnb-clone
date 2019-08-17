<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
	protected $fillable=['title','room_type','size','beds','price','discount','hotel_id','added_by','status','summary','room_details'];
    public function getRules(){
    	return [
            'title' => 'required|string',
    		'hotel_id' => 'required|exists:hotels,id',
    		'room_type' => 'required|in:single,double,triple,quad,queen,king',
    		'size' => 'required|string',
    		'beds' => 'required|string',
    		'price' => 'required|numeric|min:0',
    		'discount' => 'nullable|numeric|min:0|max:100',
    		'summary' => 'nullable|string',
    		'status' => 'required|in:available,unavailable',
    		'room_details' => 'required|string',
            'image.*' => 'sometimes|image|max:5000|dimensions:min_width=300'
    	];
    }
    public function hotel_info(){
        return $this->hasOne('App\Models\Hotel','id','hotel_id');
    }
    /*public function room_images(){
        return $this->hasMany('App\Models\RoomImages','room_id','id');
    }*/
    public function getAllRooms(){
        return $this->where('added_by',request()->user()->id)->get();
    }
    public function getRoomById($id){
        return $this->where('hotel_id',$id)->get();
    }

    public function room_images(){
        return $this->hasMany('App\Models\RoomImages', 'room_id', 'id');
    }

    public function getRoomByRoomid($id){
        return $this->with('room_images')->find($id);
    }
    
    public function getRoomsFront($id){
        $array=array();
        $data=$this->where(['hotel_id'=>$id, 'status'=>'available'])->get();
        //dd($data);
        foreach ($data as $key => $value) {
            $array[] = $value;
        }
        //dd($array);
        return $array;
    }
}
