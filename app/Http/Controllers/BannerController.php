<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Banner;

class BannerController extends Controller
{
    protected $banner = null;
    public function __construct(Banner $banner){
        $this->banner = $banner;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->banner = $this->banner->get();
        return view('admin.banner.index')->with('data',$this->banner);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.banner.banner-form')->with('title','add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = $this->banner->getRules();
        $request->validate($rules);

        $data = $request->all();
        $data['added_by'] = $request->user()->id;
        //dd($data);
        if ($request->banner) {
            $image = uploadImage($request->banner,'banner',$width=1400,$height=680,$thumb='thumbnail');
            if ($image) {
                $data['banner'] = $image;
            }
            else{
                $data['banner'] = null;
            }
        }
        $this->banner->fill($data);
        $success = $this->banner->save();

        if ($success) {
            return redirect()->route('banner.index');
        }
        else{
            return redirect()->back();
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
        $this->banner = $this->banner->find($id);
        return view('admin.banner.banner-form')->with('title','edit')->with('banner',$this->banner);
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
        $this->banner = $this->banner->find($id);
        if ($this->banner) {
            $rules = $this->banner->getRules('edit');
            $request->validate($rules);

            $data = $request->all();
            //dd($request);
            if ($request->banner) {
                if ($this->banner->banner && file_exists(public_path().'/uploads/banner/'.$this->banner->banner)) {
                    unlink(public_path().'/uploads/banner/'.$this->banner->banner);
                    unlink(public_path().'/uploads/banner/'.'thumbnail-'.$this->banner->banner);
                    $image = uploadImage($request->banner,'banner',$width=1400,$height=680,$thumb='thumbnail');
                }
                $image = uploadImage($request->banner,'banner',$width=1400,$height=680,$thumb='thumbnail');
                if ($image) {
                    $data['banner'] = $image;
                }
                else{
                    $data['banner'] = null;
                }
            }
            $this->banner->fill($data);
            $success = $this->banner->save();
            if ($success) {
                return redirect()->route('banner.index');
            }
        }
        else{
            return redirect()->back();
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
        $this->banner = $this->banner->find($id);
        //dd($this->banner);
        if ($this->banner) {
            if ($this->banner->banner) {
                if (file_exists(public_path().'/uploads/banner/'.$this->banner->banner)) {
                    unlink(public_path().'/uploads/banner/'.$this->banner->banner);
                    unlink(public_path().'/uploads/banner/'.'thumbnail-'.$this->banner->banner);
                }
            }
            $del = $this->banner->delete();
            if ($del) {
                return redirect()->route('banner.index');
            }
        }
    }
}
