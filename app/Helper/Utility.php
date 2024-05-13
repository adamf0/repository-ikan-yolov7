<?php

namespace App\Helper;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
    public static function scanFiles($folder){
        $files = [];
        $items = Storage::disk('public')->files($folder);

        foreach ($items as $item) {
            $files[] = $item;
        }
        return $files;
    }
    public static function deskripsiStatus($status){
        return match(strtolower($status)){
            "ex"=>[
                "judul"=>"Punah",
                "inggris"=>"Extinct",
                "deskripsi"=>"Tidak ada individu yang diketahui hidup"
            ],
            
            "ew"=>[
                "judul"=>"Punah di alam liar",
                "inggris"=>"Extinct in the wild",
                "deskripsi"=>"Diketahui hanya ada di penangkaran, atau sebagai populasi yang dinaturalisasi di luar rentang historisnya."
            ],
            
            "cr"=>[
                "judul"=>"Kritis",
                "inggris"=>"Critically endangered",
                "deskripsi"=>"Beresiko sangat tinggi punah di alam liar."
            ],
            
            "en"=>[
                "judul"=>"Terancam Punah",
                "inggris"=>"Endangered",
                "deskripsi"=>"Beresiko tinggi mengalami kepunahan."
            ],
            
            "vu"=>[
                "judul"=>"Rentan",
                "inggris"=>"Vulnerable",
                "deskripsi"=>"Risiko tinggi terancam di alam liar."
            ],
            
            "nt"=>[
                "judul"=>"Hampir Terancam Punah",
                "inggris"=>"Near Threatened ",
                "deskripsi"=>"Kemungkinan akan terancam dalam waktu dekat."
            ],
            
            "lc"=>[
                "judul"=>"Risiko Rendah",
                "inggris"=>"Least Concern",
                "deskripsi"=>"Risiko terendah: tidak memenuhi syarat untuk kategori risiko yang lebih tinggi."
            ],
            
            "dd"=>[
                "judul"=>"Data Kurang",
                "inggris"=>"Data Deficient",
                "deskripsi"=>"Tidak cukup data untuk membuat penilaian tentang risiko kepunahannya."
            ],
            
            "ne"=>[
                "judul"=>"Tidak dievaluasi",
                "inggris"=>"Not Evaluated",
                "deskripsi"=>"Belum dievaluasi terhadap kriteria."
            ],
            default => "???",
        };
    }
}