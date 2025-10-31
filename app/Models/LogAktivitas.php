<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LogAktivitas extends Model
{
    protected $table = 'log_aktivitas';
    protected $primaryKey = 'id_log';

    protected $fillable = [
        'id_users',
        'aksi',
        'waktu'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_users', 'id_users');
    }
}