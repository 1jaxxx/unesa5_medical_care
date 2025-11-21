<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\LogAktivitasController;
use App\Http\Controllers\Admin\ObatController;
use App\Http\Controllers\Admin\PasienController;
use App\Http\Controllers\Admin\ProdiController;
use App\Http\Controllers\Admin\ResepController;
use App\Http\Controllers\Admin\ScreeningController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\VisitController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'verified'])->prefix('admin')->as('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard/data', [DashboardController::class, 'getData'])->name('dashboard.data');
    Route::get('/dashboard/realtime', [DashboardController::class, 'getRealtime'])->name('dashboard.realtime');

    // Pasien routes with type parameter
    Route::prefix('pasien')->name('pasien.')->controller(PasienController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/', 'store')->name('store');
        Route::get('/{type}/{id}', 'show')->name('show');
        Route::get('/{type}/{id}/edit', 'edit')->name('edit');
        Route::put('/{type}/{id}', 'update')->name('update');
        Route::delete('/{type}/{id}', 'destroy')->name('destroy');
        Route::get('/export/excel', 'exportExcel')->name('export.excel');
        Route::get('/export/pdf', 'exportPdf')->name('export.pdf');
        Route::post('/import/excel', 'importExcel')->name('import.excel');
    });

    Route::get('prodi/export/excel', [ProdiController::class, 'exportExcel'])->name('prodi.export.excel');
    Route::get('prodi/export/pdf', [ProdiController::class, 'exportPdf'])->name('prodi.export.pdf');
    Route::post('prodi/import/excel', [ProdiController::class, 'importExcel'])->name('prodi.import.excel');
    Route::resource('prodi', controller: ProdiController::class);
    Route::get('my-visits', [VisitController::class, 'myVisits'])->name('visit.my_visits')->middleware('can:view-my-visits');
    Route::get('visit/export/excel', [VisitController::class, 'exportExcel'])->name('visit.export.excel');
    Route::get('visit/export/pdf', [VisitController::class, 'exportPdf'])->name('visit.export.pdf');
    Route::resource('visit', controller: VisitController::class);
    Route::get('screening/{screening}/modal', [ScreeningController::class, 'showModal'])->name('screening.show.modal');
    Route::get('visits/{visit}/screening/create', [ScreeningController::class, 'create'])->name('screening.create_for_visit');
    Route::get('screening/export/excel', [ScreeningController::class, 'exportExcel'])->name('screening.export.excel');
    Route::get('screening/export/pdf', [ScreeningController::class, 'exportPdf'])->name('screening.export.pdf');
    Route::resource('screening', controller: ScreeningController::class);
    Route::get('resep/export/excel', [ResepController::class, 'exportExcel'])->name('resep.export.excel');
    Route::get('resep/export/pdf', [ResepController::class, 'exportPdf'])->name('resep.export.pdf');
    Route::resource('resep', controller: ResepController::class);
    Route::get('obat/export/excel', [ObatController::class, 'exportExcel'])->name('obat.export.excel');
    Route::get('obat/export/pdf', [ObatController::class, 'exportPdf'])->name('obat.export.pdf');
    Route::post('obat/import/excel', [ObatController::class, 'importExcel'])->name('obat.import.excel');
    Route::resource('obat', controller: ObatController::class);

    Route::resource('users', controller: UserController::class)->middleware('can:manage-users');
    Route::get('/users/export/excel', [UserController::class, 'exportExcel'])->name('users.export.excel')->middleware('can:manage-users');
    Route::get('/users/export/pdf', [UserController::class, 'exportPdf'])->name('users.export.pdf')->middleware('can:manage-users');
    Route::get('logs', [LogAktivitasController::class, 'index'])->name('logs.index')->middleware('can:manage-users');
});
