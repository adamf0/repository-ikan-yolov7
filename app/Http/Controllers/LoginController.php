<?php

namespace App\Http\Controllers;

use App\Helper\TypeNotif;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function index(){
        return view('login');
    }

    public function dologin(Request $request){
        if($request->email=="admin" && $request->password=="123"){
            Session::push("nama","admininstrator");
            Session::push("level","admin");
            return redirect()->route('dashboard.index');
        } else if(Auth::attempt(["email"=>$request->get('email'),"password"=>$request->get('password')])){
            Session::push("level","user");
            return redirect()->route('dashboard.index');
        }

        Session::flash(TypeNotif::Error->val(), "akses ditolak");
        return redirect()->route('login.index');
    }
    public function logout(){
        Auth::logout();
        return redirect()->route('login.index');
    }
}
