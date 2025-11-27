<?php

namespace App\Exports;

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

class PasienExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize, WithStyles, WithCustomStartCell
{
    protected $pasien;
    private $rowNumber = 0;

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
            'No',
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
        $this->rowNumber++;
        return [
            $this->rowNumber,
            $pasien->nama,
            $pasien->identifier,
            $pasien->type,
            $pasien->jenis_kelamin === 'L' ? 'Laki-laki' : 'Perempuan',
            (new \Carbon\Carbon($pasien->tgl_lahir))->format('d-m-Y'),
            $pasien->tempat_lahir,
            $pasien->type === 'mahasiswa' ? ($pasien->prodi ? $pasien->prodi->nama_prodi : '-') : '-',
            $pasien->email,
            $pasien->no_telp,
        ];
    }

    /**
     * @return string
     */
    public function startCell(): string
    {
        return 'A5'; // Start data from cell A5
    }

    /**
     * @param Worksheet $sheet
     * @return array
     */
    public function styles(Worksheet $sheet)
    {
        // Report Title
        $sheet->setCellValue('A1', 'LAPORAN DATA PASIEN');
        $sheet->mergeCells('A1:J1');
        $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(16);
        $sheet->getStyle('A1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        // Clinic Info
        $sheet->setCellValue('A2', 'UNESA MEDICAL CENTER');
        $sheet->mergeCells('A2:J2');
        $sheet->getStyle('A2')->getFont()->setSize(12);
        $sheet->getStyle('A2')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        $sheet->setCellValue('A3', 'Tanggal Laporan: ' . date('d F Y'));
        $sheet->mergeCells('A3:J3');
        $sheet->getStyle('A3')->getFont()->setSize(10);
        $sheet->getStyle('A3')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);


        // Style for data headings (row 5)
        $sheet->getStyle('A5:' . $sheet->getHighestColumn() . '5')->applyFromArray([
            'font' => ['bold' => true],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['argb' => 'FFEAEAEA'], // Light Grey
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

        $sheet->getStyle('A6:' . $highestColumn . $highestRow)->applyFromArray([
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['argb' => 'FF000000'],
                ],
            ],
        ]);
        
        // Align all cells to center for a cleaner look
        $sheet->getStyle('A:J')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);

        return [];
    }
}
