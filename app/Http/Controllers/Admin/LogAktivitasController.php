<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LogAktivitas;
use Illuminate\Http\Request;

class LogAktivitasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $logs = LogAktivitas::with('user')->latest('waktu')->paginate(20);
        return view('admin.log_aktivitas.index', compact('logs'));
    }
}

