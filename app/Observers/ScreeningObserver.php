<?php

namespace App\Observers;

use App\Models\LogAktivitas;
use App\Models\Screening;
use Illuminate\Support\Facades\Auth;

class ScreeningObserver
{
    /**
     * Handle the Screening "created" event.
     */
    public function created(Screening $screening): void
    {
        if (!Auth::check()) return;

        $user = Auth::user();
        $pasienName = $screening->visit->pasien->nama ?? 'N/A';
        $aksi = "{$user->nama} menambahkan data screening untuk pasien {$pasienName} (Kunjungan #{$screening->id_visit}).";

        LogAktivitas::create([
            'id_users' => $user->id_users,
            'aksi' => $aksi,
            'waktu' => now(),
        ]);
    }

    /**
     * Handle the Screening "updated" event.
     */
    public function updated(Screening $screening): void
    {
        if (!Auth::check()) return;

        $user = Auth::user();
        $pasienName = $screening->visit->pasien->nama ?? 'N/A';
        $aksi = "{$user->nama} memperbarui data screening untuk pasien {$pasienName} (Kunjungan #{$screening->id_visit}).";

        LogAktivitas::create([
            'id_users' => $user->id_users,
            'aksi' => $aksi,
            'waktu' => now(),
        ]);
    }

    /**
     * Handle the Screening "deleted" event.
     */
    public function deleted(Screening $screening): void
    {
        if (!Auth::check()) return;

        $user = Auth::user();
        $pasienName = $screening->visit->pasien->nama ?? 'N/A';
        $aksi = "{$user->nama} menghapus data screening untuk pasien {$pasienName} (Kunjungan #{$screening->id_visit}).";

        LogAktivitas::create([
            'id_users' => $user->id_users,
            'aksi' => $aksi,
            'waktu' => now(),
        ]);
    }

    /**
     * Handle the Screening "restored" event.
     */
    public function restored(Screening $screening): void
    {
        //
    }

    /**
     * Handle the Screening "force deleted" event.
     */
    public function forceDeleted(Screening $screening): void
    {
        //
    }
}
