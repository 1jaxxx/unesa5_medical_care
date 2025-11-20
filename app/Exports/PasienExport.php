<?php

namespace App\Exports;

use App\Models\Mahasiswa;
use App\Models\Dosen;
use App\Models\Staff;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class PasienExport implements FromCollection, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $mahasiswaQuery = Mahasiswa::with('prodi')->select(
            'id_mahasiswa as id', 'nama', 'nim as identifier', DB::raw("'mahasiswa' as type"), 
            'jenis_kelamin', 'tgl_lahir', 'tempat_lahir', 'id_prodi', 'email', 'no_telp', 'created_at'
        );
        $dosenQuery = Dosen::select(
            'id_dosen as id', 'nama', 'nidn as identifier', DB::raw("'dosen' as type"),
            'jenis_kelamin', 'tgl_lahir', 'tempat_lahir', DB::raw("NULL as id_prodi"),
            'email', 'no_telp', 'created_at'
        );
        $staffQuery = Staff::select(
            'id_staff as id', 'nama', 'bagian as identifier', DB::raw("'staff' as type"),
            'jenis_kelamin', 'tgl_lahir', 'tempat_lahir', DB::raw("NULL as id_prodi"),
            'email', 'no_telp', 'created_at'
        );

        return $mahasiswaQuery->union($dosenQuery)->union($staffQuery)->get();
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            'ID',
            'Nama',
            'Identifier',
            'Tipe',
            'Jenis Kelamin',
            'Tanggal Lahir',
            'Tempat Lahir',
            'Prodi',
            'Email',
            'No. Telp',
        ];
    }

    /**
     * @param mixed $pasien
     * @return array
     */
    public function map($pasien): array
    {
        return [
            $pasien->id,
            $pasien->nama,
            $pasien->identifier,
            $pasien->type,
            $pasien->jenis_kelamin === 'L' ? 'Laki-laki' : 'Perempuan',
            $pasien->tgl_lahir,
            $pasien->tempat_lahir,
            $pasien->type === 'mahasiswa' ? ($pasien->prodi ? $pasien->prodi->nama_prodi : '') : '',
            $pasien->email,
            $pasien->no_telp,
        ];
    }
}
