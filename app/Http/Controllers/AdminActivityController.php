<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Activity;
use App\Models\ActivityImages;
use App\Models\ActivityCategory;

class AdminActivityController extends Controller
{
    protected $activity=null;
    protected $activity_images=null;
    protected $activity_category=null;

    public function __construct(Activity $activity,ActivityImages $activity_images,ActivityCategory $activity_category){
        $this->activity=$activity;
        $this->activity_images=$activity_images;
        $this->activity_category=$activity_category;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data=$this->activity->get();
        return view('admin.activity.index')->with('data',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
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
        $activity_category=$this->activity_category->getActivityCategory();
        $data=$this->activity->find($id);
        if ($data) {
            $activity_images=$this->activity_images->where('activity_id',$id)->get();
            //dd($activity_images[0]->image);
            return view('admin.activity.activity-form')
                        ->with('activities_info',$data)
                        ->with('title','edit')
                        ->with('activity_images',$activity_images)
                        ->with('activity_category',$activity_category);
        }
        else{
            echo "activity not found";
            exit;
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
        $this->activity=$this->activity->find($id);
        //dd($this->activity);
        if ($this->activity) {
             $rules=$this->activity->getRules();
             $request->validate($rules);
        
             $data=$request->all();
             $this->activity->fill($data);
             $success=$this->activity->save();
             if ($success) {
                 if (isset($request->images) && !empty($request->images)) {
                     $filenames=uploadMultipleImages($request->images,'activity-images',286.843,355.208);
                     if (isset($filenames) && !empty($filenames)) {
                         foreach ($filenames as $key => $value) {
                             if ($filenames[$key]) {
                                 $temp=array(
                                     'image' => $filenames[$key],
                                     'activity_id' => $this->activity->id
                                 );
                                 ActivityImages::insert($temp);
                             }
                         }
                     }
                 }
                 if (isset($request->checkbox) && !empty($request->checkbox)) {
                    foreach ($request->checkbox as $key => $value) {
                        if ($request->checkbox[$key]) {
                            if (file_exists(public_path().'/uploads/activity-images/'.$request->checkbox[$key])) {
                                unlink(public_path().'/uploads/activity-images/'.$request->checkbox[$key]);
                            }
                        }
                    }
                     $images=$this->activity_images->getActivityImagesId($request->checkbox);
                     foreach ($images as $key => $value) {
                         if ($images[$key]) {
                             $this->activity_images=$this->activity_images->find($mages[$key]);
                             if ($this->activity_images) {
                                 $this->activity_images->delete();
                             }
                         }
                     }               
                 }
             }
             return redirect()->route('adminactivity.index');
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
        $this->activity=$this->activity->find($id);
        $this->activity_images=$this->activity_images->where('activity_id',$id)->get();
        if ($this->activity) {
             $del=$this->activity->delete();
             if ($del) {
                 if ($this->activity_images) {
                     foreach ($this->activity_images as $key => $value) {
                        if ($value->image && file_exists(public_path().'/uploads/activity-images/'.$value->image)) {
                        unlink(public_path().'/uploads/activity-images/'.$value->image);
                        }
                        if ($this->activity_images[$key]) {
                              $this->activity_images[$key]->delete();
                        }
                    }
                 }
             }
        }
        return redirect()->route('activities.index');
    }
}
