<?php

namespace App\Observers;

use App\Models\LogAktivitas;
use App\Models\Obat;
use Illuminate\Support\Facades\Auth;

class ObatObserver
{
    /**
     * Handle the Obat "created" event.
     */
    public function created(Obat $obat): void
    {
        if (!Auth::check()) return;

        $user = Auth::user();
        $aksi = "{$user->nama} menambahkan obat baru: '{$obat->nama_obat}'.";

        LogAktivitas::create([
            'id_users' => $user->id_users,
            'aksi' => $aksi,
            'waktu' => now(),
        ]);
    }

    /**
     * Handle the Obat "updated" event.
     */
    public function updated(Obat $obat): void
    {
        if (!Auth::check()) return;

        $user = Auth::user();
        $aksi = "{$user->nama} memperbarui obat: '{$obat->nama_obat}'.";

        LogAktivitas::create([
            'id_users' => $user->id_users,
            'aksi' => $aksi,
            'waktu' => now(),
        ]);
    }

    /**
     * Handle the Obat "deleted" event.
     */
    public function deleted(Obat $obat): void
    {
        if (!Auth::check()) return;

        $user = Auth::user();
        $aksi = "{$user->nama} menghapus obat: '{$obat->nama_obat}'.";

        LogAktivitas::create([
            'id_users' => $user->id_users,
            'aksi' => $aksi,
            'waktu' => now(),
        ]);
    }

    /**
     * Handle the Obat "restored" event.
     */
    public function restored(Obat $obat): void
    {
        //
    }

    /**
     * Handle the Obat "force deleted" event.
     */
    public function forceDeleted(Obat $obat): void
    {
        //
    }
}
