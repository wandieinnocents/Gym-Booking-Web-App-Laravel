<?php

namespace App\Policies;
use App\Models\ScheduledClass;

use App\Models\User;

class ScheduledClassPolicy
{
    /**a
     * Create a new policy instance.
     */
    public function __construct()
    {
       
    }

     //add policies for scheduled class
     public function delete(User $user, ScheduledClass $scheduledClass){
        return $user->id === $scheduledClass->instructor_id;
    }

    
}
