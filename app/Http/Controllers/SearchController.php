<?php

namespace App\Http\Controllers;

use App\Models\Ikan;
use Exception;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index($spesies){
        $ikan = Ikan::where('spesies',$spesies)->first();
        if($ikan==null){
            return redirect()->route("home");
        }
        $files = \App\Helper\Utility::scanFiles($ikan->spesies);
        $randomFile = count($files)>0? \App\Helper\Utility::loadAsset($files[array_rand($files)]) : \App\Helper\Utility::loadAsset('not_found.jpg');
        $ikan->foto = $randomFile;
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
