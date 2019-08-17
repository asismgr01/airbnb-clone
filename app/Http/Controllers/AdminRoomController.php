<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\RoomImages;
use App\Models\Hotel;

class AdminRoomController extends Controller
{
    protected $room=null;
    protected $room_images=null;
    protected $hotel=null;

    public function __construct(Room $room,RoomImages $room_images,Hotel $hotel){
        $this->room=$room;
        $this->room_images=$room_images;
        $this->hotel=$hotel;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data=$this->room->orderBy('title','ASC')->get();
        return view('admin.product.room.index')
                      ->with('data',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        $room_info=$this->room->find($id);
        foreach ($room_info as $key => $value) {
            $hotel=$this->hotel->where('id',$room_info->hotel_id)->pluck('hotel_name');
            $room_info->hotel_name = $hotel[0];

        }
        $images=$this->room_images->where('room_id',$id)->get();
        return view('admin.product.room.room-form')
                    ->with('title','edit')
                    ->with('room_info',$room_info)
                    ->with('roomimages',$images);        
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
        $this->room=$this->room->find($id);
        if ($this->room) {
            $rules=$this->room->getRules();
            $request->validate($rules);

            $data=$request->all();
            if ($request->image) {
                $filenames=uploadMultipleImages($request->image,'room-images');
                foreach ($filenames as $key => $value) {
                    if ($filenames[$key]) {
                        $temp=array(
                            'image' => $filenames[$key],
                            'room_id' => $id
                        );
                        RoomImages::insert($temp);
                    }
                }
            }
            $this->room->fill($data);
            $success=$this->room->save();
            if ($success) {
                if (isset($request->checkbox) && !empty($request->checkbox)) {
                 $image=$this->room_images->getRoomImagesByName($request->checkbox);
                    foreach ($request->checkbox as $key => $value) {
                        if (file_exists(public_path().'/uploads/room-images/'.$value)) {
                            unlink(public_path().'/uploads/room-images/'.$value);
                        }
                    }
                    foreach ($image as $key => $value) {
                        $this->room_images=$this->room_images->find($value);
                        if ($this->room_images) {
                            $this->room_images->delete();
                        }
                    }
                } 
            }
        }
        return redirect()->route('adminroom.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       $this->room = $this->room->getRoomByRoomid($id);
        $this->room_images = $this->room->room_images;
        //dd($this->room_images);
        if ($this->room) {
            $del=$this->room->delete();
            if ($del) {
                if ($this->room_images) {
                    foreach ($this->room_images as $key => $value) {
                        if ($value->image && file_exists(public_path().'/uploads/room-images/'.$value->image)) {
                        unlink(public_path().'/uploads/room-images/'.$value->image);
                        }
                        $this->room_images[$key]->delete();
                    }
                }
            }
        }
        return redirect()->route('room.index'); 
    }
}
