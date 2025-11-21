<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pasien;
use App\Models\Prodi;
use App\Models\Visit;
use App\Models\Mahasiswa;
use App\Models\Dosen;
use App\Models\Staff;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $totalPasien = Mahasiswa::count() + Dosen::count() + Staff::count();
        $totalProdi = Prodi::count();
        $kunjunganHariIni = Visit::whereDate('tgl_kunjungan', Carbon::today())->count();
        $antrianPasien = Visit::where('status', 'pending')->count();

        $visitsPerDay = Visit::selectRaw('DATE(tgl_kunjungan) as date, COUNT(*) as count')
            ->whereNotNull('tgl_kunjungan')
            ->groupBy('date')
            ->orderBy('date', 'ASC')
            ->pluck('count', 'date')
            ->toArray();

        return view('admin.dashboard', compact(
            'totalPasien',
            'totalProdi',
            'kunjunganHariIni',
            'antrianPasien',
            'visitsPerDay'
        ));
    }

    public function getData()
    {
        $totalPasien = Mahasiswa::count() + Dosen::count() + Staff::count();
        $totalProdi = Prodi::count();
        $kunjunganHariIni = Visit::whereDate('tgl_kunjungan', Carbon::today())->count();
        $antrianPasien = Visit::where('status', 'pending')->count();

        $visitsPerDay = Visit::selectRaw('DATE(tgl_kunjungan) as date, COUNT(*) as count')
            ->whereNotNull('tgl_kunjungan')
            ->groupBy('date')
            ->orderBy('date', 'ASC')
            ->pluck('count', 'date')
            ->toArray();

        return response()->json([
            'totalPasien' => $totalPasien,
            'totalProdi' => $totalProdi,
            'kunjunganHariIni' => $kunjunganHariIni,
            'antrianPasien' => $antrianPasien,
            'visitsPerDay' => $visitsPerDay
        ]);
    }
}