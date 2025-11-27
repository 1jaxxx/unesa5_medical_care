<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class PasienExport implements FromCollection, WithHeadings, WithMapping
{
    protected $pasien;

    public function __construct(Collection $pasien)
    {
        $this->pasien = $pasien;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return $this->pasien;
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
