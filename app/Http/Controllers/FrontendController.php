<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\City;
use App\Models\Hotel;
use App\Models\ActivityCategory;
use App\Models\HotelImage;
use App\Models\Activity;
use App\Models\ActivityImages;
use App\Models\Room;
use App\Models\Order;
use App\Models\HotelReview;
use App\Models\ActivityReview;
use App\Models\RoomBooking;

class FrontendController extends Controller
{
    protected $city = null;
    protected $hotel = null;
    protected $activity_cat = null;
    protected $hotel_image = null;
    protected $activity = null;
    protected $room = null;
    protected $activity_images = null;
    protected $order = null;
    protected $hotel_review = null;
    protected $activityreview = null;
    protected $roombooking = null;

    public function __construct(City $city,Hotel $hotel,ActivityCategory $activity_cat,HotelImage $hotel_image,Activity $activity,Room $room,ActivityImages $activity_images,Order $order,HotelReview $hotel_review,ActivityReview $activityreview,RoomBooking $roombooking){
        $this->city=$city;
        $this->hotel=$hotel;
        $this->activity_cat=$activity_cat;
        $this->hotel_image=$hotel_image;
        $this->activity=$activity;
        $this->room=$room;
        $this->activity_images=$activity_images;
        $this->order=$order;
        $this->hotel_review = $hotel_review;
        $this->activityreview = $activityreview;
        $this->roombooking = $roombooking;
    }
    public function index(){
        $hotel=$this->hotel->where('status','active')->orderBy('id','DESC')->get();
        foreach ($hotel as $key => $value) {
            $count = $this->roombooking->where('hotel_id',$value->id)->count();
            $value->booking = $count;
        }
        $activity_cat=$this->activity_cat->where('status','active')->get();
        $activity=$this->activity->get();
        $activityimage=array();
        foreach ($activity as $key => $value) {
            $image=$this->activity_images->getActivityImages($value->id);
            $activityimage[] = $image;
        }
        $city = $this->city->getCityFront();
        foreach ($city as $key => $value) {
            $count = $this->roombooking->where('city',$value['city'])->count();
            $city[$key]['count'] = $count;
        }
    	return view('site.index')
              ->with('data',$city)
              ->with('hotel',$hotel)
              ->with('activity_cat',$activity_cat)
              ->with('activity',$activity)
              ->with('city',$city)
              ->with('activityimage',$activityimage);
    }
    public function product(){
    	return view('site.product');	
    }
    public function product_detail($slug){
        //$room = $this->room->getRoomsFront($hotel);
        //$hotel_images = $this->hotel_image->getHotelImages($hotel);
        $hotel = $this->hotel->getBySlug($slug);
        //dd($hotel);
        $room_images = array();
        foreach ($hotel[0]->rooms as $key => $value) {
            $images = $this->room->getRoomByRoomid($value['id']);
            $room_images[] = $images->room_images[0]->image;
        }
        $review = $this->hotel_review->where('hotel_id',$hotel[0]->id)->where('status','active')->get();
        //dd($room_images);
        if ($hotel) {
            return view('site.product-detail')
                        ->with('hotel',$hotel)
                        ->with('room_images',$room_images)
                        /*->with('hotel_images',$hotel_images)
                        ->with('rooms',$room)*/
                        ->with('review',$review);
        }else{
            return redirect()->back();
        }
    }
    public function about(){
    	return view('site.about');
    }
    public function contact(){
    	return view('site.contact');
    }
    public function product_list(){
    	return view('site.product-list');
    }
    public function shoping_cart(){
    	return view('site.shopping-cart');
    }
    public function show(Request $request)
    {

        $data = $this->room->getRoomByRoomid($request->room_id);
        if ($data->count()>0) {
            return response()->json(['success'=>true,'data'=> $data]);
        }
        else{
            return response()->json(['success'=>false,'data'=> $data]);
        }
    }
    /*
    public function ajaxcall(){
        $data = $this->room->get();
        if ($data->count()>0) {
            return response()->json(['success'=>true,'data'=> $data]);
        }
        else{
            return response()->json(['success'=>false,'data'=> $data]);
        }
    }*/
    public function wishlist(Request $request){
        $this->hotel = $this->hotel->find($request->hotel_id);
        dd($this->hotel);
    }
    public function register(){
        return view('site.register');
    }
    public function hotels(){
        $this->hotel = $this->hotel->orderBy('id','DESC')->get();
        $this->city = $this->city->get();
        foreach ($this->hotel as $key => $value) {
            $count = $this->roombooking->where('hotel_id',$value->id)->count();
            $value->booking = $count;
        }
        //dd($this->hotel);
        return view('site.hotels')->with('data',$this->city)
                                  ->with('hotel',$this->hotel);
    }
    public function experiences(){
        $this->activity_cat = $this->activity_cat->get();
        $activity = $this->activity->orderBy('id','DESC')->get();
        //dd($activity);
        foreach ($activity as $key => $value) {
           $activity[$key] = $this->activity->getById($value->id);
        }
        //dd($activity);
        return view('site.experiences')
                           ->with('activity_cat',$this->activity_cat)
                           ->with('activity',$activity);
    }
    public function experiences_detail($slug){
        $activity = $this->activity->getBySlug($slug);
        //dd($activity);
        $review = $this->activityreview->where('activity_id',$activity[0]->id)->where('status','active')->get();
        //dd($review);
        $review->count = $this->activityreview->where('activity_id',$activity[0]->id)->where('status','active')->count();
        //dd($review);
        //dd($this->activity);
        if ($this->activity) {
            return view('site.experiences-detail')
                ->with('activity',$activity)
                ->with('review',$review);
        }
        else{
            return redirect()->back();
        }
    }

    public function load_hotels(){
        $data = $this->hotel->orderBy('id','DESC')->get();
        if ($data->count() > 0) {
            return response()->json(['status'=>true,'data'=>$data]);
        }
        else{
            return response()->json(['status'=>false,'data'=>$data]);
        }
    }

    public function load_experiences(){
        $data = $this->activity->orderBy('id','DESC')->get();
        if ($data->count() > 0) {
            return response()->json(['status'=>true,'data'=>$data]);
        }
        else{
            return response()->json(['status'=>false,'data'=>$data]);
        }
    }
}
