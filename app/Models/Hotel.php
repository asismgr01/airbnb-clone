<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Hotel extends Model
{
	protected $fillable=['hotel_name','summary','description','type','status','image','city','address','slug','added_by'];
    public function getRules($option='add'){
    	return[
    		'hotel_name' => 'required|string',
            'summary' => 'nullable|string',
            'description' => 'required|string',
    		'type' => 'required|in:small,medium,large,mega',
    		'status' => 'required|in:active,inactive',
    		'image' =>  (($option == 'add') ? 'required' : 'sometimes').'|image|max:5000|dimensions:min_width=300',
    		'city' => 'required|string',
    		'address' => 'required|string',
            'images.*' =>'sometimes|image|max:5000|dimensions:min_width=300'
    	];
    }
    public function getHotels(){
        return $this->where('added_by',request()->user()->id)->orderBy('hotel_name','ASC')->get();
    }
    public function hotel_images(){
        return $this->hasMany('App\Models\HotelImage','hotel_id','id');
    }
    /*public function getHotel($id){
        return $this->where('id',$id)->get();
    }*/
    public function booking(){
        return $this->hasMany('App\Models\RoomBooking','hotel_id','id');
    }
    public function rooms(){
        return $this->hasMany('App\Models\Room','hotel_id','id');
    }
    public function getByid($id){
        return $this->with('rooms')->find($id);
    }
    public function getBookings($id){
        return $this->with('booking')->find($id);
    }
    public function getBySlug($slug){
        return $this->with(['rooms','hotel_images'])->where('slug',$slug)->get();
    }
    public function getSlug($title){
        $slug = \Str::slug($title);

        $data = $this->where('slug',$slug.".html")->count();

        if ($data > 0) {
            $slug .= date('Ymdhms'); 
        }
        return $slug.".html";
    }
}
