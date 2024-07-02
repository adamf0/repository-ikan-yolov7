<?php

namespace App\Http\Controllers;

use App\Models\Berita;

class NewsController extends Controller
{
    public function index(){
        $news = Berita::all();
        return view('news',["news"=>$news]);
    }
    public function detail($id){ //pending
        $news = Berita::findOrFail($id);
        return view('news_detail',["news"=>$news]);
    }
}
