<?php

namespace App\Observers;

use App\Models\LogAktivitas;
use App\Models\Resep;
use Illuminate\Support\Facades\Auth;

class ResepObserver
{
    /**
     * Handle the Resep "created" event.
     */
    public function created(Resep $resep): void
    {
        if (!Auth::check()) return;

        $user = Auth::user();
        $obatName = $resep->obat->nama_obat ?? 'N/A';
        $pasienName = $resep->visit->pasien->nama ?? 'N/A';
        $aksi = "{$user->nama} menambahkan resep '{$obatName}' untuk pasien {$pasienName} (Kunjungan #{$resep->id_visit}).";

        LogAktivitas::create([
            'id_users' => $user->id_users,
            'aksi' => $aksi,
            'waktu' => now(),
        ]);
    }

    /**
     * Handle the Resep "updated" event.
     */
    public function updated(Resep $resep): void
    {
        if (!Auth::check()) return;

        $user = Auth::user();
        $obatName = $resep->obat->nama_obat ?? 'N/A';
        $pasienName = $resep->visit->pasien->nama ?? 'N/A';
        $aksi = "{$user->nama} memperbarui resep '{$obatName}' untuk pasien {$pasienName} (Kunjungan #{$resep->id_visit}).";

        LogAktivitas::create([
            'id_users' => $user->id_users,
            'aksi' => $aksi,
            'waktu' => now(),
        ]);
    }

    /**
     * Handle the Resep "deleted" event.
     */
    public function deleted(Resep $resep): void
    {
        if (!Auth::check()) return;

        $user = Auth::user();
        $obatName = $resep->obat->nama_obat ?? 'N/A';
        $pasienName = $resep->visit->pasien->nama ?? 'N/A';
        $aksi = "{$user->nama} menghapus resep '{$obatName}' untuk pasien {$pasienName} (Kunjungan #{$resep->id_visit}).";

        LogAktivitas::create([
            'id_users' => $user->id_users,
            'aksi' => $aksi,
            'waktu' => now(),
        ]);
    }

    /**
     * Handle the Resep "restored" event.
     */
    public function restored(Resep $resep): void
    {
        //
    }

    /**
     * Handle the Resep "force deleted" event.
     */
    public function forceDeleted(Resep $resep): void
    {
        //
    }
}
