<?php

namespace App\Http\Controllers;

use App\Models\ArsipPublikasi;
use Exception;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables as DataTables;

class ArsipPublikasiApiController extends Controller
{
    public function index(Request $request){
        try {
            $list = ArsipPublikasi::orderBy('id','desc')->get();
            return DataTables::of($list)
                ->addIndexColumn()
                ->addColumn('action', function ($row){
                    $render = '
                    <a href="'.route('arsip_publikasi.edit',['id'=>$row->id]).'" class="btn btn-warning"><i class="bi bi-pencil-square"></i></a>
                    <a href="'.route('arsip_publikasi.delete',['id'=>$row->id]).'" class="btn btn-danger"><i class="bi bi-trash"></i></a>
                    ';

                    return $render;
                })
                ->addColumn('arsip_url', function ($row){
                    $render = !empty($row->url)? '<a href="'.$row->url.'">'.$row->arsip.'</a>':$row->arsip;

                    return $render;
                })
                ->rawColumns(['action','arsip_url'])
                ->make(true);
        } catch (Exception $e) {
            throw $e;
        }
    }
}
