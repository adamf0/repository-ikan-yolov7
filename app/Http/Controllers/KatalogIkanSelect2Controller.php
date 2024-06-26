<?php

namespace App\Http\Controllers;

use App\Models\Ikan;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;

class KatalogIkanSelect2Controller extends Controller
{
    public function list(Request $request){
        try {
            $list = Ikan::select('id','spesies')->get();

            return $list->transform(fn($item)=>[
                "id"=>$item->id,
                "text"=>$item->spesies,
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
