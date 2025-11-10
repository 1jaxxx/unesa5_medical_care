<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Screening;
use App\Models\Visit;
use App\Models\Mahasiswa;
use App\Models\Dosen;
use App\Models\Staff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ScreeningController extends Controller
{
    public function index()
    {
        $screenings = Screening::with(['mahasiswa', 'dosen', 'staff', 'visit'])->paginate(10);
        return view('admin.screening.index', compact('screenings'));
    }

    public function create()
    {
    $mahasiswa = Mahasiswa::select('id_mahasiswa as id', 'nama', DB::raw("'mahasiswa' as type"))->get();
    $dosen = Dosen::select('id_dosen as id', 'nama', DB::raw("'dosen' as type"))->get();
    $staff = Staff::select('id_staff as id', 'nama', DB::raw("'staff' as type"))->get();

        $pasien = $mahasiswa->concat($dosen)->concat($staff);
        $visits = Visit::all();
        return view('admin.screening.create', compact('pasien', 'visits'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_pasien' => 'required|exists:pasien,id_pasien',
            'id_visit' => 'required|exists:visit,id_visit',
            'tgl_screening' => 'required|date',
            'berat_badan' => 'required|numeric',
            'tinggi_badan' => 'required|numeric',
            'imt' => 'required|numeric',
            'pendengaran' => 'required',
            'penglihatan' => 'required',
            'tekanan_darah' => 'required',
            'status_gizi' => 'required',
            'kecacatan' => 'required',
            'kebugaran' => 'required|in:kurang,cukup,bugar'
        ]);

        Screening::create($validated);
        return redirect()->route('admin.screening.index')->with('success', 'Data screening berhasil ditambahkan');
    }

    public function show(Screening $screening)
    {
        return view('admin.screening.show', compact('screening'));
    }

    public function edit(Screening $screening)
    {
    $mahasiswa = Mahasiswa::select('id_mahasiswa as id', 'nama', DB::raw("'mahasiswa' as type"))->get();
    $dosen = Dosen::select('id_dosen as id', 'nama', DB::raw("'dosen' as type"))->get();
    $staff = Staff::select('id_staff as id', 'nama', DB::raw("'staff' as type"))->get();

        $pasien = $mahasiswa->concat($dosen)->concat($staff);
        $visits = Visit::all();
        return view('admin.screening.edit', compact('screening', 'pasien', 'visits'));
    }

    public function update(Request $request, Screening $screening)
    {
        $validated = $request->validate([
            'id_pasien' => 'required|exists:pasien,id_pasien',
            'id_visit' => 'required|exists:visit,id_visit',
            'tgl_screening' => 'required|date',
            'berat_badan' => 'required|numeric',
            'tinggi_badan' => 'required|numeric',
            'imt' => 'required|numeric',
            'pendengaran' => 'required',
            'penglihatan' => 'required',
            'tekanan_darah' => 'required',
            'status_gizi' => 'required',
            'kecacatan' => 'required',
            'kebugaran' => 'required|in:kurang,cukup,bugar'
        ]);

        $screening->update($validated);
        return redirect()->route('admin.screening.index')->with('success', 'Data screening berhasil diperbarui');
    }

    public function destroy(Screening $screening)
    {
        $screening->delete();
        return redirect()->route('admin.screening.index')->with('success', 'Data screening berhasil dihapus');
    }
}