<?php

namespace App\Http\Controllers;

use App\Models\Ikan;
use Exception;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index($id){
        $ikan = Ikan::find($id);
        $ikan->karakteristik = json_decode($ikan->karakteristik, true);
        
        return view('search',['ikan'=>$ikan]);
    }

    public function indexv2($klasifikasi){
        try {
            $filePath = public_path("$klasifikasi.json");
            $jsonData = file_get_contents($filePath);
            $dataArray = json_decode($jsonData, true);

            $data = [];
            foreach($dataArray as $key => $item){
                if($key=="image"){
                    $data[$key] = $item;
                } else{
                    $data["classification"][$key] = $item;
                }
            }

            return view('searchv2',$data);
        } catch (Exception $e) {
            return redirect()->route("home");
        }
    }
}
