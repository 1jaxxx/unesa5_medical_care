<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Visit;
use Illuminate\Support\Facades\Auth;
use App\Models\Mahasiswa;
use App\Models\Dosen;
use App\Models\Staff;
use App\Models\Lainnya;
use App\Models\Prodi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Exports\PasienExport;
use App\Imports\PasienImport;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;

class PasienController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->get('per_page', 10);
        $sort = $request->get('sort', 'created_at');
        $direction = $request->get('direction', 'desc');

        $query = $this->getPasienQuery($request);

        $pasien = $query->orderBy($sort, $direction)->paginate($perPage);

        $type = $request->get('type', 'all');
        $search = $request->get('search');

        $pageTitle = match ($type) {
            'mahasiswa' => 'Data Mahasiswa',
            'dosen' => 'Data Dosen',
            'staff' => 'Data Staff',
            'lainnya' => 'Data Lainnya',
            default => 'Data Semua Pasien',
        };

        return view('admin.pasien.index', compact('pasien', 'type', 'pageTitle', 'sort', 'direction', 'search'));
    }

    private function getPasienQuery(Request $request)
    {
        $user = Auth::user();
        $type = $request->get('type', 'all');
        $search = $request->get('search');

        $mahasiswaQuery = Mahasiswa::with('prodi')->select(
            'id_mahasiswa as id',
            'nama',
            'nim as identifier',
            DB::raw("'mahasiswa' as type"),
            'jenis_kelamin',
            'tgl_lahir',
            'tempat_lahir',
            'id_prodi',
            'email',
            'no_telp',
            'created_at'
        );
        $dosenQuery = Dosen::select(
            'id_dosen as id',
            'nama',
            'nidn as identifier',
            DB::raw("'dosen' as type"),
            'jenis_kelamin',
            'tgl_lahir',
            'tempat_lahir',
            DB::raw("NULL as id_prodi"),
            'email',
            'no_telp',
            'created_at'
        );
        $staffQuery = Staff::select(
            'id_staff as id',
            'nama',
            'bagian as identifier',
            DB::raw("'staff' as type"),
            'jenis_kelamin',
            'tgl_lahir',
            'tempat_lahir',
            DB::raw("NULL as id_prodi"),
            'email',
            'no_telp',
            'created_at'
        );
        $lainnyaQuery = Lainnya::select(
            'id_lainnya as id',
            'nama',
            'nik as identifier',
            DB::raw("'lainnya' as type"),
            'jenis_kelamin',
            'tgl_lahir',
            'tempat_lahir',
            DB::raw("NULL as id_prodi"),
            'email',
            'no_telp',
            'created_at'
        );

        if ($search) {
            $mahasiswaQuery->where(function ($query) use ($search) {
                $query->where('nama', 'like', "%{$search}%")
                    ->orWhere('nim', 'like', "%{$search}%");
            });
            $dosenQuery->where(function ($query) use ($search) {
                $query->where('nama', 'like', "%{$search}%")
                    ->orWhere('nidn', 'like', "%{$search}%");
            });
            $staffQuery->where(function ($query) use ($search) {
                $query->where('nama', 'like', "%{$search}%")
                    ->orWhere('bagian', 'like', "%{$search}%");
            });
            $lainnyaQuery->where(function ($query) use ($search) {
                $query->where('nama', 'like', "%{$search}%")
                    ->orWhere('nik', 'like', "%{$search}%");
            });
        }

        if ($user->role === 'dokter') {
            $visits = Visit::where('dokter_id', $user->id_users)->get();

            $mahasiswaIds = $visits->where('type_pasien', 'mahasiswa')->pluck('id_mahasiswa')->unique();
            $dosenIds = $visits->where('type_pasien', 'dosen')->pluck('id_dosen')->unique();
            $staffIds = $visits->where('type_pasien', 'staff')->pluck('id_staff')->unique();
            $lainnyaIds = $visits->where('type_pasien', 'lainnya')->pluck('id_lainnya')->unique();

            $mahasiswaQuery->whereIn('id_mahasiswa', $mahasiswaIds);
            $dosenQuery->whereIn('id_dosen', $dosenIds);
            $staffQuery->whereIn('id_staff', $staffIds);
            $lainnyaQuery->whereIn('id_lainnya', $lainnyaIds);
        }

        if ($type !== 'all') {
            if ($type === 'mahasiswa') {
                return $mahasiswaQuery;
            } elseif ($type === 'dosen') {
                return $dosenQuery;
            } elseif ($type === 'staff') {
                return $staffQuery;
            } elseif ($type === 'lainnya') {
                return $lainnyaQuery;
            }
        }

        return $mahasiswaQuery->union($dosenQuery)->union($staffQuery)->union($lainnyaQuery);
    }

    public function create(Request $request)
    {
        $type = $request->get('type', 'mahasiswa');
        $prodi = Prodi::all();
        return view('admin.pasien.create', compact('prodi', 'type'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required',
            'type_pasien' => 'required|in:mahasiswa,dosen,staff,lainnya',
            'jenis_kelamin' => 'required|in:L,P',
            'tempat_lahir' => 'required',
            'tgl_lahir' => 'required|date',
            'email' => 'required|email',
            'no_telp' => 'required|numeric|max_digits:13'
        ]);

        switch ($request->type_pasien) {
            case 'mahasiswa':
                $additional = $request->validate([
                    'id_prodi' => 'required|exists:prodi,id_prodi',
                    'nim' => 'required'
                ]);
                Mahasiswa::create(array_merge($validated, $additional));
                break;

            case 'dosen':
                $additional = $request->validate([
                    'nidn' => 'required'
                ]);
                Dosen::create(array_merge($validated, $additional));
                break;

            case 'staff':
                $additional = $request->validate([
                    'bagian' => 'required'
                ]);
                Staff::create(array_merge($validated, $additional));
                break;

            case 'lainnya':
                $additional = $request->validate([
                    'nik' => 'required'
                ]);
                Lainnya::create(array_merge($validated, $additional));
                break;
        }

        return redirect()->route('admin.pasien.index')->with('success', 'Data pasien berhasil ditambahkan');
    }

    public function show($type, $id)
    {
        $pasien = $this->getPasienByType($type, $id);
        if (!$pasien) {
            return abort(404);
        }

        $riwayatKunjungan = \App\Models\RiwayatKunjungan::where('type_pasien', $type)
            ->when($type === 'mahasiswa', function ($query) use ($id) {
                return $query->where('id_mahasiswa', $id);
            })
            ->when($type === 'dosen', function ($query) use ($id) {
                return $query->where('id_dosen', $id);
            })
            ->when($type === 'staff', function ($query) use ($id) {
                return $query->where('id_staff', $id);
            })
            ->when($type === 'lainnya', function ($query) use ($id) {
                return $query->where('id_lainnya', $id);
            })
            ->with('dokter')
            ->orderBy('tgl_kunjungan', 'desc')
            ->get();

        return view('admin.pasien.show', compact('pasien', 'type', 'riwayatKunjungan'));
    }

    public function edit($type, $id)
    {
        $pasien = $this->getPasienByType($type, $id);
        if (!$pasien) {
            return abort(404);
        }
        $prodi = Prodi::all();
        return view('admin.pasien.edit', compact('pasien', 'prodi', 'type'));
    }

    public function update(Request $request, $type, $id)
    {
        $pasien = $this->getPasienByType($type, $id);
        if (!$pasien) {
            return abort(404);
        }

        $validated = $request->validate([
            'nama' => 'required',
            'jenis_kelamin' => 'required|in:L,P',
            'tempat_lahir' => 'required',
            'tgl_lahir' => 'required|date',
            'email' => 'required|email',
            'no_telp' => 'required|numeric|max_digits:13'
        ]);

        switch ($type) {
            case 'mahasiswa':
                $additional = $request->validate([
                    'id_prodi' => 'required|exists:prodi,id_prodi',
                    'nim' => 'required'
                ]);
                $pasien->update(array_merge($validated, $additional));
                break;

            case 'dosen':
                $additional = $request->validate([
                    'nidn' => 'required'
                ]);
                $pasien->update(array_merge($validated, $additional));
                break;

            case 'staff':
                $additional = $request->validate([
                    'bagian' => 'required'
                ]);
                $pasien->update(array_merge($validated, $additional));
                break;
            case 'lainnya':
                $additional = $request->validate([
                    'nik' => 'required'
                ]);
                $pasien->update(array_merge($validated, $additional));
                break;
        }

        return redirect()->route('admin.pasien.index')->with('success', 'Data pasien berhasil diperbarui');
    }

    public function destroy($type, $id)
    {
        $pasien = $this->getPasienByType($type, $id);
        if (!$pasien) {
            return abort(404);
        }

        $pasien->delete();
        return redirect()->route('admin.pasien.index')->with('success', 'Data pasien berhasil dihapus');
    }

    private function getPasienByType($type, $id)
    {
        switch ($type) {
            case 'mahasiswa':
                return Mahasiswa::with('prodi')->find($id);
            case 'dosen':
                return Dosen::find($id);
            case 'staff':
                return Staff::find($id);
            case 'lainnya':
                return Lainnya::find($id);
            default:
                return null;
        }
    }

    public function exportExcel(Request $request)
    {
        $pasien = $this->getPasienQuery($request)->get();
        return Excel::download(new PasienExport($pasien), 'pasien.xlsx');
    }

    public function exportPdf(Request $request)
    {
        $pasien = $this->getPasienQuery($request)->get();
        $pdf = Pdf::loadView('admin.pasien.pdf', ['pasien' => $pasien]);
        return $pdf->stream('pasien.pdf');
    }

    public function importExcel(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls',
        ]);

        try {
            Excel::import(new PasienImport, $request->file('file'));
        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
            $failures = $e->failures();
            // You can log failures or pass them to the view if you want to be more specific
            return redirect()->route('admin.pasien.index')->with('error', 'Gagal mengimpor data. Pastikan semua kolom yang wajib diisi dan formatnya benar.');
        }

        return redirect()->route('admin.pasien.index')->with('success', 'Data pasien berhasil diimpor!');
    }
}
