<?php

namespace App\Http\Controllers;

use App\Models\Ikan;
use Exception;
use Illuminate\Http\Request;

class FamilyGuideApiController extends Controller
{
    public function list(Request $request){
        try {
            $ordo       = $request->get("ordo")??null;
            $familia    = $request->get("familia")??null;
            $genus      = $request->get("genus")??null;
            
            $datas = match(true){
                !is_null($ordo) || !is_null($familia) || !is_null($genus) => [],
                default => Ikan::all(),
            };
            return json_encode([
                "status"=>"ok",
                "message"=>null,
                "data"=>$datas
            ]);
        } catch (Exception $e) {
            return json_encode([
                "status"=>"fail",
                "message"=>$e->getMessage(),
                "data"=>[],
            ]);
        }
    }
}
