<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\File;
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
                    $dataPredic = [
                        "confidence"=>$item["confidence"],
                        "xmax"=>$item["xmax"],
                        "xmin"=>$item["xmin"],
                        "ymax"=>$item["ymax"],
                        "ymin"=>$item["ymin"],
                    ];

                    if(!array_key_exists($item["name"],$datas)){
                        $datas[$item["name"]] = [
                            "foto"=>"https://upload.wikimedia.org/wikipedia/commons/thumb/b/b5/Oreochromis_mossambicus_by_NPS.jpg/500px-Oreochromis_mossambicus_by_NPS.jpg",
                            "kerajaan"          =>"Animalia",
                            "filum"             =>"Chordata",
                            "kelas"             =>"Actinopterygii",
                            "ordo"              =>"Perciformes",
                            "famili"            =>"Cichlidae",
                            "genus"             =>"Oreochromis",
                            "spesies"           =>"O. Mossambicus",
                            "karakteristik"     =>[
                                "Ikan Berukuran Sedang, Panjang Total Maksimum Yang Dapat Dicapai Ikan Mujair Adalah Sekitar 40 Cm. Bentuk Badannya Pipih Dengan Warna Hitam, Keabu-Abuan, Kecokelatan Atau Kuning.",
                                "Sirip Punggungnya (Dorsal) Memiliki 15–17 Duri (Tajam) Dan 10–13 Jari-Jari (Duri Berujung Lunak); Dan Sirip Dubur (Anal) Dengan 3 Duri Dan 9–12 Jari-Jari."
                            ],
                            "genom"             =>"AUG UCU GAC UGA",
                            "status_konservasi" =>"VU",
                            "upaya_konservasi"  =>"dalam upaya kloning dengan sisa genetik yang telah terselamatkan sebelumnya",
                            "kotak_prediksi"    =>[]
                        ];
                    }
                    $datas[$item["name"]]["kotak_prediksi"][] = $dataPredic;
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
