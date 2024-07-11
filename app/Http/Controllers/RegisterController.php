<?php

namespace App\Http\Controllers;

use App\Helper\TypeNotif;
use App\Models\User;
use App\Rules\LocationValidator;
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
                "nama"              => "required",
                "pekerjaan"         => "required",
                "instansi"          => "required",
                "negara"            => "required",
                // "lokasi"            => ["required",new LocationValidator($request->lokasi)],
                "email"             => "required|email",
                "password"          => "required",
            ]);
            if(count($validator->errors())){
                return redirect()->route('register.index')->withInput()->withErrors($validator->errors()->toArray());    
            } 

            $user              = new User();
            $user->nama        = "user-".date('Ymd').User::count();
            $user->email       = $request->email;
            $user->password    = $request->password;
            $user->nama        = $request->nama;
            $user->pekerjaan   = $request->pekerjaan;
            $user->instansi    = $request->instansi;
            $user->negara      = $request->negara;
            if(!empty($request->bidang_keahlian)){
                $user->bidang_keahlian  = implode(",",$request->bidang_keahlian); //
            }

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
