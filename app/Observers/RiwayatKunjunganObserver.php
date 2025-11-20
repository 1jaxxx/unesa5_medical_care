<?php

namespace App\Observers;

use App\Models\RiwayatKunjungan;

class RiwayatKunjunganObserver
{
    /**
     * Handle the RiwayatKunjungan "deleting" event.
     */
    public function deleting(RiwayatKunjungan $riwayatKunjungan): void
    {
        $riwayatKunjungan->visit()->delete();
    }
}
