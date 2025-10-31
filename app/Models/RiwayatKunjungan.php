<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RiwayatKunjungan extends Model
{
    protected $table = 'riwayat_kunjungan';
    protected $primaryKey = 'id_riwayat_visit';

    protected $fillable = [
        'id_pasien',
        'id_visit',
        'tgl_kunjungan',
        'keluhan',
        'diagnosis'
    ];

    public function pasien()
    {
        return $this->belongsTo(Pasien::class, 'id_pasien', 'id_pasien');
    }

    public function visit()
    {
        return $this->belongsTo(Visit::class, 'id_visit', 'id_visit');
    }
}