<?php

namespace App\Exports;

use App\Models\Screening;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ScreeningExport implements FromCollection, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Screening::with(['visit.mahasiswa', 'visit.dosen', 'visit.staff'])->get();
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
            'Tanggal Screening',
            'Berat Badan (kg)',
            'Tinggi Badan (cm)',
            'IMT',
            'Pendengaran',
            'Penglihatan',
            'Tekanan Darah',
            'Status Gizi',
            'Kecacatan',
            'Kebugaran',
        ];
    }

    /**
     * @param Screening $screening
     * @return array
     */
    public function map($screening): array
    {
        $pasienName = '';
        if ($screening->visit->type_pasien === 'mahasiswa' && $screening->visit->mahasiswa) {
            $pasienName = $screening->visit->mahasiswa->nama;
        } elseif ($screening->visit->type_pasien === 'dosen' && $screening->visit->dosen) {
            $pasienName = $screening->visit->dosen->nama;
        } elseif ($screening->visit->type_pasien === 'staff' && $screening->visit->staff) {
            $pasienName = $screening->visit->staff->nama;
        }

        return [
            $screening->id_screening,
            $pasienName,
            $screening->visit->tgl_kunjungan,
            $screening->tgl_screening,
            $screening->berat_badan,
            $screening->tinggi_badan,
            $screening->imt,
            $screening->pendengaran,
            $screening->penglihatan,
            $screening->tekanan_darah,
            $screening->status_gizi,
            $screening->kecacatan,
            $screening->kebugaran,
        ];
    }
}
