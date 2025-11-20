<?php

namespace App\Observers;

use App\Models\LogAktivitas;
use App\Models\Visit;
use Illuminate\Support\Facades\Auth;

class VisitObserver
{
    /**
     * Handle the Visit "created" event.
     */
    public function created(Visit $visit): void
    {
        if (!Auth::check()) return;

        $user = Auth::user();
        $pasienName = $visit->pasien->nama ?? 'N/A';
        $aksi = "{$user->nama} membuat kunjungan baru untuk pasien {$pasienName}.";

        LogAktivitas::create([
            'id_users' => $user->id_users,
            'aksi' => $aksi,
            'waktu' => now()
        ]);
    }

    /**
     * Handle the Visit "updated" event.
     */
    public function updated(Visit $visit): void
    {
        if (!Auth::check()) return;

        $user = Auth::user();

        if ($visit->wasChanged('status')) {
            $oldStatus = $visit->getOriginal('status');
            $newStatus = $visit->status;
            $aksi = "{$user->nama} mengubah status Kunjungan #{$visit->id_visit} dari '{$oldStatus}' menjadi '{$newStatus}'.";

            LogAktivitas::create([
                'id_users' => $user->id_users,
                'aksi' => $aksi,
                'waktu' => now()
            ]);
        }
    }

    /**
     * Handle the Visit "deleted" event.
     */
    public function deleted(Visit $visit): void
    {
        if (!Auth::check()) return;

        $user = Auth::user();
        $aksi = "{$user->nama} menghapus Kunjungan #{$visit->id_visit}.";

        LogAktivitas::create([
            'id_users' => $user->id_users,
            'aksi' => $aksi,
            'waktu' => now()
        ]);
    }

    /**
     * Handle the Visit "restored" event.
     */
    public function restored(Visit $visit): void
    {
        //
    }

    /**
     * Handle the Visit "force deleted" event.
     */
    public function forceDeleted(Visit $visit): void
    {
        //
    }
}
