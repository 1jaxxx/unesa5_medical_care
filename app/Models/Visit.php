<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Visit extends Model
{
    protected $table = 'visit';
    protected $primaryKey = 'id_visit';

    protected $fillable = [
        'id_pasien',
        'tgl_kunjungan',
        'keluhan',
        'diagnosis'
    ];

    public function pasien()
    {
        return $this->belongsTo(Pasien::class, 'id_pasien', 'id_pasien');
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