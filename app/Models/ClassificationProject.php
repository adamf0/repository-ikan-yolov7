<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassificationProject extends Model
{
    use HasFactory;
    protected $table = 'classification_project';
    protected $fillable = [
        "id_project",
        "result"
    ];

    // public function Project(){
    //     return $this->hasMany(Project::class, 'id_project', 'id');
    // }
}
