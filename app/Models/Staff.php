<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    protected $table = 'staff';
    protected $primaryKey = 'id_staff';

    protected $fillable = [
        'nama',
        'bagian',
        'jenis_kelamin',
        'tempat_lahir',
        'tgl_lahir',
        'email',
        'no_telp'
    ];

    public function visits()
    {
        return $this->hasMany(Visit::class, 'id_staff', 'id_staff');
    }

    public function screenings()
    {
        return $this->hasMany(Screening::class, 'id_staff', 'id_staff');
    }

    public function riwayatKunjungan()
    {
        return $this->hasMany(RiwayatKunjungan::class, 'id_staff', 'id_staff');
    }
}