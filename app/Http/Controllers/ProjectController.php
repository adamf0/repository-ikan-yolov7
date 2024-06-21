<?php

namespace App\Http\Controllers;

use App\Models\MemberProject;
use App\Models\Project;
use Exception;

class ProjectController extends Controller
{
    public function index(){
        // return Hash::make('123');
        return view('project.index');
    }
    public function detail($id){
        $project = Project::find($id);
        return view('project.detail',["project"=>$project]);
    }
    public function verifyInvite($id_member){
        try {
            $member = MemberProject::find(base64_decode($id_member));
            if($member->status=='expire' || strtotime(date('Y-m-d H:i:s'))>=strtotime($member->tanggal_pengajuan." +3 days")){
                return view('project.invite',["type"=>'fail', 'message'=>'undangan sudah expired, hubungi pemilih project untuk kirim undangan kembali','log'=>'']);
            } else{
                $member->status = "terima";
                $member->tanggal_bergabung = date('Y-m-d H:i:s');
                $member->save();
                return view('project.invite',["type"=>'success', 'message'=>'berhasil terima undangan project','log'=>'']);
            }
        } catch (Exception $e) {
            throw $e;
            return view('project.invite',["type"=>'error', 'message'=>'terjadi masalah pada aplikasi','log'=>$e->getMessage()]);
        }
    }
}
