<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Prodi;
use Illuminate\Http\Request;

class ProdiController extends Controller
{
    public function index()
    {
        $prodi = Prodi::paginate(10);
        return view('admin.prodi.index', compact('prodi'));
    }

    public function create()
    {
        return view('admin.prodi.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_prodi' => 'required'
        ]);

        Prodi::create($validated);
        return redirect()->route('admin.prodi.index')->with('success', 'Program studi berhasil ditambahkan');
    }

    public function show(Prodi $prodi)
    {
        return view('admin.prodi.show', compact('prodi'));
    }

    public function edit(Prodi $prodi)
    {
        return view('admin.prodi.edit', compact('prodi'));
    }

    public function update(Request $request, Prodi $prodi)
    {
        $validated = $request->validate([
            'nama_prodi' => 'required'
        ]);

        $prodi->update($validated);
        return redirect()->route('admin.prodi.index')->with('success', 'Program studi berhasil diperbarui');
    }

    public function destroy(Prodi $prodi)
    {
        $prodi->delete();
        return redirect()->route('admin.prodi.index')->with('success', 'Program studi berhasil dihapus');
    }
}