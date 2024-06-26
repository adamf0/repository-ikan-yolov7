<?php

namespace App\Http\Controllers;

use App\Models\Ikan;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Ramsey\Uuid\Uuid;

class KlasifikasiApiController extends Controller
{
    public function index(Request $request){
        try {
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $base64Image = base64_encode(file_get_contents($image->getPathName()));
                
                $url = env("YOLO_URL","localhost")."/classfication";
                $response = Http::withHeaders([
                    'Content-Type' => 'application/json',
                    'Accept' => 'application/json',
                ])->post($url,["image"=>$base64Image]);

                if (!$response->successful()) {
                    throw new Exception($response->json()['error']);
                }

                $responseData = $response->json()["body"];
                $datas = [];
                foreach($responseData["annotation"] as $item){
                    if(!array_key_exists($item["name"],$datas)){
                        $ikan = Ikan::where('spesies','like', '%'.$item["name"].'%')->firstOrFail();
                        // $directoryPath = 'public/'.$item["name"];
                        // $files = Storage::files($directoryPath);
                        $files = \App\Helper\Utility::scanFiles($item["name"]);
                        $randomFile = count($files)>0? \App\Helper\Utility::loadAsset($files[array_rand($files)]) : \App\Helper\Utility::loadAsset('not_found.jpg');
                        
                        $datas[$item["name"]] = [
                            "habitat"                   => $ikan->habitat,
                            "foto"                      => $randomFile,
                            "kategori"                  => $ikan->kategori,
                            "kingdom"                   => $ikan->kingdom,
                            "fillum"                    => $ikan->fillum,
                            "super_kelas"               => $ikan->super_kelas,
                            "kelas"                     => $ikan->kelas,
                            "ordo"                      => $ikan->ordo,
                            "famili"                    => $ikan->famili,
                            "genus"                     => $ikan->genus,
                            "spesies"                   => $ikan->spesies,
                            "nama_daerah"               => $ikan->nama_daerah,
                            "pengarang"                 => $ikan->pengarang,
                            "karakteristik_morfologi"   => htmlspecialchars_decode($ikan->karakteristik_morfologi),
                            "kemunculan"                => $ikan->kemunculan,
                            "panjang_maksimal"          => $ikan->panjang_maksimal,
                            "status_konservasi"         => $ikan->status_konservasi,
                            "status_konservasi_tahun"   => $ikan->status_konservasi_tahun,
                            "id_genom"                  => $ikan->id_genom,
                            "upaya_konservasi"          => htmlspecialchars_decode($ikan->upaya_konservasi),
                            "distribusi"                => $ikan->distribusi,
                            "komentar"                   => htmlspecialchars_decode($ikan->komentar),
                            "kotak_prediksi"            =>[
                                "confidence"=>$item["confidence"],
                                "xmax"=>$item["xmax"],
                                "xmin"=>$item["xmin"],
                                "ymax"=>$item["ymax"],
                                "ymin"=>$item["ymin"],
                            ]
                        ];
                    }
                };
                $datas["image"] = $responseData["img_result"];

                $key = ($request->ip()??Uuid::uuid4()->toString())."-".date("Ymdhis");
                $filePath = public_path($key.'.json');
                File::put($filePath, json_encode($datas));

                return json_encode([
                    "status"=>"ok",
                    "message"=>null,
                    "data"=>$key
                ]);
            } else {
                throw new Exception("belum upload gambar");
            }
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
