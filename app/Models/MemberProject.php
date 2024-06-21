<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MemberProject extends Model
{
    use HasFactory;
    protected $table = 'member_project';
    protected $fillable = [
        "id_project",
        "id_user",
        "status",
        "tanggal_pengajuan",
        "tanggal_bergabung",
    ];

    public function IdentityMember(){
        return $this->hasOne(User::class, 'id', 'id_user');
    }
}
