<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pasien;
use App\Models\Prodi;
use App\Models\Visit;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $totalPasien = Pasien::count();
        $totalProdi = Prodi::count();
        $kunjunganHariIni = Visit::whereDate('tgl_kunjungan', Carbon::today())->count();

        $visitsPerDay = Visit::selectRaw('DATE(tgl_kunjungan) as date, COUNT(*) as count')
            ->where('tgl_kunjungan', '>=', Carbon::now()->subDays(7))
            ->groupBy('date')
            ->orderBy('date')
            ->pluck('count', 'date')
            ->toArray();

        return view('admin.dashboard', compact('totalPasien', 'totalProdi', 'kunjunganHariIni', 'visitsPerDay'));
    }

    public function getData()
    {
        $totalPasien = Pasien::count();
        $totalProdi = Prodi::count();
        $kunjunganHariIni = Visit::whereDate('tgl_kunjungan', Carbon::today())->count();

        $visitsPerDay = Visit::selectRaw('DATE(tgl_kunjungan) as date, COUNT(*) as count')
            ->where('tgl_kunjungan', '>=', Carbon::now()->subDays(7))
            ->groupBy('date')
            ->orderBy('date')
            ->pluck('count', 'date')
            ->toArray();

        return response()->json([
            'totalPasien' => $totalPasien,
            'totalProdi' => $totalProdi,
            'kunjunganHariIni' => $kunjunganHariIni,
            'visitsPerDay' => $visitsPerDay
        ]);
    }
}
