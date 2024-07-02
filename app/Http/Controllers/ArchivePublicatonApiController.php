<?php

namespace App\Http\Controllers;

use App\Models\ArsipPublikasi;
use Exception;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables as DataTables;

class ArchivePublicatonApiController extends Controller
{
    public function index(Request $request){
        try {
            $list = ArsipPublikasi::orderBy('id','desc')->get();
            return DataTables::of($list)
                ->addIndexColumn()
                ->addColumn('arsip_custom', function ($row){
                    $render = '<a class="link-underline link-underline-opacity-0 text-white" href="'.(empty($row->url)? "#":$row->url).'">'.$row->arsip.'</a>';

                    return $render;
                })
                ->rawColumns(['arsip_custom'])
                ->make(true);
        } catch (Exception $e) {
            throw $e;
        }
    }
}
