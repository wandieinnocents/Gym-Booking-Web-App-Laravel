<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\ScheduledClass;

class IncrementDate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:increment-date {--days=1}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Increment all the scheduled classes date so they never expire';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $scheduled_classes = ScheduledClass::latest('date_time')->get();
        

            if(!empty($scheduled_classes)){
                $scheduled_classes->each(function($class){
                    $class->date_time = $class->date_time->addDays((int) $this->option('days'));
                    $class->save();
                });

                //log info
                $this->info("scheduled classes dates incremented by ". (int) $this->option('days') . "days");

            } else{
                 //log info
                 $this->info("no scheduled classes to increment by a day". (int) $this->option('days') . "days");
            }
           

            

    }
}
