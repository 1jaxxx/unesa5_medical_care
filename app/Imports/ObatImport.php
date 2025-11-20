<?php

namespace App\Imports;

use App\Models\Obat;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ObatImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Obat([
            'nama_obat' => $row['nama_obat'],
            'jenis_obat' => $row['jenis_obat'],
            'tgl_kadaluarsa' => $row['tgl_kadaluarsa'],
            'stok' => $row['stok'],
        ]);
    }
}
