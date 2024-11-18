<?php

namespace App\Providers;

// use Illuminate\Support\ServiceProvider;
use App\Events\ClassCanceled;
use App\Listeners\NotifyClassCanceled;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;


class EventServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    protected $listen = [
        //event and listener classes
        ClassCanceled::class => [
            NotifyClassCanceled::class,
        ],
    ];

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // parent::boot();
    }
}
