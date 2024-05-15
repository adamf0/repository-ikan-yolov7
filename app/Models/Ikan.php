<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ikan extends Model
{
    use HasFactory;
    protected $table = 'ikan';
    protected $fillable = [
        "habitat",
        "kategori",
        "fillum",
        "super_kelas",
        "kelas",
        "ordo",
        "famili",
        "genus",
        "spesies",
        "nama_daerah",
        "pengarang",
        "karakteristik_morfologi",
        "kemunculan",
        "panjang_maksimal",
        "status_konservasi",
        "status_konservasi_tahun",
        "id_genom",
        "upaya_konservasi",
        "distribusi",
        "kometar",
        "foto",
    ];
}
