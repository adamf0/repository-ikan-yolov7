<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArsipPublikasi extends Model
{
    use HasFactory;
    protected $table = 'arsip_publikasi';
    protected $fillable = [
        "tahun",
        "sitasi",
        "url",
    ];
}
