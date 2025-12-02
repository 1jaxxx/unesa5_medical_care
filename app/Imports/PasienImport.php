<?php

namespace App\Imports;

use App\Models\Mahasiswa;
use App\Models\Dosen;
use App\Models\Staff;
use App\Models\Prodi;
// ... (Model lainnya)
use Maatwebsite\Excel\Concerns\OnEachRow;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Row;
// IMPORT HELPER UNTUK KONVERSI TANGGAL
use \PhpOffice\PhpSpreadsheet\Shared\Date; 

class PasienImport implements OnEachRow, WithHeadingRow, WithValidation
{
    public function onRow(Row $row)
    {
        // ... (Kode yang sudah ada)
        $row = $row->toArray();

        // 1. Ambil nilai tanggal lahir (dalam bentuk numerik dari Excel)
        $excelDateValue = $row['tanggal_lahir'];

        // 2. KONVERSI NILAI NUMERIK EXCEL MENJADI OBJEK DATETIME
        // Kita perlu pastikan nilai adalah numerik sebelum konversi
        if (is_numeric($excelDateValue)) {
            $tgl_lahir = Date::excelToDateTimeObject($excelDateValue)->format('Y-m-d');
        } else {
            // Jika formatnya sudah string (misalnya '1999-05-15'), gunakan langsung
            $tgl_lahir = $excelDateValue; 
        }

        $jenis_kelamin = ($row['jenis_kelamin'] == 'Laki-laki') ? 'L' : 'P';

        if ($row['tipe'] == 'mahasiswa') {
            $prodi = Prodi::where('nama_prodi', $row['prodi'])->first();
            Mahasiswa::create([
                'nama' => $row['nama'],
                'nim' => $row['identifier'],
                'jenis_kelamin' => $jenis_kelamin,
                // Gunakan variabel hasil konversi
                'tgl_lahir' => $tgl_lahir, 
                'tempat_lahir' => $row['tempat_lahir'],
                'id_prodi' => $prodi ? $prodi->id_prodi : null,
                'email' => $row['email'],
                'no_telp' => $row['no_telp'],
            ]);
        } elseif ($row['tipe'] == 'dosen') {
            Dosen::create([
                'nama' => $row['nama'],
                'nidn' => $row['identifier'],
                'jenis_kelamin' => $jenis_kelamin,
                // Gunakan variabel hasil konversi
                'tgl_lahir' => $tgl_lahir, 
                'tempat_lahir' => $row['tempat_lahir'],
                'email' => $row['email'],
                'no_telp' => $row['no_telp'],
            ]);
        } elseif ($row['tipe'] == 'staff') {
            Staff::create([
                'nama' => $row['nama'],
                'bagian' => $row['identifier'],
                'jenis_kelamin' => $jenis_kelamin,
                // Gunakan variabel hasil konversi
                'tgl_lahir' => $tgl_lahir, 
                'tempat_lahir' => $row['tempat_lahir'],
                'email' => $row['email'],
                'no_telp' => $row['no_telp'],
            ]);
        }
    }

    public function rules(): array
    {
        return [
            'tipe' => 'required|string|in:mahasiswa,dosen,staff',
            'nama' => 'required|string',
            'identifier' => 'required',
            'jenis_kelamin' => 'required|string',
            'tanggal_lahir' => 'required',
            'tempat_lahir' => 'required|string',
            'email' => 'required|email',
            'no_telp' => 'required',
            'prodi' => 'required_if:tipe,mahasiswa',
        ];
    }
}