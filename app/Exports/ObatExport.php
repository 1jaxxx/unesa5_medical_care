<?php

namespace App\Exports;

use App\Models\Obat;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ObatExport implements FromCollection, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Obat::select('id_obat', 'nama_obat', 'jenis_obat', 'tgl_kadaluarsa', 'stok')->get();
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            'ID',
            'Nama Obat',
            'Jenis Obat',
            'Tanggal Kadaluarsa',
            'Stok',
        ];
    }

    /**
     * @param Obat $obat
     * @return array
     */
    public function map($obat): array
    {
        return [
            $obat->id_obat,
            $obat->nama_obat,
            $obat->jenis_obat,
            $obat->tgl_kadaluarsa,
            $obat->stok,
        ];
    }
}
