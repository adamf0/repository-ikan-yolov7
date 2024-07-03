<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use Exception;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables as DataTables;

class BeritaApiController extends Controller
{
    public function index(Request $request){
        try {
            $list = Berita::orderBy('id','desc')->get();
            return DataTables::of($list)
                ->addIndexColumn()
                ->addColumn('kontent_deskripsi', function ($row){
                    return $row->kontent_deskripsi;
                })
                ->addColumn('action', function ($row){
                    $render = '
                    <a href="'.route('berita.edit',['id'=>$row->id]).'" class="btn btn-warning"><i class="bi bi-pencil-square"></i></a>
                    <a href="'.route('berita.delete',['id'=>$row->id]).'" class="btn btn-danger"><i class="bi bi-trash"></i></a>
                    ';

                    return $render;
                })
                ->addColumn('judul_url_scrapping', function ($row){
                    $render = !empty($row->url)? '<a href="'.$row->url.'">'.$row->judul.'</a>':$row->judul;
                    if($row->scrapping){
                        $render .= "<span class='badge bg-success'>Ambil dari gogle</span>";
                    }

                    return $render;
                })
                ->rawColumns(['action','judul_url_scrapping'])
                ->make(true);
        } catch (Exception $e) {
            throw $e;
        }
    }
}
