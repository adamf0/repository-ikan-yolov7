<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Exception;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables as DataTables;

class VideoApiController extends Controller
{
    public function index(Request $request){
        try {
            $list = Video::orderBy('id','desc')->get();
            return DataTables::of($list)
                ->addIndexColumn()
                ->addColumn('action', function ($row){
                    $render = '
                    <a href="'.route('video.edit',['id'=>$row->id]).'" class="btn btn-warning"><i class="bi bi-pencil-square"></i></a>
                    <a href="'.route('video.delete',['id'=>$row->id]).'" class="btn btn-danger"><i class="bi bi-trash"></i></a>
                    ';

                    return $render;
                })
                ->rawColumns(['action'])
                ->make(true);
        } catch (Exception $e) {
            throw $e;
        }
    }
}
