<?php

namespace App\Http\Controllers;

use App\Models\Ikan;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index($id){
        $ikan = Ikan::find($id);
        $ikan->karakteristik = json_decode($ikan->karakteristik, true);
         
        return view('search',['ikan'=>$ikan]);
    }

    public function indexv2(){
        return view('searchv2');
    }
}
