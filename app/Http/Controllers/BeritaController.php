<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use Illuminate\Http\Request;

class BeritaController extends Controller
{
    public $rule = [
        "url"       => "required",
        "judul"     => "required",
        "deskripsi" => "required",
        "scrapping" => "required",
    ];

    public function index(){
        $list = Berita::orderBy('id','desc')->get();
        return view('berita.index',['list'=>$list]);
    }
    
    public function add(){
        return view('berita.add');
    }

    public function edit($id){
        $old = Berita::findOrFail($id);
        return view('berita.edit',["old"=>$old]);
    }

    public function store(Request $request){
        try {
            $validator      = validator($request->all(), $this->rule);

            if(count($validator->errors())){
                return redirect()->route('berita.create')->withInput()->withErrors($validator->errors()->toArray());    
            } 

            $berita             = new Berita();
            $berita->url        = $request->url??""; 
            $berita->judul      = $request->judul??""; 
            $berita->deskripsi  = $request->deskripsi??""; 
            $berita->save();

            return redirect()->route('berita.index');
        } catch (\Exception $th) {
            throw $th;
        }
    }

    public function update(Request $request){
        try {
            $validator      = validator($request->all(), array_merge($this->rule,["id" => "required"]));
            if(count($validator->errors())){
                return redirect()->route('berita.edit')->withInput()->withErrors($validator->errors()->toArray());    
            } 

            $berita             = Berita::findOrFail($request->id);
            $berita->url        = $request->url??""; 
            $berita->judul      = $request->judul??""; 
            $berita->deskripsi  = $request->deskripsi??""; 
            $berita->save();

            return redirect()->route('berita.index');
        } catch (\Exception $th) {
            throw $th;
        }
    }

    public function delete($id){
        try {
            $berita = Berita::findOrFail($id);
            $berita->delete();
        } catch (\Exception $th) {
            throw $th;
        }
        return redirect()->route('berita.index');
    }
}
