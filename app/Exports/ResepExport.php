<?php

namespace App\Exports;

use App\Models\Resep;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ResepExport implements FromCollection, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Resep::with(['visit.mahasiswa', 'visit.dosen', 'visit.staff', 'obat'])->get();
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            'ID',
            'Pasien',
            'Obat',
            'Dosis',
            'Jumlah',
            'Tanggal Diberikan',
            'Catatan',
        ];
    }

    /**
     * @param Resep $resep
     * @return array
     */
    public function map($resep): array
    {
        $pasienName = '';
        if ($resep->visit->type_pasien === 'mahasiswa' && $resep->visit->mahasiswa) {
            $pasienName = $resep->visit->mahasiswa->nama;
        } elseif ($resep->visit->type_pasien === 'dosen' && $resep->visit->dosen) {
            $pasienName = $resep->visit->dosen->nama;
        } elseif ($resep->visit->type_pasien === 'staff' && $resep->visit->staff) {
            $pasienName = $resep->visit->staff->nama;
        }

        return [
            $resep->id_resep,
            $pasienName,
            $resep->obat->nama_obat,
            $resep->dosis,
            $resep->jumlah,
            $resep->tgl_diberikan,
            $resep->catatan,
        ];
    }
}
