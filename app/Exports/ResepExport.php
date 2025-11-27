<?php

namespace App\Exports;

use App\Models\Resep;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;

class ResepExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize, WithStyles, WithCustomStartCell
{
    protected $resep;
    private $rowNumber = 0;

    public function __construct(Collection $resep)
    {
        $this->resep = $resep;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return $this->resep;
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            'No',
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
        $this->rowNumber++;
        $pasienName = 'N/A';
        if ($resep->visit && $resep->visit->type_pasien) {
            if ($resep->visit->type_pasien === 'mahasiswa' && $resep->visit->mahasiswa) {
                $pasienName = $resep->visit->mahasiswa->nama;
            } elseif ($resep->visit->type_pasien === 'dosen' && $resep->visit->dosen) {
                $pasienName = $resep->visit->dosen->nama;
            } elseif ($resep->visit->type_pasien === 'staff' && $resep->visit->staff) {
                $pasienName = $resep->visit->staff->nama;
            }
        }

        return [
            $this->rowNumber,
            $pasienName,
            $resep->obat ? $resep->obat->nama_obat : 'N/A',
            $resep->dosis,
            $resep->jumlah,
            (new \Carbon\Carbon($resep->tgl_diberikan))->format('d-m-Y'),
            $resep->catatan,
        ];
    }

    /**
     * @return string
     */
    public function startCell(): string
    {
        return 'A5';
    }

    /**
     * @param Worksheet $sheet
     * @return array
     */
    public function styles(Worksheet $sheet)
    {
        $lastColumn = $sheet->getHighestColumn();
        
        // Report Title
        $sheet->setCellValue('A1', 'LAPORAN DATA RESEP');
        $sheet->mergeCells('A1:' . $lastColumn . '1');
        $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(16);
        $sheet->getStyle('A1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        // Clinic Info
        $sheet->setCellValue('A2', 'UNESA MEDICAL CENTER');
        $sheet->mergeCells('A2:' . $lastColumn . '2');
        $sheet->getStyle('A2')->getFont()->setSize(12);
        $sheet->getStyle('A2')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        $sheet->setCellValue('A3', 'Tanggal Laporan: ' . date('d F Y'));
        $sheet->mergeCells('A3:' . $lastColumn . '3');
        $sheet->getStyle('A3')->getFont()->setSize(10);
        $sheet->getStyle('A3')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        // Style for data headings (row 5)
        $sheet->getStyle('A5:' . $lastColumn . '5')->applyFromArray([
            'font' => ['bold' => true],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['argb' => 'FFEAEAEA'],
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['argb' => 'FF000000'],
                ],
            ],
        ]);

        // Style for all data cells (from row 6 onwards)
        $highestRow = $sheet->getHighestRow();
        if ($highestRow > 5) {
            $sheet->getStyle('A6:' . $lastColumn . $highestRow)->applyFromArray([
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => Border::BORDER_THIN,
                        'color' => ['argb' => 'FF000000'],
                    ],
                ],
            ]);
        }
        
        return [];
    }
}
