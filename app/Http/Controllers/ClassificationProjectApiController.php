<?php

namespace App\Http\Controllers;

use App\Models\ClassificationProject;
use App\Models\Ikan;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Helper\Utility;

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
                        $result = json_decode($item->result, true);
                        $list_ikan = collect([]);
                        foreach($result['predic'] as $r){
                            $ikan = Ikan::where('id',$r['id_ikan'])->first();
                            if(!is_null($ikan)){
                                $ikan->type = $r['type'];
                                $ikan->akurasi = $r['type']=="edited"? 0:$r['akurasi'];
                                $list_ikan->push($ikan);
                            }
                        }
                        $item->list_ikan = $list_ikan;
                        $item->gambar_upload = Utility::loadasset("Prediksi/".$result['image']);
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
    public function save(Request $request){
        ini_set('upload_max_filesize', '100M');
        ini_set('post_max_size', '100M');

        try {
            if ($request->has('image')) { //base64
                // $image = $request->file('image');
                // $base64Image = base64_encode(file_get_contents($image->getPathName()));
                foreach($request->get('image') as $image){
                    // $pattern = '/^data:image\/([a-zA-Z]*);base64,/';
                    // $base64String = preg_replace($pattern, '', $image);
                    $base64String = $image;
                    
                    $url = env("YOLO_URL","localhost")."/classfication";
                    $response = Http::withHeaders([
                        'Content-Type' => 'application/json',
                        'Accept' => 'application/json',
                    ])->post($url,["image"=>$base64String]);
    
                    if (!$response->successful()) {
                        throw new Exception($response->json()['error']);
                    }
    
                    $responseData = $response->json()["body"];
                    $datas = [];
                    $list_predic = [];
                    foreach($responseData["annotation"] as $item){
                        if(!array_key_exists($item["name"],$datas)){
                            $ikan = Ikan::where('spesies','like', '%'.$item["name"].'%')->firstOrFail();
                            // $directoryPath = 'public/'.$item["name"];
                            // $files = Storage::files($directoryPath);
                            // $files = \App\Helper\Utility::scanFiles($item["name"]);
                            // $randomFile = count($files)>0? \App\Helper\Utility::loadAsset($files[array_rand($files)]) : \App\Helper\Utility::loadAsset('not_found.jpg');
                            
                            $key = array_search($ikan->id, array_column($list_predic, 'id_ikan'));
                            if($key !== false){
                                continue;
                            }
                            $list_predic[] = [
                                "id_ikan"=>$ikan->id,
                                "type"=>"prediksi",
                                "akurasi"=>$item["confidence"],
                            ];
                        }
                    };
                    $fileName = $request->id_project."_".uniqid().".png";
                    $savePath = public_path(sprintf("Prediksi/%s", $fileName));
                    file_put_contents($savePath, base64_decode($image));
                    
                    $datas["predic"] = array_values(array_unique($list_predic));
                    $datas["image"] = $fileName;
    
                    $classProject = new ClassificationProject();
                    $classProject->id_project = $request->id_project;
                    $classProject->result = json_encode($datas);
                    $classProject->save();
                }

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
                "log"=>$e->getMessage(),
                "data"=>$request->all(),
            ]);
        }
    }
    public function destroy($id_project){
        try {
            ClassificationProject::findOrFail($id_project)->delete();
           
            return json_encode([
                "status"=>"ok",
                "message"=>"berhasil hapus gambar",
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

    public function store(Request $request){
        try {
            $data = ClassificationProject::where('id',$request->get('referensi_baru'))->firstOrFail();
            $result = json_decode($data->result, true);
            $result['predic'][] = [
                'id_ikan'=>$request->get('spesies_baru'),
                'type'=>'edited',
            ];
            $data->result = json_encode($result);
            $data->save();

            return json_encode([
                "status"=>"ok",
                "message"=>"berhasil tambah klasifikasi gambar",
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
    public function update(Request $request){
        try {
            $data = ClassificationProject::where('id',$request->get('referensi_update'))->firstOrFail();
            $result = json_decode($data->result, true);
            if(!empty($request->get('spesies_sebelum'))){
                $index = array_search($request->get('spesies_sebelum'), array_column($result['predic'], 'id_ikan'));
                if ($index !== false) {
                    $result['predic'][$index]['id_ikan']    = $request->get('spesies_sesudah');
                    $result['predic'][$index]['type']       = 'edited';
                }
                $data->result = json_encode($result);
            } else if(!empty($request->get('spesies_sesudah'))){
                $result['predic'][] = [
                    'id_ikan'=>$request->get('spesies_sesudah'),
                    'type'=>'edited',
                ];
                $data->result = json_encode($result);
            }
            $data->save();

            return json_encode([
                "status"=>"ok",
                "message"=>"berhasil update klasifikasi gambar",
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
    public function delete($id_project,$id){
        try {
            $data = ClassificationProject::where('id',$id_project)->firstOrFail();
            $result = json_decode($data->result, true);
            $index = array_search($id, array_column($result['predic'], 'id_ikan'));
            unset($result['predic'][$index]);
            
            $data->result = json_encode($result);
            $data->save();
           
            return json_encode([
                "status"=>"ok",
                "message"=>"berhasil hapus klasifikasi gambar",
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
