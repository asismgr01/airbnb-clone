<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\Order;
use App\Models\RoomBooking;

class CartController extends Controller
{
	protected $hotel = null;

	public function __construct(Room $room){
        $this->room = $room;
	}
    public function cartremove(Request $request){
       $data=session('cart');
       $data[$request->key]['quantity'] -= $request->quantity;

       dd($data);

       $request->session()->put('cart',$data);
       return response()->json(['data'=>$data,'status'=>true,'msg'=>'Cart updated successfully']); 
    }
    public function postcart(Request $request){
    	$this->room = $this->room->getRoomByRoomid($request->room_id);
        //dd($this->room);
    	if (!$this->room) {
    		return response()->json(['data'=>null,'status'=>false,'msg'=>'Invalid room id']);
    	}
    	$current_product=array(
            'id' => ($this->room->id),
            'title' => $this->room->title,
            'orginal_price' => $this->room->price,
            'image' => asset('uploads/room-images/'.$this->room->room_images[0]->image),
            'city' => $request->city,
            'hotel_id' => $request->hotel_id,
            'check_in' => $request->check_in,
            'check_out' => $request->check_out,
            'slug' => $request->slug,
            /*'url' => route('/product-detail/',$this->hotel->id)*/
    	);
    	$price=$this->room->price;
    	if ($this->room->discount > 0) {
            $price=$price-(($price*$this->room->discount)/100);
    	}
    	$current_product['price']= $price;
    	$current_product['quantity'] = $request->quantity;
        $current_product['amount'] = $request->quantity*$price;
    	$cart=session('cart')? session('cart') : array();

    	if (!empty($cart)) {
             //if product already exists in session('cart')
            $index = null;
            foreach ($cart as $key => $value) {
                if ($value['id'] == $request->room_id) {
                    $cart[$key]['quantity'] += $request->quantity;
                    $index = $key;
                    break;
                }
            }
            if ($index === null) {
            array_push($cart,$current_product);
            /* $cart[] = $current_product gare pani hunxa*/                
            }
    	}
    	else{
            //new product in cart
            $cart[] = $current_product;
    	}
        /* talako session functions bata jun function use gare panihunxa
    	session('cart',$cart);
    	Session::put('cart',$cart);*/
    	$request->session()->put('cart',$cart);
        return response()->json(['data'=>$cart,'status'=>true,'msg'=> $this->room->title.'Added in cart']);
    	//dd($request->all());
    }
    public function checkout(Request $request){
        //dd(session('cart'));

        $cart= session('cart');
        $str = \Str::random(15);

        foreach ($cart as $key => $value) {
                    $order = new RoomBooking();
                    $order->cart_id = $str;
                    $order->room_id = $value['id'];
                    $order->hotel_id = $value['hotel_id'];
                    $order->user_id = $request->user()->id;
                    $order->quantity = $value['quantity'];
                    $order->amount = $value['amount'];
                    $order->city = $value['city'];
                    $order->check_in = $value['check_in'];
                    $order->check_out = $value['check_out'];
                    $order->status = 'new';
                    //dd($order);
                    $order->save();
                }
        $request->session()->forget('cart');
        /*session ma flash message dekhaune*/
        return redirect()->route('home');        
    }
}
