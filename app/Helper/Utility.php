<?php

namespace App\Helper;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

trait Utility
{
    public static function showNotif()
    {
        return AlertNotif::show();
    }
    public static function stateMenu($segment=[],Request $request)
    {
        if(count($segment)==0) throw new Exception('invalid argument');

        return in_array($request->segments()[0],$segment);
    }
    public static function getName()
    {
        return Session::get('name') ?? 'N/A';
    }
    public static function getLevel($toLower=false)
    {
        return match (Session::get('levelActive')) {
            "admin"     => $toLower? "admin":"Admin",
            default     => $toLower? "n/a":"N/A"
        };
    }
    public static function getLevels()
    {
        return Session::get('level');
    }
    public static function loadAsset($path)
    {
        return env('DEPLOY', 'dev') == 'dev' ? asset($path) : secure_asset($path);
    }
}
