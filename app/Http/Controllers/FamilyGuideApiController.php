<?php

namespace App\Http\Controllers;

use App\Models\Ikan;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FamilyGuideApiController extends Controller
{
    function convertToFormat($data,$iteration = 1) {
        return array_map(function($key, $value) use(&$iteration) {
            if($iteration>= 0 && $iteration<7) return [
                'id' => $key,
                'text' => $key,
                'list' => is_array($value)? $this->convertToFormat($value, $iteration+1) : $value,
            ]; 
            else if ($iteration==7) return [
                'id' => $key,
                'text' => $key,
            ];
            else return;
        }, array_keys($data), $data);
    }

    public function listDropdown(){
        try {
            $ikan = Ikan::select(
                "fillum",
                "super_kelas",
                "kelas",
                "ordo",
                "famili",
                "genus",
                "spesies",
            )
            ->get()
            ->groupBy([
                "fillum",
                "super_kelas",
                "kelas",
                "ordo",
                "famili",
                "genus",
                "spesies",
            ]);

            $result = [];
            $result = $this->convertToFormat($ikan->toArray());

            return json_encode($result);
        } catch (Exception $e) {
            return json_encode([
                "status"=>"fail",
                "message"=>"ada masalah pada proses aplikasi",
                "log"=>$e->getMessage(),
                "data"=>[],
            ]);
        }
    }

    public function list(Request $request){
        try {
            ///dd($request->all());
            $ikan = null;
            if(
                in_array($request->fillum, ["null",null])  &&
                in_array($request->super_kelas, ["null",null])  &&
                in_array($request->kelas, ["null",null])  &&
                in_array($request->ordo, ["null",null])  &&
                in_array($request->famili, ["null",null])  &&
                in_array($request->genus, ["null",null])  &&
                in_array($request->spesies, ["null",null]) 
            ){
                $ikan = Ikan::all();
            } else{
                $ikan = DB::table("ikan");
                if(!in_array($request->fillum, ["null",null])){
                    $ikan = $ikan->where('fillum',$request->fillum);        
                }
                if(!in_array($request->super_kelas, ["null",null])){
                    $ikan = $ikan->where('super_kelas',$request->super_kelas);        
                }
                if(!in_array($request->kelas, ["null",null])){
                    $ikan = $ikan->where('kelas',$request->kelas);        
                }
                if(!in_array($request->ordo, ["null",null])){
                    $ikan = $ikan->where('ordo',$request->ordo);        
                }
                if(!in_array($request->famili, ["null",null])){
                    $ikan = $ikan->where('famili',$request->famili);        
                }
                if(!in_array($request->genus, ["null",null])){
                    $ikan = $ikan->where('genus',$request->genus);        
                }
                if(!in_array($request->spesies, ["null",null])){
                    $ikan = $ikan->where('spesies',$request->spesies);        
                } 
                $ikan = $ikan->get();
            }
            // dd($ikan->toSql());

            $ikanMap = $ikan->transform(function ($item) {
                $files = \App\Helper\Utility::scanFiles(strtolower($item->spesies));
                $randomFile = count($files)>0? \App\Helper\Utility::loadAsset($files[array_rand($files)]) : \App\Helper\Utility::loadAsset('not_found.jpg');
                // $randomFile = \App\Helper\Utility::loadAsset('not_found.jpg');

                return [
                    "habitat"                   => $item->habitat,
                    "foto"                      => $randomFile,
                    "kategori"                  => $item->kategori,
                    "kingdom"                   => $item->kingdom,
                    "fillum"                    => $item->fillum,
                    "super_kelas"               => $item->super_kelas,
                    "kelas"                     => $item->kelas,
                    "ordo"                      => $item->ordo,
                    "famili"                    => $item->famili,
                    "genus"                     => $item->genus,
                    "spesies"                   => $item->spesies,
                    "nama_daerah"               => $item->nama_daerah,
                    "pengarang"                 => $item->pengarang,
                    "karakteristik_morfologi"   => htmlspecialchars_decode($item->karakteristik_morfologi),
                    "kemunculan"                => $item->kemunculan,
                    "panjang_maksimal"          => $item->panjang_maksimal,
                    "status_konservasi"         => $item->status_konservasi,
                    "status_konservasi_tahun"   => $item->status_konservasi_tahun,
                    "id_genom"                  => $item->id_genom,
                    "upaya_konservasi"          => htmlspecialchars_decode($item->upaya_konservasi),
                    "distribusi"                => $item->distribusi,
                    "komentar"                  => $item->komentar,
                ];
            });
            
            return json_encode($ikanMap);
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
