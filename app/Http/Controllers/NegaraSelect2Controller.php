<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class NegaraSelect2Controller extends Controller
{
    public function list(Request $request){
        try {
            $jsonString = file_get_contents(public_path('list_negara.json'));
            $jsonData = json_decode($jsonString, true);
            $list_negara = array_reduce($jsonData,function($carry,$item){
                $carry[] = [
                    "id"=>$item["name"]["common"],
                    "text"=>$item["name"]["common"],
                    "flag"=>$item["flags"]["png"],
                ];
                return $carry;
            },[]);
            return $list_negara;
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
