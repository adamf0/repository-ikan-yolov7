<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        if(Auth::user()==null){
            $total_pengguna = User::get()->count();
            $detail_pengguna = User::where('created_at', date('Y-m-d'))->get()->count() - $total_pengguna;
            $total_project = Project::get()->count();
            $detail_project = Project::where('created_at', date('Y-m-d'))->get()->count() - $total_project;

            ///grafik 1
            // $jsonString = file_get_contents(public_path('list_negara.json'));
            // $jsonData = json_decode($jsonString, true);
            // $list_negara = array_reduce($jsonData, function ($carry, $item) {
            //     $carry[] = $item["name"]["common"];
            //     return $carry;
            // }, []);
            $list_negara = User::get()->map(function($item){
                if(empty($item->negara)){
                    $item->negara = "Tidak Negara";
                }
                return $item;
            })->pluck('negara')->unique()->values()->toArray();

            $list = array_map(function ($item) {
                $start_date = now()->format('Y-01');
                $end_date = now()->addMonth(12)->format('Y-01');

                $users = User::where('negara', $item)
                    ->get()
                    ->groupBy(function ($date) {
                        return Carbon::parse($date->created_at)->format('Y-m-01');
                    });

                $data = [];
                $current_date = Carbon::parse($start_date);
                $end_date = Carbon::parse($end_date);

                while ($current_date <= $end_date) {
                    $date = $current_date->format('Y-m-01');
                    $list3[] =
                        $data[$date] = [$date, 0];
                    $current_date->addMonth();
                }

                foreach ($users as $date => $user) {
                    $data[$date] = [$date, count($user)];
                }

                return [
                    "name" => $item,
                    "data" => array_values($data)
                ];
            }, $list_negara);

            ///grafik 2
            $list2 = [];
            $user = User::get();
            $userLengkap = $user->filter(function ($item) {
                return !empty($item->nama) &&
                    !empty($item->pekerjaan) &&
                    // !empty($item->instansi) &&
                    !empty($item->negara) &&
                    // !empty($item->latitude) &&	
                    // !empty($item->longitude) &&	
                    // !empty($item->bidang_keahlian) &&
                    // !empty($item->foto) &&
                    !empty($item->email);
            })->values();
            if ($userLengkap->count()) {
                $list2[] = [
                    "id" => "lengkap",
                    "parent" => "",
                    "name" => "lengkap",
                ];
            } else {
                $list2[] = [
                    "id" => "lengkap",
                    "parent" => "",
                    "name" => "lengkap",
                    "value" => $userLengkap->count(),
                ];
            }
            $userNegara = $userLengkap->pluck("negara")->unique();
            $userPekerjaan = $userLengkap->pluck("pekerjaan")->unique();
            foreach ($userNegara as $negara) {
                $list2[] = [
                    "id" => $negara . "L",
                    "parent" => "lengkap",
                    "name" => $negara,
                    "value" => $userLengkap->where('negara', $negara)->values()->count(),
                ];

                foreach ($userPekerjaan as $pekerjaan) {
                    $list2[] = [
                        "id" => $pekerjaan . "L",
                        "parent" => $negara . "L",
                        "name" => $pekerjaan,
                        "value" => $userLengkap->where('negara', $negara)->where('pekerjaan', $pekerjaan)->values()->count(),
                    ];
                }
            }

            $userTidakLengkap = $user->filter(function ($item) {
                return empty($item->nama) ||
                    empty($item->pekerjaan) ||
                    // !empty($item->instansi) ||
                    empty($item->negara) ||
                    // !empty($item->latitude) ||	
                    // !empty($item->longitude) ||	
                    // !empty($item->bidang_keahlian) ||
                    // !empty($item->foto) ||
                    empty($item->email);
            })->values();
            $list2[] = [
                "id" => "tidak lengkap",
                "parent" => "",
                "name" => "tidak lengkap"
            ];

            $userNegara = $userTidakLengkap->pluck("negara")->unique();
            $userPekerjaan = $userTidakLengkap->pluck("pekerjaan")->unique();
            foreach ($userNegara as $negara) {
                $idKey = !empty($negara) ? $negara : "tanpa_negara";
                if ( array_search($idKey, array_column($list2, 'id'))==false ) {
                    $list2[] = [
                        "id" => $idKey,
                        "parent" => "tidak lengkap",
                        "name" => !empty($negara) ? $negara : "Tanpa Negara",
                        "value" => $userTidakLengkap->where('negara', $negara)->values()->count(),
                    ];
                }

                foreach ($userPekerjaan as $pekerjaan) {
                    $idKey = !empty($pekerjaan) ? $pekerjaan : "tanpa_pekerjaan";
                    if ( array_search($idKey, array_column($list2, 'id'))==false ) {
                        $list2[] = [
                            "id" => $idKey,
                            "parent" => !empty($negara) ? $negara : "tanpa_negara",
                            "name" => !empty($pekerjaan) ? $pekerjaan : "Tanpa Pekerjaan",
                            "value" => $userTidakLengkap->where('negara', $negara)->where('pekerjaan', $pekerjaan)->values()->count(),
                        ];   
                    }
                }
            }
            $checkParentTidakLengkap = array_filter($list2,function($item){
                return $item['parent']=="tidak lengkap";
            });
            if(count($checkParentTidakLengkap)==0){
                $index = array_search("tidak lengkap", array_column($list2, "id"));;
                $list2[$index]["value"] = 0;
            }
            
            //grafik 3
            $matrix = []; //DB::select('CALL generate_heap_project_matrix()');
            $matrix = count($matrix)==0? []:(array) $matrix[0];
            if (array_key_exists('id', $matrix)) {
                unset($matrix['id']);
            }
            $list3 = [];
            foreach($matrix as $key => $value){
                $list3[] = [
                    "count"=>$value,
                    "date"=>$key,
                ];
            }

            return view('dashboard.index', [
                "level" => "sdm",
                "total_pengguna" => $total_pengguna,
                "detail_pengguna" => $detail_pengguna,
                "total_project" => $total_project,
                "detail_project" => $detail_project,
                "info_pendaftaran_pengguna" => json_encode($list),
                "info_persebaran_pengguna" => json_encode($list2),
                "info_aktifitas_project" => json_encode($list3)
            ]);
        } else{
            $user = Auth::user();
            if(
                !empty($user->nama) &&
                !empty($user->pekerjaan) &&
                // !empty($user->instansi) &&
                !empty($user->negara) &&
                // !empty($user->latitude) &&	
                // !empty($user->longitude) &&	
                // !empty($user->bidang_keahlian) &&
                // !empty($user->foto) &&
                !empty($user->email)
            ){
                $user->setup_profile = true;
            } else{
                $user->setup_profile = false;
            }
            
            return view('dashboard.index', [
                "level" => "user",
                "user" => Auth::user(),
            ]);
        }
    }
}
