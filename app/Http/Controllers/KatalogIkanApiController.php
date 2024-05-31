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
}
