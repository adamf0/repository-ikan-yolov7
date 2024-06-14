<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function index(){
        return view('register');
    }

    public function store(Request $request){
        $user           = new User();
        $user->email    = $request->email;
        $user->password = $request->password;
        $user->save();

        return redirect()->to('login');
    }
}
