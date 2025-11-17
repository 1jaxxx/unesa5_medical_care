<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PasienController;
use App\Http\Controllers\Admin\ProdiController;
use App\Http\Controllers\Admin\VisitController;
use App\Http\Controllers\Admin\ScreeningController;
use App\Http\Controllers\Admin\ResepController;
use App\Http\Controllers\Admin\ObatController;

Route::middleware(['auth', 'verified'])->prefix('admin')->as('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Pasien routes with type parameter
    Route::prefix('pasien')->name('pasien.')->controller(PasienController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/', 'store')->name('store');
        Route::get('/{type}/{id}', 'show')->name('show');
        Route::get('/{type}/{id}/edit', 'edit')->name('edit');
        Route::put('/{type}/{id}', 'update')->name('update');
        Route::delete('/{type}/{id}', 'destroy')->name('destroy');
    });

    Route::resource('prodi', controller: ProdiController::class);
    Route::resource('visit', controller: VisitController::class);
    Route::get('screening/{screening}/modal', [ScreeningController::class, 'showModal'])->name('screening.show.modal');
    Route::resource('screening', controller: ScreeningController::class);
    Route::resource('resep', controller: ResepController::class);
});