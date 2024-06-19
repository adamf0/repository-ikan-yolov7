<?php

namespace App\Http\Controllers;

use App\Helper\TypeNotif;
use App\Models\User;
use App\Rules\LocationValidator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ProfileController extends Controller
{
    public function index(){
        $profile = User::where('id',Session::get('id'))->firstOrFail();
        return view('profile.index',['profile'=>$profile]);
    }

    public function edit(){
        $profile = User::where('id',Session::get('id'))->firstOrFail();
        return view('profile.edit',["old"=>$profile]);
    }
    
    public function update(Request $request){
        try {
            $validator      = validator($request->all(), [
                "nama"              => "required",
                "email"             => "required|email",
                "pekerjaan"         => "required",
                // "instansi"          => "required",
                "negara"            => "required",
                "lokasi"            => ["required",new LocationValidator($request->lokasi)],
                // "bidang_keahlian"   => "required",
                "foto"              => "nullable|file|mimes:jpg,jpeg,png|max:10000",
            ]);

            if(count($validator->errors())){
                return redirect()->route('profile.edit')->withInput()->withErrors($validator->errors()->toArray());    
            } 

            $user                   = User::where('id',Session::get('id'))->firstOrFail();
            if($request->has("foto") && $request->file("foto")!=null){
                if (!empty($user->foto) && file_exists(public_path('dokumen_foto/' . $user->foto))) {
                    unlink(public_path('dokumen_foto/' . $user->foto));
                }
                
                $file = str_replace("#", "", $request->file('foto')->getClientOriginalName());
                $destinationPath = public_path('dokumen_foto');
                $request->file('foto')->move($destinationPath, $file);
            } else{
                $file = $user->foto;
            }

            $user->nama             = $request->nama;
            $user->email            = $request->email;
            $user->pekerjaan        = $request->pekerjaan;
            $user->instansi         = $request->instansi; //
            $user->negara           = $request->negara;
            if(!empty($request->lokasi)){
                $user->latitude         = !empty($request->lokasi)? explode(",",$request->lokasi)[0]:"";
            }
            if(!empty($request->lokasi)){
                $user->longitude        = !empty($request->lokasi)? explode(",",$request->lokasi)[1]:"";
            }
            if(!empty($request->bidang_keahlian)){
                $user->bidang_keahlian  = implode(",",$request->bidang_keahlian); //
            }
            $user->foto             = $file;
            $user->save();

            Session::flash(TypeNotif::Create->val(), "berhasil update profile");
            return redirect()->route('profile.index');
        } catch (\Exception $e) {
            throw $e;
            Session::flash(TypeNotif::Error->val(), $e->getMessage());
            return redirect()->route('profile.edit')->withInput();
        }
    }
}
