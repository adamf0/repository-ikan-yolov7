<?php

namespace App\Http\Controllers;

use App\Models\ArsipPublikasi;
use Illuminate\Http\Request;

class ArsipPublikasiController extends Controller
{
    public $rule = [
        "tahun"   => "required",
        "arsip"   => "required",
        "url"     => "required",
    ];

    public function index(){
        $list = ArsipPublikasi::orderBy('id','desc')->get();
        return view('arsipPublikasi.index',['list'=>$list]);
    }
    
    public function add(){
        return view('arsipPublikasi.add');
    }

    public function edit($id){
        $old = ArsipPublikasi::findOrFail($id);
        return view('arsipPublikasi.edit',["old"=>$old]);
    }

    public function store(Request $request){
        try {
            $validator      = validator($request->all(), $this->rule);

            if(count($validator->errors())){
                return redirect()->route('arsip_publikasi.create')->withInput()->withErrors($validator->errors()->toArray());    
            }

            $arsipPublikasi             = new ArsipPublikasi();
            $arsipPublikasi->url        = $request->url??""; 
            $arsipPublikasi->tahun      = $request->tahun??"";
            $arsipPublikasi->arsip     = $request->arsip??""; 
            $arsipPublikasi->save();

            return redirect()->route('arsip_publikasi.index');
        } catch (\Exception $th) {
            throw $th;
        }
    }

    public function update(Request $request){
        try {
            $validator      = validator($request->all(), array_merge($this->rule, ["id"=>"required"]));

            if(count($validator->errors())){
                return redirect()->route('arsip_publikasi.edit',['id'=>$request->id])->withInput()->withErrors($validator->errors()->toArray());    
            }

            $arsipPublikasi             = ArsipPublikasi::findOrFail($request->id);
            $arsipPublikasi->url        = $request->url??""; 
            $arsipPublikasi->tahun      = $request->tahun??"";
            $arsipPublikasi->arsip     = $request->arsip??"";
            $arsipPublikasi->save();

            return redirect()->route('arsip_publikasi.index');
        } catch (\Exception $th) {
            throw $th;
        }
    }

    public function delete($id){
        try {
            $arsipPublikasi = ArsipPublikasi::findOrFail($id);
            $arsipPublikasi->delete();
        } catch (\Exception $th) {
            throw $th;
        }
        return redirect()->route('arsip_publikasi.index');
    }
}
