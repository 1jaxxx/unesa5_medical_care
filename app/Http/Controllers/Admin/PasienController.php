<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Mahasiswa;
use App\Models\Dosen;
use App\Models\Staff;
use App\Models\Prodi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PasienController extends Controller
{
    public function index(Request $request)
    {
        $type = $request->get('type', 'all');
           $perPage = $request->get('per_page', 10);
           $sort = $request->get('sort', 'created_at');
           $direction = $request->get('direction', 'desc');
        
        // Query untuk mahasiswa
        $mahasiswa = Mahasiswa::with('prodi')
              ->select(
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
            
        // Query untuk dosen
        $dosen = Dosen::select(
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
        
        // Query untuk staff
        $staff = Staff::select(
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

        // Filter berdasarkan tipe jika ada
        if ($type !== 'all') {
            if ($type === 'mahasiswa') {
                 $pasien = $mahasiswa->orderBy($sort, $direction)->paginate($perPage);
            } elseif ($type === 'dosen') {
                 $pasien = $dosen->orderBy($sort, $direction)->paginate($perPage);
            } elseif ($type === 'staff') {
                 $pasien = $staff->orderBy($sort, $direction)->paginate($perPage);
            }
        } else {
            // Union semua query jika tidak ada filter
            $pasien = $mahasiswa->union($dosen)->union($staff)
                 ->orderBy($sort, $direction)
                 ->paginate($perPage);
        }

           $pageTitle = match($type) {
              'mahasiswa' => 'Data Mahasiswa',
              'dosen' => 'Data Dosen',
              'staff' => 'Data Staff',
              default => 'Data Semua Pasien',
           };

           return view('admin.pasien.index', compact('pasien', 'type', 'pageTitle', 'sort', 'direction'));
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
            'type_pasien' => 'required|in:mahasiswa,dosen,staff',
            'jenis_kelamin' => 'required|in:L,P',
            'tempat_lahir' => 'required',
            'tgl_lahir' => 'required|date',
            'email' => 'required|email',
            'no_telp' => 'required'
        ]);

        switch($request->type_pasien) {
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
        }

        return redirect()->route('admin.pasien.index')->with('success', 'Data pasien berhasil ditambahkan');
    }

    public function show($type, $id)
    {
        $pasien = $this->getPasienByType($type, $id);
        if (!$pasien) {
            return abort(404);
        }
        return view('admin.pasien.show', compact('pasien', 'type'));
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
            'no_telp' => 'required'
        ]);

        switch($type) {
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
        switch($type) {
            case 'mahasiswa':
                return Mahasiswa::with('prodi')->find($id);
            case 'dosen':
                return Dosen::find($id);
            case 'staff':
                return Staff::find($id);
            default:
                return null;
        }
    }
}