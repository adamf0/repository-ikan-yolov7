<?php

namespace App\Http\Controllers;

use App\Jobs\SendInviteProjectJob;
use App\Models\MemberProject;
use App\Models\Project;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProjectApiController extends Controller
{
    public function list(Request $request,$id_user){
        try {
            $page = $request->get("page")??1;
            $limit = $request->get("limit")??10;

            $project = Project::with(['IdentityCreator','Member','Member.IdentityMember'])->where('creator',$id_user)->orWhereHas('Member',function($query) use($id_user){
                $query->where('id_user',$id_user);
            });
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
                    "source"=>$project->offset($page-1*$limit)->limit($limit)->get(),
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
        try {
            $project            = new Project();
            $project->judul     = $request->judul;
            $project->deskripsi = $request->deskripsi;
            $project->id_user   = $request->id_user;
            $project->save();

            return json_encode([
                "status"=>"ok",
                "message"=>null,
                "data"=>$request->all()
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
    public function delete($id){
        try {
            Project::findOrFail($id)->delete();
           
            return json_encode([
                "status"=>"ok",
                "message"=>"berhasil hapus project",
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
    public function invite(Request $request){
        try {
            DB::beginTransaction();
            $project = Project::with('IdentityCreator')->where('id',$request->get('id_project'))->first();
            foreach($request->get('anggota') as $anggota){
                $anggota = User::where('id',$anggota)->first();
                $invite = MemberProject::where('id_project',$request->get('id_project'))->where('id_user',$anggota->id)->first();
                if(!empty($anggota)){
                    if(!is_null($invite) && $invite->status=='expire'){
                        $invite->status = "menunggu";
                        $invite->tanggal_pengajuan = date('Y-m-d H:i:s');
                        $invite->save();
                    } else if(is_null($invite)){
                        $invite = new MemberProject();
                        $invite->id_user = $anggota->id;
                        $invite->id_project = $request->get('id_project');
                        $invite->status = "menunggu";
                        $invite->tanggal_pengajuan = date('Y-m-d H:i:s');
                        $invite->save();
                    }
                    dispatch(new SendInviteProjectJob($anggota,$project,$invite));
                }
            }
            DB::commit();
 
            return json_encode([
                "status"=>"ok",
                "message"=>"berhasil kirim undangan",
                "data"=>$request->all()
            ]);
        } catch (Exception $e) {
            DB::rollBack();
            return json_encode([
                "status"=>"fail",
                "message"=>"ada masalah pada proses aplikasi",
                "log"=>$e->getMessage(),
                "data"=>[],
            ]);
        }
    }
}
