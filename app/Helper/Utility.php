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
}