<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    protected $table = 'mahasiswa';
    protected $primaryKey = 'id_mahasiswa';

    protected $fillable = [
        'id_prodi',
        'nama',
        'nim',
        'jenis_kelamin',
        'tempat_lahir',
        'tgl_lahir',
        'email',
        'no_telp'
    ];

    public function prodi()
    {
        return $this->belongsTo(Prodi::class, 'id_prodi', 'id_prodi');
    }

    public function visits()
    {
        return $this->hasMany(Visit::class, 'id_mahasiswa', 'id_mahasiswa');
    }

    public function screenings()
    {
        return $this->hasMany(Screening::class, 'id_mahasiswa', 'id_mahasiswa');
    }

    public function riwayatKunjungan()
    {
        return $this->hasMany(RiwayatKunjungan::class, 'id_mahasiswa', 'id_mahasiswa');
    }
}