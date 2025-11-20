<?php

namespace App\Observers;

use App\Models\LogAktivitas;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserObserver
{
    /**
     * Handle the User "created" event.
     */
    public function created(User $user): void
    {
        // Jangan log saat pengguna baru mendaftar sendiri
        if (!Auth::check()) return;

        $actor = Auth::user();
        $aksi = "{$actor->nama} menambahkan pengguna baru '{$user->nama}' dengan peran '{$user->role}'.";

        LogAktivitas::create([
            'id_users' => $actor->id_users,
            'aksi' => $aksi,
            'waktu' => now(),
        ]);
    }

    /**
     * Handle the User "updated" event.
     */
    public function updated(User $user): void
    {
        if (!Auth::check()) return;

        $actor = Auth::user();
        $aksi = "{$actor->nama} memperbarui data pengguna '{$user->nama}'.";

        LogAktivitas::create([
            'id_users' => $actor->id_users,
            'aksi' => $aksi,
            'waktu' => now(),
        ]);
    }

    /**
     * Handle the User "deleted" event.
     */
    public function deleted(User $user): void
    {
        if (!Auth::check()) return;

        $actor = Auth::user();
        $aksi = "{$actor->nama} menghapus pengguna '{$user->nama}'.";

        LogAktivitas::create([
            'id_users' => $actor->id_users,
            'aksi' => $aksi,
            'waktu' => now(),
        ]);
    }

    /**
     * Handle the User "restored" event.
     */
    public function restored(User $user): void
    {
        //
    }

    /**
     * Handle the User "force deleted" event.
     */
    public function forceDeleted(User $user): void
    {
        //
    }
}
