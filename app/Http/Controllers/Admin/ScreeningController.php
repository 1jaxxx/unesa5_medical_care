<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Screening;
use App\Models\Visit;
use App\Models\Mahasiswa;
use App\Models\Dosen;
use App\Models\Staff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ScreeningController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $query = Screening::with(['mahasiswa', 'dosen', 'staff', 'visit']);

        if ($user->role === 'dokter') {
            $query->whereHas('visit', function ($q) use ($user) {
                $q->where('dokter_id', $user->id_users);
            });
        }

        $screenings = $query->paginate(10);
        return view('admin.screening.index', compact('screenings'));
    }

    public function create(Visit $visit)
    {
        $this->authorize('perform-screening', $visit);
        return view('admin.screening.create', compact('visit'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_visit' => 'required|exists:visit,id_visit|unique:screening,id_visit',
            'tgl_screening' => 'required|date',
            'berat_badan' => 'required|numeric|min:0',
            'tinggi_badan' => 'required|numeric|min:0',
            'pendengaran' => 'required|string',
            'penglihatan' => 'required|string',
            'tekanan_darah' => 'required|string',
            'status_gizi' => 'required|string',
            'kecacatan' => 'required|string',
            'kebugaran' => 'required|in:kurang,cukup,bugar'
        ]);

        $visit = Visit::find($validated['id_visit']);
        $this->authorize('perform-screening', $visit);

        $tinggi_m = $validated['tinggi_badan'] / 100;
        $imt = ($tinggi_m > 0) ? ($validated['berat_badan'] / ($tinggi_m * $tinggi_m)) : 0;

        $data = array_merge($validated, [
            'imt' => round($imt, 2),
            'type_pasien' => $visit->type_pasien,
            'id_mahasiswa' => $visit->id_mahasiswa,
            'id_dosen' => $visit->id_dosen,
            'id_staff' => $visit->id_staff,
        ]);

        Screening::create($data);
        return redirect()->route('admin.screening.index')->with('success', 'Data screening berhasil ditambahkan');
    }

    public function show(Screening $screening)
    {
        // This is now used for the dedicated page, which is fine to keep
        return view('admin.screening.show', compact('screening'));
    }

    public function showModal(Screening $screening)
    {
        $screening->load(['mahasiswa', 'dosen', 'staff', 'visit.mahasiswa', 'visit.dosen', 'visit.staff']);
        return view('admin.screening._show_modal', compact('screening'));
    }

    public function edit(Screening $screening)
    {
        $visits = Visit::whereDoesntHave('screening')->with(['mahasiswa', 'dosen', 'staff'])->orWhere('id_visit', $screening->id_visit)->get();
        return view('admin.screening.edit', compact('screening', 'visits'));
    }

    public function update(Request $request, Screening $screening)
    {
        $validated = $request->validate([
            'id_visit' => 'required|exists:visit,id_visit|unique:screening,id_visit,' . $screening->id_screening . ',id_screening',
            'tgl_screening' => 'required|date',
            'berat_badan' => 'required|numeric|min:0',
            'tinggi_badan' => 'required|numeric|min:0',
            'pendengaran' => 'required|string',
            'penglihatan' => 'required|string',
            'tekanan_darah' => 'required|string',
            'status_gizi' => 'required|string',
            'kecacatan' => 'required|string',
            'kebugaran' => 'required|in:kurang,cukup,bugar'
        ]);

        $visit = Visit::find($validated['id_visit']);
        $tinggi_m = $validated['tinggi_badan'] / 100;
        $imt = ($tinggi_m > 0) ? ($validated['berat_badan'] / ($tinggi_m * $tinggi_m)) : 0;

        $data = array_merge($validated, [
            'imt' => round($imt, 2),
            'type_pasien' => $visit->type_pasien,
            'id_mahasiswa' => $visit->id_mahasiswa,
            'id_dosen' => $visit->id_dosen,
            'id_staff' => $visit->id_staff,
        ]);

        $screening->update($data);
        return redirect()->route('admin.screening.index')->with('success', 'Data screening berhasil diperbarui');
    }

    public function destroy(Screening $screening)
    {
        $screening->delete();
        return redirect()->route('admin.screening.index')->with('success', 'Data screening berhasil dihapus');
    }
}