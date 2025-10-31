<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Resep extends Model
{
    protected $table = 'resep';
    protected $primaryKey = 'id_resep';

    protected $fillable = [
        'id_obat',
        'id_visit',
        'dosis',
        'jumlah'
    ];

    public function obat()
    {
        return $this->belongsTo(Obat::class, 'id_obat', 'id_obat');
    }

    public function visit()
    {
        return $this->belongsTo(Visit::class, 'id_visit', 'id_visit');
    }

    public function pemberianObat()
    {
        return $this->hasMany(PemberianObat::class, 'id_resep', 'id_resep');
    }
}