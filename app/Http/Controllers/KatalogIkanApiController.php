<?php

namespace App\Http\Controllers;

use App\Models\Ikan;
use Exception;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables as DataTables;

class KatalogIkanApiController extends Controller
{
    public function index(Request $request){
        try {
            $list = Ikan::orderBy('id','desc')->get()->map(function($item){
                $item->upaya_konservasi = htmlspecialchars_decode($item->upaya_konservasi);
                $item->karakteristik_morfologi = htmlspecialchars_decode($item->karakteristik_morfologi);
                return $item;
            });
            return DataTables::of($list)
                ->addIndexColumn()
                ->addColumn('action', function ($row){
                    $render = '
                    <a href="#" class="btn btn-primary btn-detail">Detail</a>
                    <a href="'.route('katalog_ikan.edit',['id'=>$row->id]).'" class="btn btn-warning"><i class="bi bi-pencil-square"></i></a>
                    <a href="'.route('katalog_ikan.delete',['id'=>$row->id]).'" class="btn btn-danger"><i class="bi bi-trash"></i></a>
                    ';

                    return $render;
                })
                ->rawColumns(['action','karakteristik_morfologi','upaya_konservasi'])
                ->make(true);
        } catch (Exception $e) {
            throw $e;
        }
    }
    public function detail($id){
        try {
            $ikan = Ikan::where('id',$id)->firstOrFail();
            $ikan->upaya_konservasi = htmlspecialchars_decode($ikan->upaya_konservasi);
            $ikan->karakteristik_morfologi = htmlspecialchars_decode($ikan->karakteristik_morfologi);
            $ikan->komentar = htmlspecialchars_decode($ikan->komentar);
            
            $files = \App\Helper\Utility::scanFiles($ikan->spesies);
            $ikan->list_foto = count($files)>0? array_map(function($file){
                $file = \App\Helper\Utility::loadAsset($file);
                return $file;
            },$files): [\App\Helper\Utility::loadAsset('not_found.jpg')];

            return json_encode([
                "status"=>"ok",
                "message"=>null,
                "data"=>$ikan
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
