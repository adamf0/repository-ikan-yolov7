<?php

namespace App\Import;

use App\Models\Ikan;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class InfoIkan implements ToModel, WithStartRow
{
    public function startRow(): int
    {
        return 2;
    }
    public function model(array $row)
    {
        return new Ikan([
            "kategori"                  => $row[0]??"",
            "kingdom"                   => $row[1]??"",
            "fillum"                    => $row[2]??"",
            "super_kelas"               => $row[3]??"",
            "kelas"                     => $row[4]??"",
            "ordo"                      => $row[5]??"",
            "famili"                    => $row[6]??"",
            "genus"                     => $row[7]??"",
            "spesies"                   => $row[8]??"",
            "nama_daerah"               => $row[9]??"",
            "pengarang"                 => $row[10]??"",
            "karakteristik_morfologi"   => $row[11]??"",
            "kemunculan"                => $row[12]??"",
            "panjang_maksimal"          => $row[13]??"",
            "status_konservasi"         => $row[14]??"",
            "id_genom"                  => $row[15]??"",
            "upaya_konservasi"          => $row[16]??"",
            "distribusi"                => $row[17]??"",
            "kometar"                   => $row[18]??"",
            "foto"                      => $row[19]??"",
        ]);
    }
}