<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lainnya extends Model
{
    protected $table = 'lainnya';
    protected $primaryKey = 'id_lainnya';

    protected $fillable = [
        'nama',
        'nik',
        'jenis_kelamin',
        'tempat_lahir',
        'tgl_lahir',
        'email',
        'no_telp'
    ];

    public function visits()
    {
        return $this->hasMany(Visit::class, 'id_lainnya', 'id_lainnya');
    }

    public function screenings()
    {
        return $this->hasMany(Screening::class, 'id_lainnya', 'id_lainnya');
    }

    public function riwayatKunjungan()
    {
        return $this->hasMany(RiwayatKunjungan::class, 'id_lainnya', 'id_lainnya');
    }
}
