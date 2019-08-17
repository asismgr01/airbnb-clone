<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HotelReview;

class HotelReviewController extends Controller
{
    protected $hotel_review=null;

    public function __construct(HotelReview $hotel_review){
        $this->hotel_review = $hotel_review;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request,$role = null)
    {
        if ($request->role == 'vendor') {

        }
        elseif ($request->role == 'user') {
            
        }
        else{
            $this->hotel_review = $this->hotel_review->orderBy('id','DESC')->get();
            return view('admin.review.hotelreview.hotelreview')->with('data',$this->hotel_review);
        }
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
        $rules = $this->hotel_review->getRules();
        $request->validate($rules);

        $data = $request->all();
        $data['status'] = 'active';
        $data['user_id'] = $request->user()->id;
        
        $this->hotel_review->fill($data);
        $success = $this->hotel_review->save();
        
        return redirect()->back();
    }

    public function review(Request $request){
        
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
        $this->hotel_review = $this->hotel_review->find($id);
        if ($this->hotel_review) {
            return view('admin.review.hotelreview.hotelreview-form')->with('review_info',$this->hotel_review)->with('title','edit');
        }
        else{
            return redirect()->back();
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
        $this->hotel_review = $this->hotel_review->find($id);
        if ($this->hotel_review) {
            //dd($request->only('review','status'));
            $data = $request->only('review','status');
            $this->hotel_review->fill($data);
            $success = $this->hotel_review->save();
            if ($success) {
                return redirect()->route('hotelreview.index');
            }   
            else{
                return redirect()->back();
            }
        }
        else{
            return redirect()->route('hotelreview.index');
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
        $this->hotel_review = $this->hotel_review->find($id);
        if ($this->hotel_review) {
            //dd($this->hotel_review);
            $del = $this->hotel_review->delete();
            if ($del) {
                return redirect()->route('hotelreview.index');
            }
            else{
                return redirect()->back();
            }
        }
    }
}
