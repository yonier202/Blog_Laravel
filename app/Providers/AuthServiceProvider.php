<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        // Gate::define('admin', function($user){
        //     return $user->is_admin; //retorna true o false
        // });

        // Gate::define('author', function($user, $post){
        //     return $user->id === $post->user_id; //retorna true o false
        // });
        //---------------------------------------
        //ASIGNAR ROL DE SUPER ADMIN
        Gate::after(function ($user, $ability) {
            return $user->hasRole('SuperAdmin'); // note this returns boolean
         });
    }
}
