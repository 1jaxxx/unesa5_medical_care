<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Obat;
use Illuminate\Http\Request;
use App\Exports\ObatExport;
use App\Imports\ObatImport;
use Maatwebsite\Excel\Facades\Excel;

class ObatController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search');
        $sort = $request->get('sort', 'nama_obat');
        $direction = $request->get('direction', 'asc');
        $stock_status = $request->get('stock_status');

        $query = Obat::query();

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('nama_obat', 'like', "%{$search}%")
                  ->orWhere('jenis_obat', 'like', "%{$search}%");
            });
        }

        if ($stock_status === 'in_stock') {
            $query->where('stok', '>', 0);
        } elseif ($stock_status === 'out_of_stock') {
            $query->where('stok', '=', 0);
        }

        $obat = $query->orderBy($sort, $direction)->paginate(10);
        
        return view('admin.obat.index', compact('obat', 'search', 'sort', 'direction', 'stock_status'));
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

    public function exportExcel()
    {
        return Excel::download(new ObatExport, 'obats.xlsx');
    }

    public function exportPdf()
    {
        return Excel::download(new ObatExport, 'obats.pdf', \Maatwebsite\Excel\Excel::DOMPDF);
    }

    public function importExcel(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls',
        ]);

        Excel::import(new ObatImport, $request->file('file'));

        return redirect()->route('admin.obat.index')->with('success', 'Data obat berhasil diimpor!');
    }
}