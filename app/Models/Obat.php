<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Obat extends Model
{
    protected $table = 'obat';
    protected $primaryKey = 'id_obat';

    protected $fillable = [
        'nama_obat',
        'jenis_obat',
        'tgl_kadaluarsa',
        'stok'
    ];

    public function resep()
    {
        return $this->hasMany(Resep::class, 'id_obat', 'id_obat');
    }
}