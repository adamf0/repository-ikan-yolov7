<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FamilyGuideController extends Controller
{
    public function index(){
        return view('family_guide');
    }
}
