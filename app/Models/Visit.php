<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Visit extends Model
{
    protected $table = 'visit';
    protected $primaryKey = 'id_visit';

    protected $fillable = [
        'tgl_kunjungan',
        'keluhan',
        'diagnosis',
        'type_pasien',
        'id_mahasiswa',
        'id_dosen',
        'id_staff',
        'dokter_id'
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

    public function dokter()
    {
        return $this->belongsTo(User::class, 'dokter_id', 'id_users');
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

    public function screening()
    {
        return $this->hasOne(Screening::class, 'id_visit', 'id_visit');
    }

    public function resep()
    {
        return $this->hasMany(Resep::class, 'id_visit', 'id_visit');
    }

    public function riwayatKunjungan()
    {
        return $this->hasOne(RiwayatKunjungan::class, 'id_visit', 'id_visit');
    }
}