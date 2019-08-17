<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\Hotel;
use App\Models\RoomImages;

class RoomController extends Controller
{
    protected $room=null;
    protected $hotel=null;
    public function __construct(Room $room,Hotel $hotel,RoomImages $room_images){
        $this->room=$room;
        $this->hotel=$hotel;
        $this->room_images=$room_images;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data=$this->room->getAllRooms();
        return view('vendor.room.index')->with('data',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $hotel=$this->hotel->getHotels();
        $hotel_name=array();
        if ($hotel) {
            foreach ($hotel as $key => $value) {
                 $hotel_name[$hotel[$key]->id]=$hotel[$key]->hotel_name;
            }
        }
        //dd($hotel_name);
        return view('vendor.room.room-form')->with('title','add')->with('hotel',$hotel_name);
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
        $rules=$this->room->getRules();
        $request->validate($rules);
        
        $data=$request->all();
        $this->room->fill($data);
        $success=$this->room->save();
        if ($success) {
            if ($request->image) {
            $fileimages=uploadMultipleImages($request->image,'room-images');
                if (isset($fileimages) && !empty($fileimages)) {
                    foreach ($fileimages as $key => $value) {
                        if ($fileimages[$key]) {
                            $temp=array(
                               'image' => $fileimages[$key],
                               'room_id' => $this->room->id
                            );
                            RoomImages::insert($temp);
                        }
                    }
                }
            }       
        }
        return redirect()->route('room.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = $this->room->getRoomByRoomid($id);
        dd($data);
        if ($data->count()>0) {
            return response()->json(['success'=>true,'data'=> $data]);
        }
        else{
            return response()->json(['success'=>false,'data'=> $data]);
        }
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
        $hotel=$this->hotel->getHotels();
        $images=$this->room_images->where('room_id',$id)->get();
        /*$roomimages=array();
        foreach ($images as $key => $value) {
            if ($images[$key]) {
                $roomimages[$key] = $images[$key]->image;
            }
        }*/
        $hotel_name=array();
        if ($hotel) {
            foreach ($hotel as $key => $value) {
                 $hotel_name[$hotel[$key]->id]=$hotel[$key]->hotel_name;
            }
        }
       // dd($roomimages);
        return view('vendor.room.room-form')
                    ->with('title','edit')
                    ->with('room_info',$room_info)
                    ->with('hotel',$hotel_name)
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
        return redirect()->route('room.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        /*$images=$this->room_images->where('room_id',$id)->get();
        $array=array();
        foreach ($images as $key => $value) {
            $array[] = $images[$key]->image;
        }*/
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
