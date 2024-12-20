<?php

namespace App\Listeners;

use App\Events\ClassCanceled;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class NotifyClassCanceled
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    
    public function handle(ClassCanceled $event): void
    {
        $scheduled_class = $event->scheduled_class;
        \Log::info($scheduled_class);


    }
}
