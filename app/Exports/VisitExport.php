<?php

namespace App\Exports;

use App\Models\Visit;
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

class VisitExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize, WithStyles, WithCustomStartCell
{
    protected $visits;
    private $rowNumber = 0;

    public function __construct(Collection $visits)
    {
        $this->visits = $visits;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return $this->visits;
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            'No',
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
        $this->rowNumber++;
        $pasienName = 'N/A';
        if ($visit->type_pasien === 'mahasiswa' && $visit->mahasiswa) {
            $pasienName = $visit->mahasiswa->nama;
        } elseif ($visit->type_pasien === 'dosen' && $visit->dosen) {
            $pasienName = $visit->dosen->nama;
        } elseif ($visit->type_pasien === 'staff' && $visit->staff) {
            $pasienName = $visit->staff->nama;
        }

        return [
            $this->rowNumber,
            $pasienName,
            (new \Carbon\Carbon($visit->tgl_kunjungan))->format('d-m-Y'),
            $visit->keluhan,
            $visit->diagnosis,
            $visit->dokter ? $visit->dokter->nama : 'N/A',
            ucfirst($visit->status),
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
        // Report Title
        $sheet->setCellValue('A1', 'LAPORAN DATA KUNJUNGAN');
        $sheet->mergeCells('A1:G1');
        $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(16);
        $sheet->getStyle('A1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        // Clinic Info
        $sheet->setCellValue('A2', 'UNESA 5 MEDICAL CENTER');
        $sheet->mergeCells('A2:G2');
        $sheet->getStyle('A2')->getFont()->setSize(12);
        $sheet->getStyle('A2')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        $sheet->setCellValue('A3', 'Tanggal Laporan: ' . date('d F Y'));
        $sheet->mergeCells('A3:G3');
        $sheet->getStyle('A3')->getFont()->setSize(10);
        $sheet->getStyle('A3')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        // Style for data headings (row 5)
        $sheet->getStyle('A5:' . $sheet->getHighestColumn() . '5')->applyFromArray([
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
        $highestColumn = $sheet->getHighestColumn();
        if ($highestRow > 5) {
            $sheet->getStyle('A6:' . $highestColumn . $highestRow)->applyFromArray([
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
