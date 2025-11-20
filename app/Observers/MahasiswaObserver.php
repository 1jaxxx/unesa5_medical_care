<?php

namespace App\Observers;

use App\Models\LogAktivitas;
use App\Models\Mahasiswa;
use Illuminate\Support\Facades\Auth;

class MahasiswaObserver
{
    /**
     * Handle the Mahasiswa "created" event.
     */
    public function created(Mahasiswa $mahasiswa): void
    {
        if (!Auth::check()) return;

        $user = Auth::user();
        $aksi = "{$user->nama} menambahkan pasien (Mahasiswa) baru: '{$mahasiswa->nama}'.";

        LogAktivitas::create([
            'id_users' => $user->id_users,
            'aksi' => $aksi,
            'waktu' => now(),
        ]);
    }

    /**
     * Handle the Mahasiswa "updated" event.
     */
    public function updated(Mahasiswa $mahasiswa): void
    {
        if (!Auth::check()) return;

        $user = Auth::user();
        $aksi = "{$user->nama} memperbarui data pasien (Mahasiswa): '{$mahasiswa->nama}'.";

        LogAktivitas::create([
            'id_users' => $user->id_users,
            'aksi' => $aksi,
            'waktu' => now(),
        ]);
    }

    /**
     * Handle the Mahasiswa "deleted" event.
     */
    public function deleted(Mahasiswa $mahasiswa): void
    {
        if (!Auth::check()) return;

        $user = Auth::user();
        $aksi = "{$user->nama} menghapus pasien (Mahasiswa): '{$mahasiswa->nama}'.";

        LogAktivitas::create([
            'id_users' => $user->id_users,
            'aksi' => $aksi,
            'waktu' => now(),
        ]);
    }

    /**
     * Handle the Mahasiswa "restored" event.
     */
    public function restored(Mahasiswa $mahasiswa): void
    {
        //
    }

    /**
     * Handle the Mahasiswa "force deleted" event.
     */
    public function forceDeleted(Mahasiswa $mahasiswa): void
    {
        //
    }
}
