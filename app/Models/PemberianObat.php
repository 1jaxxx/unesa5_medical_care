<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PemberianObat extends Model
{
    protected $table = 'pemberian_obat';
    protected $primaryKey = 'id_pemberian';

    protected $fillable = [
        'id_resep',
        'tgl_diberikan',
        'cacatan'
    ];

    public function resep()
    {
        return $this->belongsTo(Resep::class, 'id_resep', 'id_resep');
    }
}