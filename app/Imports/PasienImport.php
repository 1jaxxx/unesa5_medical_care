<?php

namespace App\Imports;

use App\Models\Mahasiswa;
use App\Models\Dosen;
use App\Models\Staff;
use App\Models\Prodi;
use Maatwebsite\Excel\Concerns\OnEachRow;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Row;

class PasienImport implements OnEachRow, WithHeadingRow
{
    public function onRow(Row $row)
    {
        $rowIndex = $row->getIndex();
        $row      = $row->toArray();

        $jenis_kelamin = ($row['jenis_kelamin'] == 'Laki-laki') ? 'L' : 'P';

        if ($row['tipe'] == 'mahasiswa') {
            $prodi = Prodi::where('nama_prodi', $row['prodi'])->first();
            Mahasiswa::create([
                'nama' => $row['nama'],
                'nim' => $row['identifier'],
                'jenis_kelamin' => $jenis_kelamin,
                'tgl_lahir' => $row['tanggal_lahir'],
                'tempat_lahir' => $row['tempat_lahir'],
                'id_prodi' => $prodi ? $prodi->id_prodi : null,
                'email' => $row['email'],
                'no_telp' => $row['no_telp'],
            ]);
        } elseif ($row['tipe'] == 'dosen') {
            Dosen::create([
                'nama' => $row['nama'],
                'nidn' => $row['identifier'],
                'jenis_kelamin' => $jenis_kelamin,
                'tgl_lahir' => $row['tanggal_lahir'],
                'tempat_lahir' => $row['tempat_lahir'],
                'email' => $row['email'],
                'no_telp' => $row['no_telp'],
            ]);
        } elseif ($row['tipe'] == 'staff') {
            Staff::create([
                'nama' => $row['nama'],
                'bagian' => $row['identifier'],
                'jenis_kelamin' => $jenis_kelamin,
                'tgl_lahir' => $row['tanggal_lahir'],
                'tempat_lahir' => $row['tempat_lahir'],
                'email' => $row['email'],
                'no_telp' => $row['no_telp'],
            ]);
        }
    }
}
