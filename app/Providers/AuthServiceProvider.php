<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

            // Roles based authorization
        Gate::before(
            function ($user, $ability) {
                if ($user->role === 'admin') {
                    return true;
                }
            }
        );

        foreach (self::$permissions as $action=> $roles) {
            Gate::define(
                $action,
                function (User $user) use ($roles) {
                    if (in_array($user->role, $roles)) {
                        return true;
                    }
                }
            );
        }
    }

    public static $permissions = [
        'read-karyawan' => ['admin', 'manajer'],
        'add-karyawan' => ['admin'],
        'manage-karyawan' => ['admin'],
        'read-karyawancuti' => ['admin', 'manajer'],
        'add-karyawancuti' => ['admin',],
        'manage-karyawancuti' => ['admin'],
        'read-proyekkaryawan' => ['admin', 'manajer'],
        'add-proyekkaryawan' => ['admin'],
        'manage-proyekkaryawan' => ['admin'],
    ];
}
