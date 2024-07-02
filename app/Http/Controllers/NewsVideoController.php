<?php

namespace App\Http\Controllers;

use App\Models\Video;

class NewsVideoController extends Controller
{
    public function index(){
        $video = Video::all()->groupBy('kategori');
        return view('videos',["video"=>$video]);
    }
}
