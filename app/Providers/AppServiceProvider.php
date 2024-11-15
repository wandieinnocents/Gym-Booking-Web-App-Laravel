<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\User;
use Illuminate\Support\Facades\Gate;

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
        
        // gate for instructor schedule class
        Gate::define('schedule-class', function (User $user) {
            return $user->role === 'instructor';
        });

        // gate for members
        Gate::define('book-class', function (User $user) {
            return $user->role === 'member';
        });

    }
}
