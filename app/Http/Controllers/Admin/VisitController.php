<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Visit;
use App\Models\Pasien;
use Illuminate\Http\Request;

class VisitController extends Controller
{
    public function index()
    {
        $visits = Visit::with('pasien')->paginate(10);
        return view('admin.visit.index', compact('visits'));
    }

    public function create()
    {
        $pasien = Pasien::all();
        return view('admin.visit.create', compact('pasien'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_pasien' => 'required|exists:pasien,id_pasien',
            'tgl_kunjungan' => 'required|date',
            'keluhan' => 'required',
            'diagnosis' => 'required'
        ]);

        Visit::create($validated);
        return redirect()->route('admin.visit.index')->with('success', 'Data kunjungan berhasil ditambahkan');
    }

    public function show(Visit $visit)
    {
        return view('admin.visit.show', compact('visit'));
    }

    public function edit(Visit $visit)
    {
        $pasien = Pasien::all();
        return view('admin.visit.edit', compact('visit', 'pasien'));
    }

    public function update(Request $request, Visit $visit)
    {
        $validated = $request->validate([
            'id_pasien' => 'required|exists:pasien,id_pasien',
            'tgl_kunjungan' => 'required|date',
            'keluhan' => 'required',
            'diagnosis' => 'required'
        ]);

        $visit->update($validated);
        return redirect()->route('admin.visit.index')->with('success', 'Data kunjungan berhasil diperbarui');
    }

    public function destroy(Visit $visit)
    {
        $visit->delete();
        return redirect()->route('admin.visit.index')->with('success', 'Data kunjungan berhasil dihapus');
    }
}