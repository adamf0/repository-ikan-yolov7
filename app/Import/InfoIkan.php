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
            "fillum"                    => $row[1]??"",
            "super_kelas"               => $row[2]??"",
            "kelas"                     => $row[3]??"",
            "ordo"                      => $row[4]??"",
            "famili"                    => $row[5]??"",
            "genus"                     => $row[6]??"",
            "spesies"                   => $row[7]??"",
            "nama_daerah"               => $row[8]??"",
            "pengarang"                 => $row[9]??"",
            "karakteristik_morfologi"   => $row[10]??"",
            "kemunculan"                => $row[11]??"",
            "panjang_maksimal"          => $row[12]??"",
            "status_konservasi"         => $row[13]??"",
            "id_genom"                  => $row[14]??"",
            "upaya_konservasi"          => $row[15]??"",
            "distribusi"                => $row[16]??"",
            "kometar"                   => $row[17]??"",
            "foto"                      => $row[18]??"",
        ]);
    }
}