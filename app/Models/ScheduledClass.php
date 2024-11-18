<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Builder;

use Illuminate\Database\Eloquent\Model;

class ScheduledClass extends Model
{

    use HasFactory, Notifiable;
    protected $guarded = null;

    protected $casts = [
        'date_time' => 'datetime'
        
    ];
    
    public function instructor(){
        return $this->belongsTo(User::class,'instructor_id');
    }

    public function class_type(){
        return $this->belongsTo(ClassType::class);
    }

    public function members(){
        return $this->belongsToMany(User::class,'bookings');
    }


    //create a scope for scheuled class time greater than now
    public function scopeUpcoming(Builder $query){
        return $query->where('date_time','>',now());
    }

    public function  scopeIncoming(Builder $query){
        return $query->where('user_id', auth()->user()->id);
    }

 
    public function scopeNotBooked(Builder $query){
        $query->whereDoesntHave('members',function($query){
            $query->where('user_id', auth()->user()->id);
        } );
    }

}
