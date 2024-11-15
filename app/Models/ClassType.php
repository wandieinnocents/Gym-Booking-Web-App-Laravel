<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClassType extends Model
{
    public function scheduled_classes(){
        return $this->hasMany(ScheduledClass::class);
    }
}
