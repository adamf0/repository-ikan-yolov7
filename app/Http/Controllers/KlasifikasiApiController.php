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
                        $ikan = Ikan::where('spesies','like', '%'.$item["name"].'%')->fisrtOrFail();
                        $directoryPath = 'public/Acanthocybium solandri';
                        $files = Storage::files($directoryPath);
                        $randomFile = count($files)>0? asset('storage/' . $files[array_rand($files)]):"https://upload.wikimedia.org/wikipedia/commons/thumb/b/b5/Oreochromis_mossambicus_by_NPS.jpg/500px-Oreochromis_mossambicus_by_NPS.jpg";
                        
                        $datas[$item["name"]] = [
                            "foto"                      => $randomFile,
                            "kategori"                  => $ikan->kategori,
                            "fillum"                    => $ikan->fillum,
                            "super_kelas"               => $ikan->super_kelas,
                            "kelas"                     => $ikan->kelas,
                            "ordo"                      => $ikan->ordo,
                            "famili"                    => $ikan->famili,
                            "genus"                     => $ikan->genus,
                            "spesies"                   => $ikan->spesies,
                            "nama_daerah"               => $ikan->nama_daerah,
                            "pengarang"                 => $ikan->pengarang,
                            "karakteristik_morfologi"   => $ikan->karakteristik_morfologi,
                            "kemunculan"                => $ikan->kemunculan,
                            "panjang_maksimal"          => $ikan->panjang_maksimal,
                            "status_konservasi"         => $ikan->status_konservasi,
                            "id_genom"                  => $ikan->id_genom,
                            "upaya_konservasi"          => $ikan->upaya_konservasi,
                            "distribusi"                => $ikan->distribusi,
                            "kometar"                   => $ikan->kometar,
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
                "message"=>$e->getMessage(),
                "data"=>[],
            ]);
        }
    }
}
