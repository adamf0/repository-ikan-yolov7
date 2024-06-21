<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;
    protected $table = 'project';
    protected $fillable = [
        "creator",
        "judul",
        "deskripsi",
        "foto",
    ];

    public function Member(){
        return $this->hasMany(MemberProject::class, 'id_project', 'id');
    }
    public function IdentityCreator(){
        return $this->hasOne(User::class, 'id', 'creator');
    }
    public function Classification(){
        return $this->hasMany(ClassificationProject::class, 'id_project', 'id');
    }
}
