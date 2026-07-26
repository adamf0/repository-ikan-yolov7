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
    public function index(Request $request)
    {
        try {
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $base64Image = base64_encode(file_get_contents($image->getPathName()));
                
                $url = env("YOLO_URL", "https://www.fishiden.com/api2") . "/classfication";
                $response = Http::withHeaders([
                    'Content-Type' => 'application/json',
                    'Accept' => 'application/json',
                ])->post($url, ["image" => $base64Image]);

                if (!$response->successful()) {
                    $resJson = $response->json();
                    $errMsg = is_array($resJson) && isset($resJson['error']) ? $resJson['error'] : (is_array($resJson) && isset($resJson['message']) ? $resJson['message'] : 'Gagal terhubung ke service klasifikasi YOLO (HTTP '.$response->status().')');
                    throw new Exception($errMsg);
                }

                $responseData = $response->json()["body"];
                $datas = [];
                $list_predic = [];
                foreach ($responseData["annotation"] as $item) {
                    if (!array_key_exists($item["name"], $datas)) {
                        $ikan = Ikan::where('spesies', 'like', '%' . $item["name"] . '%')->firstOrFail();

                        $key = array_search($ikan->id, array_column($list_predic, 'id_ikan'));
                        if ($key !== false) {
                            continue;
                        }
                        $list_predic[] = [
                            "id_ikan" => $ikan->id,
                            "type" => "prediksi",
                            "akurasi" => $item["confidence"],
                        ];
                    }
                };
                $fileName = ($request->ip() ?? Uuid::uuid4()->toString()) . "_" . uniqid() . ".png";
                $image->move(public_path('Prediksi'), $fileName);

                $datas["predic"] = array_values($list_predic);
                $datas["image"] = $fileName;

                $key = ($request->ip() ?? Uuid::uuid4()->toString()) . "-" . date("Ymdhis");
                $filePath = public_path($key . '.json');
                File::put($filePath, json_encode($datas));

                return json_encode([
                    "status" => "ok",
                    "message" => null,
                    "data" => $key
                ]);
            } else {
                throw new Exception("belum upload gambar");
            }
        } catch (Exception $e) {
            return json_encode([
                "status" => "fail",
                "message" => "ada masalah pada proses aplikasi",
                "log" => $e->getMessage(),
                "data" => [],
            ]);
        }
    }
}
