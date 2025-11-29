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

        \App\Models\RiwayatKunjungan::create([
            'id_visit' => $visit->id_visit,
            'tgl_kunjungan' => $visit->tgl_kunjungan,
            'keluhan' => $visit->keluhan,
            'diagnosis' => $visit->diagnosis,
            'type_pasien' => $visit->type_pasien,
            'id_mahasiswa' => $visit->id_mahasiswa,
            'id_dosen' => $visit->id_dosen,
            'id_staff' => $visit->id_staff,
            'dokter_id' => $visit->dokter_id,
        ]);
    }

    /**
     * Handle the Visit "updated" event.
     */
    public function updated(Visit $visit): void
    {
        if (!Auth::check()) return;

        $user = Auth::user();

        // Update RiwayatKunjungan
        $riwayat = \App\Models\RiwayatKunjungan::where('id_visit', $visit->id_visit)->first();
        if ($riwayat) {
            $riwayat->update([
                'tgl_kunjungan' => $visit->tgl_kunjungan,
                'keluhan' => $visit->keluhan,
                'diagnosis' => $visit->diagnosis,
                'type_pasien' => $visit->type_pasien,
                'id_mahasiswa' => $visit->id_mahasiswa,
                'id_dosen' => $visit->id_dosen,
                'id_staff' => $visit->id_staff,
                'dokter_id' => $visit->dokter_id,
            ]);
        }

        if ($visit->wasChanged('status')) {
            $oldStatus = $visit->getOriginal('status');
            $newStatus = $visit->status;
            $pasienName = $visit->pasien->nama ?? 'N/A';
            $aksi = "{$user->nama} mengubah status kunjungan pasien '{$pasienName}' dari '{$oldStatus}' menjadi '{$newStatus}'.";

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
    /**
     * Handle the Visit "deleting" event.
     */
    public function deleting(Visit $visit): void
    {
        // Hapus screening terkait
        $visit->screening()->delete();

        // Hapus resep terkait
        $visit->resep()->delete();

        // Hapus riwayat kunjungan terkait
        \App\Models\RiwayatKunjungan::where('id_visit', $visit->id_visit)->delete();
    }

    /**
     * Handle the Visit "deleted" event.
     */
    public function deleted(Visit $visit): void
    {
        if (!Auth::check()) return;

        $user = Auth::user();
        $pasienName = $visit->pasien->nama ?? 'N/A';
        $aksi = "{$user->nama} menghapus kunjungan pasien '{$pasienName}'.";

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
