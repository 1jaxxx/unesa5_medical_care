<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Resep;
use App\Models\Obat;
use App\Models\Visit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Exports\ResepExport;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;

class ResepController extends Controller
{
    private function getResepQuery(Request $request)
    {
        $search = $request->get('search');
        $query = Resep::with(['obat', 'visit.mahasiswa', 'visit.dosen', 'visit.staff', 'visit.dokter']);

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('dosis', 'like', "%{$search}%")
                  ->orWhere('catatan', 'like', "%{$search}%")
                  ->orWhereHas('obat', function ($q) use ($search) {
                      $q->where('nama_obat', 'like', "%{$search}%");
                  })
                  ->orWhereHas('visit', function ($q) use ($search) {
                      $q->whereHas('mahasiswa', function ($q) use ($search) {
                          $q->where('nama', 'like', "%{$search}%");
                      })->orWhereHas('dosen', function ($q) use ($search) {
                          $q->where('nama', 'like', "%{$search}%");
                      })->orWhereHas('staff', function ($q) use ($search) {
                          $q->where('nama', 'like', "%{$search}%");
                      })->orWhereHas('dokter', function ($q) use ($search) {
                          $q->where('nama', 'like', "%{$search}%");
                      });
                  });
            });
        }

        return $query;
    }

    public function index(Request $request)
    {
        $sort = $request->get('sort', 'tgl_diberikan');
        $direction = $request->get('direction', 'desc');

        $resep = $this->getResepQuery($request)->orderBy($sort, $direction)->paginate(10);
        
        return view('admin.resep.index', [
            'resep' => $resep,
            'search' => $request->get('search'),
            'sort' => $sort,
            'direction' => $direction
        ]);
    }

    public function create()
    {
        $obat = Obat::orderBy('nama_obat', 'asc')->get();
        
        $user = Auth::user();
        $visitQuery = Visit::with('mahasiswa', 'dosen', 'staff', 'dokter')
            ->leftJoin('mahasiswa', 'visit.id_mahasiswa', '=', 'mahasiswa.id_mahasiswa')
            ->leftJoin('dosen', 'visit.id_dosen', '=', 'dosen.id_dosen')
            ->leftJoin('staff', 'visit.id_staff', '=', 'staff.id_staff')
            ->select('visit.*') // Prevents column name collisions
            ->orderByRaw('COALESCE(mahasiswa.nama, dosen.nama, staff.nama) ASC');

        if ($user->role === 'dokter') {
            $visitQuery->where('visit.dokter_id', $user->id_users);
        }

        $visits = $visitQuery->get();

        return view('admin.resep.create', compact('obat', 'visits'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_obat' => 'required|exists:obat,id_obat',
            'id_visit' => 'required|exists:visit,id_visit',
            'dosis' => 'required',
            'jumlah' => [
                'required',
                'integer',
                'min:1',
                function ($attribute, $value, $fail) use ($request) {
                    $obat = Obat::find($request->id_obat);
                    if ($obat && $obat->stok < $value) {
                        $fail("Stok obat tidak mencukupi. Stok tersedia: {$obat->stok}.");
                    }
                },
            ],
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
        $obat = Obat::orderBy('nama_obat', 'asc')->get();

        $user = Auth::user();
        $visitQuery = Visit::with('mahasiswa', 'dosen', 'staff', 'dokter')
            ->leftJoin('mahasiswa', 'visit.id_mahasiswa', '=', 'mahasiswa.id_mahasiswa')
            ->leftJoin('dosen', 'visit.id_dosen', '=', 'dosen.id_dosen')
            ->leftJoin('staff', 'visit.id_staff', '=', 'staff.id_staff')
            ->select('visit.*') // Prevents column name collisions
            ->orderByRaw('COALESCE(mahasiswa.nama, dosen.nama, staff.nama) ASC');
        
        if ($user->role === 'dokter') {
            $visitQuery->where('visit.dokter_id', $user->id_users);
        }

        $visits = $visitQuery->get();

        return view('admin.resep.edit', compact('resep', 'obat', 'visits'));
    }

    public function update(Request $request, Resep $resep)
    {
        $validated = $request->validate([
            'id_obat' => 'required|exists:obat,id_obat',
            'id_visit' => 'required|exists:visit,id_visit',
            'dosis' => 'required',
            'jumlah' => [
                'required',
                'integer',
                'min:1',
                function ($attribute, $value, $fail) use ($request, $resep) {
                    $obat = Obat::find($request->id_obat);
                    if (!$obat) return; // Obat not found, other validation will catch this.

                    $stokTersedia = $obat->stok;
                    // Jika obat yang diedit sama dengan obat sebelumnya, tambahkan stok yang sudah diresepkan
                    if ($request->id_obat == $resep->id_obat) {
                        $stokTersedia += $resep->jumlah;
                    }

                    if ($stokTersedia < $value) {
                        $fail("Stok obat tidak mencukupi. Stok tersedia untuk diresepkan: {$stokTersedia}.");
                    }
                },
            ],
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

    public function exportExcel(Request $request)
    {
        $resep = $this->getResepQuery($request)->get();
        return Excel::download(new ResepExport($resep), 'reseps.xlsx');
    }

    public function exportPdf(Request $request)
    {
        $resep = $this->getResepQuery($request)->get();
        $pdf = Pdf::loadView('admin.resep.pdf', ['resep' => $resep]);
        return $pdf->stream('laporan-resep.pdf');
    }
}