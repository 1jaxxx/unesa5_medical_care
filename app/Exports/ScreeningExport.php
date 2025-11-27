<?php

namespace App\Exports;

use App\Models\Screening;
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

class ScreeningExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize, WithStyles, WithCustomStartCell
{
    protected $screenings;
    private $rowNumber = 0;

    public function __construct(Collection $screenings)
    {
        $this->screenings = $screenings;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return $this->screenings;
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
        $this->rowNumber++;
        $pasienName = 'N/A';
        if ($screening->type_pasien === 'mahasiswa' && $screening->mahasiswa) {
            $pasienName = $screening->mahasiswa->nama;
        } elseif ($screening->type_pasien === 'dosen' && $screening->dosen) {
            $pasienName = $screening->dosen->nama;
        } elseif ($screening->type_pasien === 'staff' && $screening->staff) {
            $pasienName = $screening->staff->nama;
        }

        return [
            $this->rowNumber,
            $pasienName,
            $screening->visit ? (new \Carbon\Carbon($screening->visit->tgl_kunjungan))->format('d-m-Y') : 'N/A',
            (new \Carbon\Carbon($screening->tgl_screening))->format('d-m-Y'),
            $screening->berat_badan,
            $screening->tinggi_badan,
            $screening->imt,
            $screening->pendengaran,
            $screening->penglihatan,
            $screening->tekanan_darah,
            $screening->status_gizi,
            $screening->kecacatan,
            ucfirst($screening->kebugaran),
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
        $sheet->setCellValue('A1', 'LAPORAN DATA SCREENING');
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
