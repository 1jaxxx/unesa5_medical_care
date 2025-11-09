<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RiwayatKunjungan extends Model
{
    protected $table = 'riwayat_kunjungan';
    protected $primaryKey = 'id_riwayat_visit';

    protected $fillable = [
        'id_visit',
        'tgl_kunjungan',
        'keluhan',
        'diagnosis',
        'type_pasien',
        'id_mahasiswa',
        'id_dosen',
        'id_staff'
    ];

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'id_mahasiswa', 'id_mahasiswa');
    }

    public function dosen()
    {
        return $this->belongsTo(Dosen::class, 'id_dosen', 'id_dosen');
    }

    public function staff()
    {
        return $this->belongsTo(Staff::class, 'id_staff', 'id_staff');
    }

    public function getPasienAttribute()
    {
        switch ($this->type_pasien) {
            case 'mahasiswa':
                return $this->mahasiswa;
            case 'dosen':
                return $this->dosen;
            case 'staff':
                return $this->staff;
            default:
                return null;
        }
    }

    public function visit()
    {
        return $this->belongsTo(Visit::class, 'id_visit', 'id_visit');
    }
}