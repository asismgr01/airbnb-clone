<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hotel;
use App\Models\HotelImage;
use App\Models\City;

class HotelController extends Controller
{
    protected $hotel=null;
    protected $hotel_images=null;
    protected $city=null;

    public function __construct(Hotel $hotel,HotelImage $hotelimage,City $city){
         $this->hotel=$hotel;     
         $this->hotel_images=$hotelimage;
         $this->city=$city;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data=$this->hotel->getHotels();
        $maps_add=array();
        foreach ($data as $key => $value) {
           $maps_add[$key]=str_replace(" ","%20",$data[$key]->hotel_name).'%20'.$data[$key]->address.'%20'.$data[$key]->city.'%20Nepal';   
        }
        //dd($maps_add);
        return view('vendor.hotel.index')->with('data',$data)->with('maps_add',$maps_add);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       $city=$this->city->getCity();
        return view('vendor.hotel.hotel-form')
                  ->with('title','add')
                  ->with('city',$city);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->request->add(['added_by'=> $request->user()->id]);
        //dd($request);
        $rules=$this->hotel->getRules('add');
        $request->validate($rules);
        
        $data=$request->all();
        $data['slug'] = $this->hotel->getSlug($data['hotel_name']);
        if ($request->image) {
            $filename=uploadImage($request->image,'hotel-thumbnails',285.25,191,'thumbnail');
            if ($filename) {
                $data['image']=$filename;
            }
            else{
                $data['image']=null;
            }
        }
        $this->hotel->fill($data);
        $success=$this->hotel->save();
        if ($success) { 
             //dd($request->images);
            if ($request->images){
                $filenames=uploadMultipleImages($request->images,'hotel-images',773,530);
                //dd($filenames);
                if (isset($filenames) && !empty($filenames)) {
                    foreach ($filenames as $key => $value) {
                        if ($filenames[$key]) {
                            $temp=array(
                                'image' => $filenames[$key],
                                'hotel_id' => $this->hotel->id
                            );
                            HotelImage::insert($temp);
                        }
                    }
                }
            } 
            setflash('success','Hotel successfully added.');
        }
        else{
            setflas('error','Hotel failed to add.');
        }
        return redirect()->route('hotel.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->hotel=$this->hotel->find($id);
        //dd($this->hotel);
        $city=$this->city->getCity();
        $hotel_images=$this->hotel->hotel_images;
        if($this->hotel){
            $data=$this->hotel;
            return view('vendor.hotel.hotel-form')
                        ->with('hotel_info',$data)
                        ->with('title','edit') 
                        ->with('hotel_images',$hotel_images)
                        ->with('city',$city);
        }
        else{
            return redirect()->route('hotel.index');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        /*$image_id=$request->checkbox;
        $array=array();
        foreach ($image_id as $key => $value) {
            $array[$key] = $this->hotel_images->find($image_id[$key]);   
        }
        dd($array);*/
    
        $this->hotel=$this->hotel->find($id);
        //dd($hotel->image);
        if ($this->hotel) {
            $rules=$this->hotel->getRules('edit');
            $request->validate($rules);

            $data=$request->all();
            if ($request->image) {
                $filename=uploadImage($request->image,'hotel-thumbnails',285.25,191,'thumbnail');
                if ($filename) {
                    $data['image']=$filename;
                    if(file_exists(public_path().'/uploads/hotel-thumbnails/'.$this->hotel->image))     {
                        unlink(public_path().'/uploads/hotel-thumbnails/'.$this->hotel->image);
                    }
                }
                else{
                    $data['image']=null;
                }
            }
            $this->hotel->fill($data);
            $success=$this->hotel->save();
            if ($success) { 
             //dd($request->images);
                if ($request->images){
                    $filenames=uploadMultipleImages($request->images,'hotel-images',773,530);
                    //dd($filenames);
                    if (isset($filenames) && !empty($filenames)) {
                        foreach ($filenames as $key => $value) {
                            if ($filenames[$key]) {
                                $temp=array(
                                    'image' => $filenames[$key],
                                    'hotel_id' => $this->hotel->id
                                );
                                HotelImage::insert($temp);
                            }
                        }
                    }
                }
                if (isset($request->checkbox) && !empty($request->checkbox)) {
                  $image=$this->hotel_images->getImageId($request->checkbox);
                    foreach ($request->checkbox as $key => $value) {
                        if (file_exists(public_path().'/uploads/hotel-images/'.$request->checkbox[$key])) {
                            unlink(public_path().'/uploads/hotel-images/'.$request->checkbox[$key]);
                            $this->hotel_images=$this->hotel_images->find($image[$key]);
                            if ($this->hotel_images) {
                                //dd($this->hotel_images);
                                 $this->hotel_images->delete();
                            }
                        }
                    }
                }  
                return redirect()->route('hotel.index');           
            }
        }
        else{
            echo "hotel not found.";
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->hotel=$this->hotel->find($id);
        $image = $this->hotel->image;
        $hotel_images=$this->hotel_images->getHotelImages($id);
        if ($this->hotel) {
            $del=$this->hotel->delete();
            if ($del) {
                if (file_exists(public_path().'/uploads/hotel-thumbnails/'.$image)) {
                      unlink(public_path().'/uploads/hotel-thumbnails/'.$image);
                      unlink(public_path().'/uploads/hotel-thumbnails/'.'thumbnail-'.$image);
                }
                if (isset($hotel_images) && !empty($hotel_images)) {
                     foreach ($hotel_images as $key => $value) {
                          if (file_exists(public_path().'/uploads/hotel-images/'.$hotel_images[$key])) {
                            unlink(public_path().'/uploads/hotel-images/'.$hotel_images[$key]);
                          }
                     }
                }
                setflash('success','Hotel successfully deleted.');
            }
        }
        else{
            setflash('error','Hotel failed to delete.');
        }
        return redirect()->route('hotel.index');
    }
    public function view(){
        $hotels=$this->hotel->getHotels();
        return view('vendor.hotel.view')->with('hotels',$hotels);
    }
    public function getsearch(Request $request){
        //dd($request);

        $this->hotel=$this->hotel->where('status','active')
                                 ->where(function($query){
                                    global $request;
                                    return $query->Where('hotel_name','LIKE','%'.$request->search.'%')->orWhere('summary','LIKE','%'.$request->search.'%')->orWhere('description','LIKE','%'.$request->search.'%');
                                 })->get();
        dd($this->hotel);
    }
}
