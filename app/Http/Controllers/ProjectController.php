<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;

class ProjectController extends Controller
{
    public function index(){
        // return Hash::make('123');
        return view('project.index');
    }
}
