<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ActivityCategory;

class ActivityCategoryController extends Controller
{
    protected $activitycategory=null;
    public function __construct(ActivityCategory $activitycategory){
        $this->activitycategory=$activitycategory;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->activitycategory=$this->activitycategory->get();
        return view('admin.category.activitiescategory')
                  ->with('data',$this->activitycategory);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.category.activitycategory-form')->with('title','add');
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
        $rules=$this->activitycategory->getRules();
        $request->validate($rules);

        $data=$request->all();
        if ($request->image) {
            $filename=uploadImage($request->image,'activitycategory-images');
            if ($filename) {
                 $data['image']=$filename;
            }
            else{
                $data['image']=null;
            }
        }
        $this->activitycategory->fill($data);
        $success=$this->activitycategory->save();
        if ($success) {
            return redirect()->route('activitycategory.index');
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
        $this->activitycategory=$this->activitycategory->find($id);
        if ($this->activitycategory) {
            return view('admin.category.activitycategory-form')
                      ->with('activitycategory_info',$this->activitycategory)
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
        //dd($request);
        $this->activitycategory=$this->activitycategory->find($id);
        if ($this->activitycategory) {
            $rules=$this->activitycategory->getRules('edit');
            $request->validate($rules);

            $data=$request->all();
            if ($request->image) {
                if ($this->activitycategory->image) {
                     if (file_exists(public_path().'/uploads/activitycategory-images/'.$this->activitycategory->image)) {
                         unlink(public_path().'/uploads/activitycategory-images/'.$this->activitycategory->image);
                     }
                     if (file_exists(public_path().'/uploads/activitycategory-images/'.'thumbnail-'.$this->activitycategory->image)) {
                         unlink(public_path().'/uploads/activitycategory-images/'.'thumbnail-'.$this->activitycategory->image);
                     }
                }
                $filename=uploadImage($request->image,'activitycategory-images');
                if ($filename) {
                     $data['image']=$filename;
                }
                else{
                    $data['image']=null;
                }
            }
            $this->activitycategory->fill($data);
            $success=$this->activitycategory->save();
            if ($success) {
            return redirect()->route('activitycategory.index');
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
        $this->activitycategory=$this->activitycategory->find($id);
        $image=$this->activitycategory->image;
        if ($this->activitycategory) {
            $del=$this->activitycategory->delete();
            if ($del) {
                if ($image) {
                    if (file_exists(public_path().'/uploads/activitycategory-images/'.$image)) {
                        unlink(public_path().'/uploads/activitycategory-images/'.$image);
                    }
                    if (file_exists(public_path().'/uploads/activitycategory-images/'.'thumbnail-'.$image)) {
                        unlink(public_path().'/uploads/activitycategory-images/'.'thumbnail-'.$image);
                    }
                }
            }
        }
        return redirect()->route('activitycategory.index');
    }
}
