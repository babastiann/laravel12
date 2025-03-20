<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Daftar kebijakan (policies) yang digunakan oleh aplikasi.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Daftarkan Gates dan kebijakan.
     */
    public function boot()
    {
        $this->registerPolicies();

        // Definisikan Gate untuk akses dashboard
        Gate::define('access-dashboard', function (User $user, $role) {
            return $user->userable_type === $role;
        });
    }
}
