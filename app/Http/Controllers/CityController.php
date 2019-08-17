<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\City;

class CityController extends Controller
{
    protected $cities=null;

    public function __construct(City $city){
        $this->cities=$city;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->cities=$this->cities->get();
        return view('admin.city.index')->with('data',$this->cities);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.city.city-form')->with('title','add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request);
        $rules=$this->cities->getRules();
        $request->validate($rules);

        $data=$request->all();
        if ($request->image) {
             $filename=uploadImagel($request->image,'city-images');
             if ($filename) {
                 $data['image']=$filename;
             }
             else{
                $data['image']=null;
             }
        }
        $this->cities->fill($data);
        $success=$this->cities->save();
        if ($success) {
            return redirect()->route('city.index');
        }
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
        $this->cities=$this->cities->find($id);
        if ($this->cities) {
             return view('admin.city.city-form')
                    ->with('cities_info',$this->cities)
                    ->with('title','edit');
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
        $this->cities=$this->cities->find($id);
        //dd($this->cities);
        if ($this->cities) {
            $rules=$this->cities->getRules('edit');
            $request->validate($rules);

            $data=$request->all();
            if ($request->image) {
                if ($this->cities->image) {
                    if (file_exists(public_path().'/uploads/city-images/'.$this->cities->image)) {
                        unlink(public_path().'/uploads/city-images/'.$this->cities->image);
                    }
                    if (file_exists(public_path().'/uploads/city-images/'.'thumbnail-'.$this->cities->image)) {
                        unlink(public_path().'/uploads/city-images/'.'thumbnail-'.$this->cities->image);
                    }
                }
                 $filename=uploadImage($request->image,'city-images',350,240,'thumbnail');
                 if ($filename) {
                     $data['image']=$filename;
                 }
                 else{
                    $data['image']=null;
                 }
            }
            $this->cities->fill($data);
            $success=$this->cities->save();
            if ($success) {
                return redirect()->route('city.index');
            }
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
        $this->cities=$this->cities->find($id);
        $image=$this->cities->image;
        if ($this->cities) {
            $del=$this->cities->delete();
            if ($del) {
                if ($image) {
                    if (file_exists(public_path().'/uploads/city-images/'.$image)) {
                    unlink(public_path().'/uploads/city-images/'.$image);
                    }
                    if (file_exists(public_path().'/uploads/city-images/'.'thumbnail-'.$image)) {
                        unlink(public_path().'/uploads/city-images/'.'thumbnail-'.$image);
                    }
                }
            }
        }
        return redirect()->route('city.index');
    }
}
