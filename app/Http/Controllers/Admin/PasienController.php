<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pasien;
use App\Models\Prodi;
use Illuminate\Http\Request;

class PasienController extends Controller
{
    public function index()
    {
        $pasien = Pasien::with('prodi')->paginate(10);
        return view('admin.pasien.index', compact('pasien'));
    }

    public function create()
    {
        $prodi = Prodi::all();
        return view('admin.pasien.create', compact('prodi'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_prodi' => 'required',
            'nama' => 'required',
            'type_pasien' => 'required',
            'nim' => 'required_if:type_pasien,mahasiswa',
            'nidn' => 'required_if:type_pasien,dosen',
            'bagian' => 'required_if:type_pasien,staff',
            'jenis_kelamin' => 'required',
            'tempat_lahir' => 'required',
            'tgl_lahir' => 'required|date',
            'email' => 'required|email',
            'no_telp' => 'required'
        ]);

        Pasien::create($validated);
        return redirect()->route('admin.pasien.index')->with('success', 'Data pasien berhasil ditambahkan');
    }

    public function show(Pasien $pasien)
    {
        return view('admin.pasien.show', compact('pasien'));
    }

    public function edit(Pasien $pasien)
    {
        $prodi = Prodi::all();
        return view('admin.pasien.edit', compact('pasien', 'prodi'));
    }

    public function update(Request $request, Pasien $pasien)
    {
        $validated = $request->validate([
            'id_prodi' => 'required',
            'nama' => 'required',
            'type_pasien' => 'required',
            'nim' => 'required_if:type_pasien,mahasiswa',
            'nidn' => 'required_if:type_pasien,dosen',
            'bagian' => 'required_if:type_pasien,staff',
            'jenis_kelamin' => 'required',
            'tempat_lahir' => 'required',
            'tgl_lahir' => 'required|date',
            'email' => 'required|email',
            'no_telp' => 'required'
        ]);

        $pasien->update($validated);
        return redirect()->route('admin.pasien.index')->with('success', 'Data pasien berhasil diperbarui');
    }

    public function destroy(Pasien $pasien)
    {
        $pasien->delete();
        return redirect()->route('admin.pasien.index')->with('success', 'Data pasien berhasil dihapus');
    }
}