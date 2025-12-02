<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Obat;
use Illuminate\Http\Request;
use App\Exports\ObatExport;
use App\Imports\ObatImport;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Database\QueryException;

class ObatController extends Controller
{
    private function getObatQuery(Request $request)
    {
        $search = $request->get('search');
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

        return $query;
    }

    public function index(Request $request)
    {
        $sort = $request->get('sort', 'nama_obat');
        $direction = $request->get('direction', 'asc');
        
        $obat = $this->getObatQuery($request)->orderBy($sort, $direction)->paginate(10);
        
        return view('admin.obat.index', [
            'obat' => $obat,
            'search' => $request->get('search'),
            'sort' => $sort,
            'direction' => $direction,
            'stock_status' => $request->get('stock_status')
        ]);
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
        try {
            $obat->delete();
            return redirect()->route('admin.obat.index')->with('success', 'Data obat berhasil dihapus');
        } catch (QueryException $e) {
            $errorCode = $e->errorInfo[1];
            if ($errorCode == 1451) {
                return redirect()->route('admin.obat.index')->with('error', 'Data obat tidak dapat dihapus karena masih terhubung dengan data resep.');
            }
            return redirect()->route('admin.obat.index')->with('error', 'Terjadi kesalahan saat menghapus data obat.');
        }
    }

    public function exportExcel(Request $request)
    {
        $obats = $this->getObatQuery($request)->get();
        return Excel::download(new ObatExport($obats), 'obats.xlsx');
    }

    public function exportPdf(Request $request)
    {
        $obats = $this->getObatQuery($request)->get();
        $pdf = Pdf::loadView('admin.obat.pdf', ['obats' => $obats]);
        return $pdf->stream('laporan-obat.pdf');
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