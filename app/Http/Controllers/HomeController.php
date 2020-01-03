<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

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
        $role = Auth::user()->role;
        if($role == 2){
            $role = 'siswa';
        } else if ($role == 1){
            $role = 'guru';
        } else if ($role == 0){
            $role = 'admin';
        }
        return view('home',['role'=>$role]);
    }
}
