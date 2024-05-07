<?php

namespace App\Http\Controllers;

use App\Models\Ikan;
use Exception;
use Illuminate\Http\Request;

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
            $ikan = Ikan::all()->groupBy([
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
}
