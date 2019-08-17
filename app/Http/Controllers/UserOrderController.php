<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\RoomBooking;

class UserOrderController extends Controller
{
    protected $order=null;
    protected $roombooking = null;

    public function __construct(Order $order,RoomBooking $roombooking){
        $this->order=$order;
        $this->roombooking = $roombooking;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    { 
        $data = $this->roombooking->where('user_id',request()->user()->id)->get();
        //dd($data);
        return view('users.orders.index')->with('data',$data);
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
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function cancel(Request $request){
        $this->roombooking = $this->roombooking->find($request->order_id);
        if ($this->roombooking) {
            $this->roombooking->status = 'cancelled';
            $success = $this->roombooking->save();
            if ($success) {
                return response()->json(['status'=>true]);
            }
            else{
                return response()->json(['status'=>false]);
            }
        }

    }
    public function update(Request $request, $id)
    {
        $this->roombooking = $this->roombooking->find($id);
        dd($this->roombooking);
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
