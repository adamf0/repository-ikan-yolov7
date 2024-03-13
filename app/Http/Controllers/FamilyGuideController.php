<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FamilyGuideController extends Controller
{
    public function index(){
        return view('family_guide');
    }
}
