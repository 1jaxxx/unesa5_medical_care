<?php

namespace App\Providers;

use App\Models\Dosen;
use App\Models\Mahasiswa;
use App\Models\Obat;
use App\Models\Prodi;
use App\Models\Resep;
use App\Models\Screening;
use App\Models\Staff;
use App\Models\User;
use App\Models\Visit;
use App\Observers\DosenObserver;
use App\Observers\MahasiswaObserver;
use App\Observers\ObatObserver;
use App\Observers\ProdiObserver;
use App\Observers\ResepObserver;
use App\Observers\ScreeningObserver;
use App\Observers\StaffObserver;
use App\Observers\UserObserver;
use App\Observers\VisitObserver;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Visit::observe(VisitObserver::class);
        Obat::observe(ObatObserver::class);
        Prodi::observe(ProdiObserver::class);
        Screening::observe(ScreeningObserver::class);
        Resep::observe(ResepObserver::class);
        Mahasiswa::observe(MahasiswaObserver::class);
        Dosen::observe(DosenObserver::class);
        Staff::observe(StaffObserver::class);
        User::observe(UserObserver::class);

        Gate::before(function (User $user, $ability) {
            if ($user->role === 'admin' && $ability !== 'view-my-visits') {
                return true;
            }
            return null; // Tambahkan ini untuk kejelasan, meskipun defaultnya adalah null
        });

        Gate::define('manage-users', function (User $user) {
            return $user->role === 'admin';
        });

        Gate::define('add-pasien', function (User $user) {
            return $user->role === 'petugas';
        });

        Gate::define('add-prodi', function (User $user) {
            return $user->role === 'petugas';
        });

        Gate::define('add-visit', function (User $user) {
            return $user->role === 'petugas';
        });

        Gate::define('add-obat', function (User $user) {
            return $user->role === 'petugas';
        });

        Gate::define('add-screening', function (User $user) {
            return $user->role === 'dokter';
        });

        Gate::define('add-resep', function (User $user) {
            return $user->role === 'dokter';
        });

        Gate::define('view-my-visits', function (User $user) {
            return $user->role === 'dokter';
        });

        Gate::define('perform-screening', function (User $user, Visit $visit) {
            return $user->id_users === $visit->dokter_id;
        });
    }
}
