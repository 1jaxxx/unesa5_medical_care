<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Prodi;
use Illuminate\Http\Request;
use App\Exports\ProdiExport;
use App\Imports\ProdiImport;
use Maatwebsite\Excel\Facades\Excel;

class ProdiController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search');
        $sort = $request->get('sort', 'nama_prodi');
        $direction = $request->get('direction', 'asc');

        $query = Prodi::query();

        if ($search) {
            $query->where('nama_prodi', 'like', "%{$search}%");
        }

        $prodi = $query->orderBy($sort, $direction)->paginate(10);

        return view('admin.prodi.index', compact('prodi', 'search', 'sort', 'direction'));
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

    public function exportExcel()
    {
        return Excel::download(new ProdiExport, 'prodi.xlsx');
    }

    public function exportPdf()
    {
        return Excel::download(new ProdiExport, 'prodi.pdf', \Maatwebsite\Excel\Excel::DOMPDF);
    }

    public function importExcel(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls',
        ]);

        Excel::import(new ProdiImport, $request->file('file'));

        return redirect()->route('admin.prodi.index')->with('success', 'Data prodi berhasil diimpor!');
    }
}