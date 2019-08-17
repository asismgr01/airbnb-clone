<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;
use Mail;
use App\Mail\ActivateUser;

class UserController extends Controller
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
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }
    
    public function register_user(Request $request){
        $rules=$this->user->getRegisterRules();
        $request->validate($rules);

        $data=$request->all();
        $data['password'] = Hash::make($data['password']);
        $activation_code = \Str::random(100);
        $data['activation_code'] = $activation_code;
        $data['status'] = 'inactive';

        $this->user->fill($data);
        $success=$this->user->save();
        if ($success) {
            Mail::to($data['email'])->send(new ActivateUser($activation_code));
        }
        return redirect()->route('login');
    }
    public function activate_user($token){
        $this->user = $this->user->where('activation_code', $token)->first();
        if (!$this->user) {
            return redirect()->route('signup');
        }
        else{
            $data = array(
               'activation_code' => null,
               'status' => 'active'
            );
            $this->user->fill($data);
            $this->user->save();

            return redirect()->route('login');
        }
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
        //
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
        //
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
