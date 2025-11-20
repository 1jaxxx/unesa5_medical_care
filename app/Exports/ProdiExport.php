<?php

namespace App\Exports;

use App\Models\Prodi;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ProdiExport implements FromCollection, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Prodi::select('id_prodi', 'nama_prodi')->get();
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            'ID',
            'Nama Prodi',
        ];
    }

    /**
     * @param Prodi $prodi
     * @return array
     */
    public function map($prodi): array
    {
        return [
            $prodi->id_prodi,
            $prodi->nama_prodi,
        ];
    }
}
