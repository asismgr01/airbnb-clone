<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

use Illuminate\Support\Facades\Hash;

class VendorController extends Controller
{
    protected $user=null;
    public function __construct(User $user){
        $this->user=$user;
    } 
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data=$this->user->where('role','vendor')->get();
        return view('admin.user.vendor.index')->with('data',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.user.vendor.vendor-form')->with('title','add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
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
        $this->user=$this->user->where('role','vendor')->find($id);
        if ($this->user) {
            return view('admin.user.vendor.vendor-form')
                       ->with('vendor_info',$this->user)
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
        //dd($request->all());
        $rules=$this->user->getRules();
        $request->validate($rules);
        $data=$request->except('re_password');
        if ($request->edit_password) {
            $data['password'] = Hash::make($data['password']);
        }
        else{
            unset($data['password']);
        }
        $this->user = $this->user->find($id);
        $this->user->fill($data);
        $success = $this->user->save();

        return redirect()->route('vendor.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->user = $this->user->find($id);

        if ($this->user) {
             $del = $this->user->delete();
             if ($del) {
                 return redirect('vendor.index');
             }
        }
    }
}
