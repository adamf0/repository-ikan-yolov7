<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AcknowledgementsController extends Controller
{
    public function index(){
        return view('acknowledgements');
    }
}
