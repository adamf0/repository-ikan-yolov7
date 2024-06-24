<?php

namespace App\Http\Controllers;

use App\Models\ClassificationProject;
use App\Models\Ikan;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ClassificationProjectApiController extends Controller
{
    public function list(Request $request,$id_project){
        try {
            $page = $request->get("page")??1;
            $limit = $request->get("limit")??10;

            $project = ClassificationProject::where('id_project',$id_project);
            $total_data = $project->count();
            $total_page = ceil($total_data / $limit);

            return json_encode([
                "status"=>"ok",
                "message"=>null,
                "data"=>[
                    "total_data"=>$total_data,
                    "total_page"=>$total_page,
                    "active_prev"=>$page<=$total_page && $page>1,
                    "active_next"=> $page>=1 && $page<$total_page,
                    "page"=>$page,
                    "limit"=>$limit,
                    "source"=>$project->offset($page-1*$limit)->limit($limit)->get()->map(function($item){
                        $item->result = json_decode($item->result, true);

                        return $item;
                    }),
                ]
            ]);
        } catch (Exception $e) {
            return json_encode([
                "status"=>"fail",
                "message"=>"ada masalah pada proses aplikasi",
                "log"=>$e->getMessage(),
                "data"=>[],
            ]);
        }
    }
    public function store(Request $request){
        ini_set('upload_max_filesize', '10M');
        ini_set('post_max_size', '10M');

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
                            "komentar"                   => $ikan->komentar,
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

                $classProject = new ClassificationProject();
                $classProject->id_project = $request->id_project;
                $classProject->result = json_encode($datas);
                $classProject->save();

                return json_encode([
                    "status"=>"ok",
                    "message"=>null,
                    "data"=>$request->all()
                ]);
            } else {
                throw new Exception("belum upload gambar");
            }
        } catch (Exception $e) {
            return json_encode([
                "status"=>"fail",
                "message"=>"ada masalah pada proses aplikasi",
                "log"=>$request->file('image')?->getPathName(),
                "data"=>[],
            ]);
        }
    }
    public function delete($id){
        try {
            ClassificationProject::findOrFail($id)->delete();
           
            return json_encode([
                "status"=>"ok",
                "message"=>"berhasil hapus gambar klasifikasi",
                "data"=>null
            ]);
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
