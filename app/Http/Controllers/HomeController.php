<?php

namespace App\Http\Controllers;

use App\Models\Ikan;

class HomeController extends Controller
{
    

    public function index(){
        // $data = Excel::import(new InfoIkan, public_path('informasi dataset.xlsx'));
        // dd($data);
        return view('index');
    }
}
