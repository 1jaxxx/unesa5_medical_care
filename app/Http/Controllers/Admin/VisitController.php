<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Visit;
use App\Models\Mahasiswa;
use App\Models\Dosen;
use App\Models\Staff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VisitController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $query = Visit::with(['mahasiswa', 'dosen', 'staff', 'dokter']);

        if ($user->role === 'dokter') {
            $query->where('dokter_id', $user->id_users);
        }

        $visits = $query->paginate(10);
        return view('admin.visit.index', compact('visits'));
    }

    public function myVisits()
    {
        $user = Auth::user();
        $visits = Visit::with(['mahasiswa', 'dosen', 'staff', 'dokter'])
            ->where('dokter_id', $user->id_users)
            ->paginate(10);
        return view('admin.visit.my_visits', compact('visits'));
    }

    public function create()
    {
        $mahasiswa = Mahasiswa::select('id_mahasiswa as id', 'nama', DB::raw("'mahasiswa' as type"))->get();
        $dosen = Dosen::select('id_dosen as id', 'nama', DB::raw("'dosen' as type"))->get();
        $staff = Staff::select('id_staff as id', 'nama', DB::raw("'staff' as type"))->get();

        $pasien = $mahasiswa->concat($dosen)->concat($staff);
        $dokters = User::where('role', 'dokter')->get();
        return view('admin.visit.create', compact('pasien', 'dokters'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'pasien' => ['required', 'string', function ($attribute, $value, $fail) {
                list($type, $id) = explode('-', $value);
                if (!in_array($type, ['mahasiswa', 'dosen', 'staff'])) {
                    $fail('Tipe pasien tidak valid.');
                    return;
                }
                $model = 'App\\Models\\' . ucfirst($type);
                $pk = 'id_' . $type;
                if (!$model::where($pk, $id)->exists()) {
                    $fail('Pasien yang dipilih tidak valid.');
                }
            }],
            'tgl_kunjungan' => 'required|date',
            'keluhan' => 'required|string',
            'diagnosis' => 'required|string',
            'dokter_id' => 'required|integer|exists:users,id_users,role,dokter',
        ]);

        list($type, $id) = explode('-', $request->pasien);

        Visit::create([
            'type_pasien' => $type,
            'id_' . $type => $id,
            'tgl_kunjungan' => $validated['tgl_kunjungan'],
            'keluhan' => $validated['keluhan'],
            'diagnosis' => $validated['diagnosis'],
            'dokter_id' => $validated['dokter_id'],
        ]);

        return redirect()->route('admin.visit.index')->with('success', 'Data kunjungan berhasil ditambahkan');
    }

    public function show(Visit $visit)
    {
        return view('admin.visit.show', compact('visit'));
    }

    public function edit(Visit $visit)
    {
        $mahasiswa = Mahasiswa::select('id_mahasiswa as id', 'nama', DB::raw("'mahasiswa' as type"))->get();
        $dosen = Dosen::select('id_dosen as id', 'nama', DB::raw("'dosen' as type"))->get();
        $staff = Staff::select('id_staff as id', 'nama', DB::raw("'staff' as type"))->get();

        $pasien = $mahasiswa->concat($dosen)->concat($staff);
        $dokters = User::where('role', 'dokter')->get();
        return view('admin.visit.edit', compact('visit', 'pasien', 'dokters'));
    }

    public function update(Request $request, Visit $visit)
    {
        $validated = $request->validate([
            'pasien' => ['required', 'string', function ($attribute, $value, $fail) {
                list($type, $id) = explode('-', $value);
                if (!in_array($type, ['mahasiswa', 'dosen', 'staff'])) {
                    $fail('Tipe pasien tidak valid.');
                    return;
                }
                $model = 'App\\Models\\' . ucfirst($type);
                $pk = 'id_' . $type;
                if (!$model::where($pk, $id)->exists()) {
                    $fail('Pasien yang dipilih tidak valid.');
                }
            }],
            'tgl_kunjungan' => 'required|date',
            'keluhan' => 'required|string',
            'diagnosis' => 'required|string',
            'dokter_id' => 'required|integer|exists:users,id_users,role,dokter',
            'status' => 'required|string|in:pending,inprogress,completed',
        ]);

        list($type, $id) = explode('-', $request->pasien);

        $visit->update([
            'type_pasien' => $type,
            'id_mahasiswa' => $type === 'mahasiswa' ? $id : null,
            'id_dosen' => $type === 'dosen' ? $id : null,
            'id_staff' => $type === 'staff' ? $id : null,
            'tgl_kunjungan' => $validated['tgl_kunjungan'],
            'keluhan' => $validated['keluhan'],
            'diagnosis' => $validated['diagnosis'],
            'dokter_id' => $validated['dokter_id'],
            'status' => $validated['status'],
        ]);

        return redirect()->route('admin.visit.index')->with('success', 'Data kunjungan berhasil diperbarui');
    }

    public function destroy(Visit $visit)
    {
        $visit->delete();
        return redirect()->route('admin.visit.index')->with('success', 'Data kunjungan berhasil dihapus');
    }
}