<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tenant extends Model
{
    protected $fillable = [
        'name',
        'database_name',
        'database_username',
        'database_password',
        'code',
    ];
}
