<?php

namespace App\Imports;

use App\Models\Obat;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
// Tambahkan library untuk konversi tanggal
use \PhpOffice\PhpSpreadsheet\Shared\Date; 

class ObatImport implements ToModel, WithHeadingRow, WithValidation
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        // 1. Ambil nilai tanggal kadaluarsa dari baris data
        $excelDateValue = $row['tgl_kadaluarsa'];
        
        // 2. Lakukan konversi jika nilai yang dibaca adalah numerik (format Excel Date)
        if (is_numeric($excelDateValue)) {
            // Konversi menjadi objek DateTime, lalu format menjadi 'Y-m-d'
            $tgl_kadaluarsa = Date::excelToDateTimeObject($excelDateValue)->format('Y-m-d');
        } else {
            // Jika sudah dalam format string yang benar (e.g., '2026-06-30'), gunakan langsung
            $tgl_kadaluarsa = $excelDateValue;
        }

        return new Obat([
            'nama_obat' => $row['nama_obat'],
            'jenis_obat' => $row['jenis_obat'],
            // Gunakan variabel hasil konversi
            'tgl_kadaluarsa' => $tgl_kadaluarsa, 
            'stok' => $row['stok'],
        ]);
    }

    public function rules(): array
    {
        return [
            'nama_obat' => 'required|string',
            'jenis_obat' => 'required|string',
            'tgl_kadaluarsa' => 'required',
            'stok' => 'required|numeric',
        ];
    }
}