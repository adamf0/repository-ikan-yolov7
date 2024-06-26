<?php

namespace App\Http\Controllers;

use App\Helper\TypeNotif;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class RegisterController extends Controller
{
    public function index(){
        return view('register');
    }

    public function store(Request $request){
        try {
            $validator      = validator($request->all(), [
                "email"     => "required|email|unique:users,email",
                "password"  => "required",
            ]);

            if(count($validator->errors())){
                return redirect()->route('register.index')->withInput()->withErrors($validator->errors()->toArray());    
            } 

            $user           = new User();
            $user->nama     = "user-".date('Ymd').User::count();
            $user->email    = $request->email;
            $user->password = $request->password;
            $user->save();
            Session::flash(TypeNotif::Create->val(), "berhasil daftar");
            return redirect()->route('login.index');
        } catch (\Throwable $e) {
            Session::flash(TypeNotif::Error->val(), $e->getMessage());
            return redirect()->route('register.index')->withInput(); //->withErrors($validator->errors()->toArray());;
        }
        //kurang validasi
    }
}
