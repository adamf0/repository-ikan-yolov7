<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;

class UserSelect2Controller extends Controller
{
    public function list(Request $request){
        try {
            $type       = $request->get('type')??null;
            $search     = $request->get('search')??null;

            if(!empty($type) && $type=="user_search" && !empty($search)){
                $list_pengguna  = User::where('email','like','%'.$search.'%')->get();
            } else{
                $list_pengguna  = collect([]);
            }

            return $list_pengguna->transform(fn($item)=>[
                "id"=>$item->id,
                "text"=>$item->email,
            ]);
        } catch (Exception $e) {
            return json_encode([
                "status"=>"fail",
                "message"=>"ada masalah pada proses aplikasi",
                "log"=>$e->getMessage(),
                "data"=>[],
            ]);
        }
    }
}
