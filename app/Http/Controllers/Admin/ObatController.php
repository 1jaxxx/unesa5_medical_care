<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Obat;
use Illuminate\Http\Request;

class ObatController extends Controller
{
    public function index()
    {
        $obat = Obat::paginate(10);
        return view('admin.obat.index', compact('obat'));
    }

    public function create()
    {
        return view('admin.obat.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_obat' => 'required',
            'jenis_obat' => 'required',
            'tgl_kadaluarsa' => 'required|date',
            'stok' => 'required|integer|min:0'
        ]);

        Obat::create($validated);
        return redirect()->route('admin.obat.index')->with('success', 'Data obat berhasil ditambahkan');
    }

    public function show(Obat $obat)
    {
        return view('admin.obat.show', compact('obat'));
    }

    public function edit(Obat $obat)
    {
        return view('admin.obat.edit', compact('obat'));
    }

    public function update(Request $request, Obat $obat)
    {
        $validated = $request->validate([
            'nama_obat' => 'required',
            'jenis_obat' => 'required',
            'tgl_kadaluarsa' => 'required|date',
            'stok' => 'required|integer|min:0'
        ]);

        $obat->update($validated);
        return redirect()->route('admin.obat.index')->with('success', 'Data obat berhasil diperbarui');
    }

    public function destroy(Obat $obat)
    {
        $obat->delete();
        return redirect()->route('admin.obat.index')->with('success', 'Data obat berhasil dihapus');
    }
}