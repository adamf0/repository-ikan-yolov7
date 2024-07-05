<?php

namespace App\Http\Controllers;

use App\Models\Ikan;
use Exception;
use Illuminate\Http\Request;
use App\Helper\Utility;

class SearchController extends Controller
{
    public function index($spesies)
    {
        $ikan = Ikan::where('spesies', $spesies)->first();
        if ($ikan == null) {
            return redirect()->route("home");
        }
        $files = \App\Helper\Utility::scanFiles(strtolower($ikan->spesies));
        $randomFile = count($files) > 0 ? array_map(function($item){
            $item = \App\Helper\Utility::loadAsset(rawurlencode($item));
            return $item;
        },$files) : [\App\Helper\Utility::loadAsset('not_found.jpg')];
        $ikan->foto = $randomFile;
        return view('search', ['ikan' => $ikan]);
    }

    public function indexv2($klasifikasi)
    {
        try {
            $filePath = public_path("$klasifikasi.json");
            $jsonData = file_get_contents($filePath);
            $result = json_decode($jsonData, true);
            $list_ikan = collect([]);
            foreach ($result['predic'] as $r) {
                $ikan = Ikan::where('id', $r['id_ikan'])->first();
                if (!is_null($ikan)) {
                    $ikan->type = $r['type'];
                    $ikan->akurasi = $r['type'] == "edited" ? 0 : $r['akurasi'];

                    $files = \App\Helper\Utility::scanFiles(strtolower($ikan->spesies));
                    $randomFile = count($files) > 0 ? array_map(function($item){
                        $item = \App\Helper\Utility::loadAsset(rawurlencode($item));
                        return $item;
                    },$files) : [\App\Helper\Utility::loadAsset('not_found.jpg')];
                    $ikan->foto = $randomFile;

                    $list_ikan->push($ikan);
                }
            }
            $result['list_ikan'] = $list_ikan;
            $result['gambar_upload'] = Utility::loadasset("Prediksi/" . $result['image']);

            return view('searchv2', $result);
        } catch (Exception $e) {
            throw $e;
            // return redirect()->route("home");
        }
    }
}
