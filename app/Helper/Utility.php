<?php

namespace App\Helper;

use Exception;
use Illuminate\Http\Request;

trait Utility{
    public static function stateMenu($segment=[],Request $request)
    {
        if(count($segment)==0) throw new Exception('invalid argument');

        return in_array(count($request->segments())? $request->segments()[0]:$request->segments(),$segment);
    }
    public static function loadAsset($path){
        return env('DEPLOY','dev')=='dev'? asset($path):secure_asset($path);
    }
    public static function loadAssetbase64($value){
        return "data:image/png;base64,$value";
    }
    public static function deskripsiStatus($status){
        return match(strtolower($status)){
            "ex"=>"Tidak ada individu yang diketahui hidup",
            "ew"=>"Diketahui hanya ada di penangkaran, atau sebagai populasi yang dinaturalisasi di luar rentang historisnya.",
            "cr"=>"Beresiko sangat tinggi punah di alam liar.",
            "en"=>"Beresiko tinggi mengalami kepunahan.",
            "vu"=>"Risiko tinggi terancam di alam liar.",
            "nt"=>"Kemungkinan akan terancam dalam waktu dekat.",
            "lc"=>"Risiko terendah: tidak memenuhi syarat untuk kategori risiko yang lebih tinggi.",
            "dd"=>"Tidak cukup data untuk membuat penilaian tentang risiko kepunahannya.",
            "ne"=>"Belum dievaluasi terhadap kriteria.",
            default => "???",
        };
    }
}