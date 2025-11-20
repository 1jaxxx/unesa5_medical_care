<?php

namespace App\Observers;

use App\Models\LogAktivitas;
use App\Models\Prodi;
use Illuminate\Support\Facades\Auth;

class ProdiObserver
{
    /**
     * Handle the Prodi "created" event.
     */
    public function created(Prodi $prodi): void
    {
        if (!Auth::check()) return;

        $user = Auth::user();
        $aksi = "{$user->nama} menambahkan Program Studi baru: '{$prodi->nama_prodi}'.";

        LogAktivitas::create([
            'id_users' => $user->id_users,
            'aksi' => $aksi,
            'waktu' => now(),
        ]);
    }

    /**
     * Handle the Prodi "updated" event.
     */
    public function updated(Prodi $prodi): void
    {
        if (!Auth::check()) return;

        $user = Auth::user();
        $aksi = "{$user->nama} memperbarui Program Studi: '{$prodi->nama_prodi}'.";

        LogAktivitas::create([
            'id_users' => $user->id_users,
            'aksi' => $aksi,
            'waktu' => now(),
        ]);
    }

    /**
     * Handle the Prodi "deleted" event.
     */
    public function deleted(Prodi $prodi): void
    {
        if (!Auth::check()) return;

        $user = Auth::user();
        $aksi = "{$user->nama} menghapus Program Studi: '{$prodi->nama_prodi}'.";

        LogAktivitas::create([
            'id_users' => $user->id_users,
            'aksi' => $aksi,
            'waktu' => now(),
        ]);
    }

    /**
     * Handle the Prodi "restored" event.
     */
    public function restored(Prodi $prodi): void
    {
        //
    }

    /**
     * Handle the Prodi "force deleted" event.
     */
    public function forceDeleted(Prodi $prodi): void
    {
        //
    }
}
