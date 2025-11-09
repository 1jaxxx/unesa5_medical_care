<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Screening extends Model
{
    protected $table = 'screening';
    protected $primaryKey = 'id_screening';

    protected $fillable = [
        'id_visit',
        'tgl_screening',
        'berat_badan',
        'tinggi_badan',
        'imt',
        'pendengaran',
        'penglihatan',
        'tekanan_darah',
        'status_gizi',
        'kecacatan',
        'kebugaran',
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