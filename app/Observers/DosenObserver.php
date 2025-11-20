<?php

namespace App\Observers;

use App\Models\LogAktivitas;
use App\Models\Dosen;
use Illuminate\Support\Facades\Auth;

class DosenObserver
{
    /**
     * Handle the Dosen "created" event.
     */
    public function created(Dosen $dosen): void
    {
        if (!Auth::check()) return;

        $user = Auth::user();
        $aksi = "{$user->nama} menambahkan pasien (Dosen) baru: '{$dosen->nama}'.";

        LogAktivitas::create([
            'id_users' => $user->id_users,
            'aksi' => $aksi,
            'waktu' => now(),
        ]);
    }

    /**
     * Handle the Dosen "updated" event.
     */
    public function updated(Dosen $dosen): void
    {
        if (!Auth::check()) return;

        $user = Auth::user();
        $aksi = "{$user->nama} memperbarui data pasien (Dosen): '{$dosen->nama}'.";

        LogAktivitas::create([
            'id_users' => $user->id_users,
            'aksi' => $aksi,
            'waktu' => now(),
        ]);
    }

    /**
     * Handle the Dosen "deleted" event.
     */
    public function deleted(Dosen $dosen): void
    {
        if (!Auth::check()) return;

        $user = Auth::user();
        $aksi = "{$user->nama} menghapus pasien (Dosen): '{$dosen->nama}'.";

        LogAktivitas::create([
            'id_users' => $user->id_users,
            'aksi' => $aksi,
            'waktu' => now(),
        ]);
    }

    /**
     * Handle the Dosen "restored" event.
     */
    public function restored(Dosen $dosen): void
    {
        //
    }

    /**
     * Handle the Dosen "force deleted" event.
     */
    public function forceDeleted(Dosen $dosen): void
    {
        //
    }
}
