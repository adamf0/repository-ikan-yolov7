<?php

namespace App\Http\Controllers;

use App\Helper\TypeNotif;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ProfileController extends Controller
{
    public function index(){
        return view('profile.index');
    }

    public function edit(){
        return view('profile.edit',["old"=>Auth::user()]);
    }
    
    public function update(Request $request){
        try {
            //validasi

            $user                   = User::findOrFail(Auth::user()?->id);
            $user->nama_lengkap     = $request->nama_lengkap;
            $user->email            = $request->email;
            $user->pekerjaan        = $request->pekerjaan;
            $user->instansi         = $request->instansi;
            $user->negara           = $request->negara;
            $user->lokasi           = $request->lokasi;
            $user->bidang_keahlian  = $request->bidang_keahlian;
            // $user->foto             = $request->foto;
            $user->save();

            Session::flash(TypeNotif::Create->val(), "berhasil update profile");
            return redirect()->route('profile.index');
        } catch (\Exception $e) {
            Session::flash(TypeNotif::Error->val(), $e->getMessage());
            return redirect()->route('profile.index')->withInput();
        }
    }
}
