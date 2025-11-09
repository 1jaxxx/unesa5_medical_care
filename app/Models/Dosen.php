<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dosen extends Model
{
    protected $table = 'dosen';
    protected $primaryKey = 'id_dosen';

    protected $fillable = [
        'nama',
        'nidn',
        'jenis_kelamin',
        'tempat_lahir',
        'tgl_lahir',
        'email',
        'no_telp'
    ];

    public function visits()
    {
        return $this->hasMany(Visit::class, 'id_dosen', 'id_dosen');
    }

    public function screenings()
    {
        return $this->hasMany(Screening::class, 'id_dosen', 'id_dosen');
    }

    public function riwayatKunjungan()
    {
        return $this->hasMany(RiwayatKunjungan::class, 'id_dosen', 'id_dosen');
    }
}