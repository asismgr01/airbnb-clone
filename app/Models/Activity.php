<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\ActivityImages;

class Activity extends Model
{
	protected $fillable=['title','slug','summary','category','status','description','notice','duration','price','discount','city','added_by'];
    
    public function getRules(){
    	return [
            'title' => 'required|string',
            'summary' => 'nullable|string',
            'category' => 'required|string',
            'status' => 'required|string',
            'description' => 'required|string',
            'notice' => 'nullable|string',
            'duration' => 'required|string',
            'price' => 'required|numeric|min:0',
            'discount' => 'nullable|numeric|min:0|max:100',
            'city' => 'required|string',
            'images.*' => 'sometimes|image|max:5000|dimensions:min_width=300'
    	];
    }
    public function getActivities(){
        return $this->where('added_by',request()->user()->id)->orderBy('title','ASC')->get();
    }
    public function activity_images(){
        return $this->hasMany('App\Models\ActivityImages','activity_id','id');
    }
    public function host(){
        return $this->hasOne('App\User','id','added_by');
    }
    public function getById($id){
        return $this->with('activity_images')->with('host')->find($id);
    }
    public function getActivityImages($id){
        $data=$this->with('activity_images')->with('user')->find($id);
        dd($data);
        $array=array();
        foreach ($data as $key => $value) {
             $array[] = $value->image; 
        }
        return $array;
    }
    public function getSlug($title){
        $slug = \Str::slug($title);

        $data = $this->where('slug',$slug.".html")->count();
        if ($data > 0) {
            $slug .= date('Ymdhms');
        }
        return $slug.".html";
    }
    public function getBySlug($slug){
        return $this->with(['activity_images','host'])->where('slug',$slug)->get();
    }
}
