<?php

namespace App\Exports;

use App\Models\Visit;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class VisitExport implements FromCollection, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Visit::with(['mahasiswa', 'dosen', 'staff', 'dokter'])->get();
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            'ID',
            'Pasien',
            'Tanggal Kunjungan',
            'Keluhan',
            'Diagnosis',
            'Dokter',
            'Status',
        ];
    }

    /**
     * @param Visit $visit
     * @return array
     */
    public function map($visit): array
    {
        $pasienName = '';
        if ($visit->type_pasien === 'mahasiswa' && $visit->mahasiswa) {
            $pasienName = $visit->mahasiswa->nama;
        } elseif ($visit->type_pasien === 'dosen' && $visit->dosen) {
            $pasienName = $visit->dosen->nama;
        } elseif ($visit->type_pasien === 'staff' && $visit->staff) {
            $pasienName = $visit->staff->nama;
        }

        return [
            $visit->id_visit,
            $pasienName,
            $visit->tgl_kunjungan,
            $visit->keluhan,
            $visit->diagnosis,
            $visit->dokter ? $visit->dokter->nama : '',
            $visit->status,
        ];
    }
}
