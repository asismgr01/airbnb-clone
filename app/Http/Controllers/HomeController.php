<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (request()->user()->role == 'admin') {
            return redirect()->route('admin');
        }
        elseif (request()->user()->role == 'vendor') {
            return redirect()->route('vendor');
        }
        else{
            return redirect()->route('users');
        }
        //return view('home');
    }
    public function admin(){
        return view('dashboard');
    }
    public function vendor(){
        return view('dashboard');
    }
    public function users(){
        return view('dashboard');
    }
}
