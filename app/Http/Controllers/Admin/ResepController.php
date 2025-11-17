<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Resep;
use App\Models\Obat;
use App\Models\Visit;
use Illuminate\Http\Request;

class ResepController extends Controller
{
    public function index()
    {
        $resep = Resep::with(['obat', 'visit'])->paginate(10);
        return view('admin.resep.index', compact('resep'));
    }

    public function create()
    {
        $obat = Obat::all();
        $visits = Visit::all();
        return view('admin.resep.create', compact('obat', 'visits'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_obat' => 'required|exists:obat,id_obat',
            'id_visit' => 'required|exists:visit,id_visit',
            'dosis' => 'required',
            'jumlah' => 'required|integer|min:1',
            'tgl_diberikan' => 'required|date',
            'catatan' => 'nullable|string'
        ]);

        Resep::create($validated);
        return redirect()->route('admin.resep.index')->with('success', 'Data resep berhasil ditambahkan');
    }

    public function show(Resep $resep)
    {
        return view('admin.resep.show', compact('resep'));
    }

    public function edit(Resep $resep)
    {
        $obat = Obat::all();
        $visits = Visit::all();
        return view('admin.resep.edit', compact('resep', 'obat', 'visits'));
    }

    public function update(Request $request, Resep $resep)
    {
        $validated = $request->validate([
            'id_obat' => 'required|exists:obat,id_obat',
            'id_visit' => 'required|exists:visit,id_visit',
            'dosis' => 'required',
            'jumlah' => 'required|integer|min:1',
            'tgl_diberikan' => 'required|date',
            'catatan' => 'nullable|string'
        ]);

        $resep->update($validated);
        return redirect()->route('admin.resep.index')->with('success', 'Data resep berhasil diperbarui');
    }

    public function destroy(Resep $resep)
    {
        $resep->delete();
        return redirect()->route('admin.resep.index')->with('success', 'Data resep berhasil dihapus');
    }
}