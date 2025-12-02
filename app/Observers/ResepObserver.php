<?php

namespace App\Observers;

use App\Models\LogAktivitas;
use App\Models\Obat;
use App\Models\Resep;
use Illuminate\Support\Facades\Auth;

class ResepObserver
{
    /**
     * Handle the Resep "created" event.
     */
    public function created(Resep $resep): void
    {
        // Kurangi stok obat
        $obat = Obat::find($resep->id_obat);
        if ($obat) {
            $obat->stok -= $resep->jumlah;
            $obat->save();
        }

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
        $original = $resep->getOriginal();

        // Kembalikan stok obat lama
        $obatLama = Obat::find($original['id_obat']);
        if ($obatLama) {
            $obatLama->stok += $original['jumlah'];
            $obatLama->save();
        }

        // Kurangi stok obat baru
        $obatBaru = Obat::find($resep->id_obat);
        if ($obatBaru) {
            $obatBaru->stok -= $resep->jumlah;
            $obatBaru->save();
        }

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
