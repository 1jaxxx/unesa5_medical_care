<?php

namespace App\Providers;

use App\Models\User;
use App\Models\Visit;
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
        Gate::before(function (User $user, $ability) {
            if ($user->role === 'admin') {
                return true;
            }
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
