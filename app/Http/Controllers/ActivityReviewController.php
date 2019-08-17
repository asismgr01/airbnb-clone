<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ActivityReview;

class ActivityReviewController extends Controller
{
    protected $activityreview = null;

    public function __construct(ActivityReview $activityreview){
         $this->activityreview = $activityreview;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->activityreview = $this->activityreview->orderBy('id','DESC')->get();
        return view('admin.review.activityreview.index')->with('data',$this->activityreview);
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
        $rules = $this->activityreview->getRules();
        $request->validate($rules);

        $data = $request->all();
        if ($data['rate'] < 1) {
            $data['rate'] = "1";
        }
        if ($data['name'] == null) {
            $data['name'] = $request->user()->name;
        }
        if ($data['email'] == null) {
            $data['email'] = $request->user()->email;
        }
        $data['user_id'] = $request->user()->id;
        $data['status'] = "active";

        $this->activityreview->fill($data);
        $this->activityreview->save();

        return redirect()->back();

        //dd($data);
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
        $this->activityreview = $this->activityreview->find($id);
        if ($this->activityreview) {
            return view('admin.review.activityreview.review-form')->with('review_info',$this->activityreview)->with('title','edit');
        }
        else{
            return redirect()->route();
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
        //dd($request->all());
        $this->activityreview = $this->activityreview->find($id);
        if ($this->activityreview) {
            $data = $request->all();
            $data['activity_id'] = $this->activityreview->activity_id;
            if ($data['rate'] > 5) {
                $data['rate'] = 5;
            }
            //dd($data);
            $this->activityreview->fill($data);
            $success = $this->activityreview->save();
            if ($success) {
                return redirect()->route('activityreview.index');
            }
            else{
                return redirect()->back();
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
        //
    }
}
