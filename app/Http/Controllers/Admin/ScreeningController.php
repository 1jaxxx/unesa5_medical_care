<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Screening;
use App\Models\Visit;
use App\Models\Pasien;
use Illuminate\Http\Request;

class ScreeningController extends Controller
{
    public function index()
    {
        $screenings = Screening::with(['pasien', 'visit'])->paginate(10);
        return view('admin.screening.index', compact('screenings'));
    }

    public function create()
    {
        $pasien = Pasien::all();
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
        $pasien = Pasien::all();
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