<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use App\Helper\Utility;

class CkeditorApiController extends Controller
{
    public function upload(Request $request){
        try {
            if($request->hasFile('upload')){
                // $originalName = $request->file('upload')->getClientOriginalName();
                // $fileName = pathinfo($originalName, PATHINFO_FILENAME);
                // $extension = $request->file('upload')->getClientOriginalExtension();
                // $fileName = $fileName."_".time().".".$extension;

                // $request->file('upload')->move(public_path('ckeditor_img'), $fileName);
                // $url = Utility::loadAsset("ckeditor_img/{$fileName}");

                $file = $request->file('upload');
                $originalName = $file->getClientOriginalName();
                $fileName = pathinfo($originalName, PATHINFO_FILENAME);
                $extension = $file->getClientOriginalExtension();
                
                $fileContents = file_get_contents($file->getPathname());
                $base64 = base64_encode($fileContents);
                $base64Url = 'data:image/' . $extension . ';base64,' . $base64;

                return response()->json([
                    "fileName"=>$fileName,
                    "uploaded"=>1,
                    "url"=>$base64Url,
                ]);
            }
        } catch (Exception $e) {
            throw $e;
        }
    }
}
