<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Screening extends Model
{
    protected $table = 'screening';
    protected $primaryKey = 'id_screening';

    protected $fillable = [
        'id_pasien',
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
        'kebugaran'
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