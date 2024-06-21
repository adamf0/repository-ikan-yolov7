<?php

namespace App\Console\Commands;

use App\Models\MemberProject;
use Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class UpdateInviteProject extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:invite-project';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'perintah update undangan project; cronjob; per 5 menit;';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        try {
            $project = MemberProject::where(DB::raw("CAST(ADDDATE(tanggal_pengajuan, INTERVAL 3 DAY) AS DATE)"), date('Y-m-d'))->where('status','menunggu');
            if($project->count()){
                $project->update(['status' => 'expire']);
                echo "selesai update undangan project menjadi expire";
            } else{
                echo "tidak ada data undangan project yg perlu diupdate";
            }   
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}
