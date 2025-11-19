<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pasien extends Model
{
    protected $table = 'pasien';
    protected $primaryKey = 'id_pasien';

    protected $fillable = [
        'id_prodi',
        'nama',
        'type_pasien',
        'nim',
        'nidn',
        'bagian',
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
}
