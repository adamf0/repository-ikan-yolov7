<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    public $rule = [
        "url"       => "required",
        "kategori"  => "required",
    ];

    public function index(){
        $list = Video::orderBy('id','desc')->get();
        return view('video.index',['list'=>$list]);
    }
    
    public function add(){
        return view('video.add');
    }

    public function edit($id){
        $old = Video::findOrFail($id);
        return view('video.edit',["old"=>$old]);
    }

    public function store(Request $request){
        try {
            $validator      = validator($request->all(), $this->rule);

            if(count($validator->errors())){
                return redirect()->route('video.create')->withInput()->withErrors($validator->errors()->toArray());    
            }

            $video             = new Video();
            $video->url        = $request->url??""; 
            $video->kategori   = $request->kategori; 
            $video->save();

            return redirect()->route('video.index');
        } catch (\Exception $th) {
            throw $th;
        }
    }

    public function update(Request $request){
        try {
            $validator      = validator($request->all(), array_merge($this->rule, ["id"=>"required"]));

            if(count($validator->errors())){
                return redirect()->route('video.edit',['id'=>$request->id])->withInput()->withErrors($validator->errors()->toArray());    
            }

            $video             = Video::findOrFail($request->id);
            $video->url        = $request->url??""; 
            $video->kategori   = $request->kategori; 
            $video->save();

            return redirect()->route('video.index');
        } catch (\Exception $th) {
            throw $th;
        }
    }

    public function delete($id){
        try {
            $video = Video::findOrFail($id);
            $video->delete();
        } catch (\Exception $th) {
            throw $th;
        }
        return redirect()->route('video.index');
    }
}
