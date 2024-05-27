<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index(){
        return view('login');
    }

    public function dologin(Request $request){
        if($request->username=="admin" && $request->password=="123"){
            return redirect()->to('dashboard');
        }
        return redirect()->to('login');
    }
    public function logout(){
        // session_destroy();
        return redirect()->to('login');
    }
}
