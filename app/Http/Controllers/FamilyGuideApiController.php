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
                "message"=>$e->getMessage(),
                "data"=>[],
            ]);
        }
    }

    public function list(Request $request){
        try {
            ///dd($request->all());
            $ikan = null;
            if(
                $request->fillum == null &&
                $request->super_kelas == null &&
                $request->kelas == null &&
                $request->ordo == null &&
                $request->famili == null &&
                $request->genus == null &&
                $request->spesies == null
            ){
                $ikan = Ikan::all();
            } else{
                $ikan = DB::table("ikan");
                if($request->fillum!=null){
                    $ikan = $ikan->where('fillum',$request->fillum);        
                }
                if($request->super_kelas!=null){
                    $ikan = $ikan->where('super_kelas',$request->super_kelas);        
                }
                if($request->kelas!=null){
                    $ikan = $ikan->where('kelas',$request->kelas);        
                }
                if($request->ordo!=null){
                    $ikan = $ikan->where('ordo',$request->ordo);        
                }
                if($request->famili!=null){
                    $ikan = $ikan->where('famili',$request->famili);        
                }
                if($request->genus!=null){
                    $ikan = $ikan->where('genus',$request->genus);        
                }
                if($request->spesies!=null){
                    $ikan = $ikan->where('spesies',$request->spesies);        
                } 
                $ikan = $ikan->get();
            }
            // dd($ikan->toSql());

            $ikanMap = $ikan->transform(function ($item) {
                $files = \App\Helper\Utility::scanFiles($item->spesies);
                $randomFile = count($files)>0? \App\Helper\Utility::loadAsset($files[array_rand($files)]) : \App\Helper\Utility::loadAsset('not_found.jpg');
                // $randomFile = \App\Helper\Utility::loadAsset('not_found.jpg');

                return [
                    "habitat"                   => $item->habitat,
                    "foto"                      => $randomFile,
                    "kategori"                  => $item->kategori,
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
                "message"=>$e->getMessage(),
                "data"=>[],
            ]);
        }
    }
}
