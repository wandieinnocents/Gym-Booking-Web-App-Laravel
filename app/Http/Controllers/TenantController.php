<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use App\Models\Tenant;

class TenantController extends Controller
{
    public function createTenant($tenantName, $tenantCode, $databaseName, $databaseUser, $databasePassword)
    {


        // Create tenant record in the tenants table
        $tenant = Tenant::create([
            'name' => $tenantName,
            'code' => $tenantCode,
            'database_name' => $databaseName,
            'database_username' => $databaseUser,
            'database_password' => $databasePassword,
        ]);

        // Create the tenant's database
        DB::statement("CREATE DATABASE {$tenant->database_name}");

        // Configure tenant's database connection dynamically
        config([
            'database.connections.tenant' => [
                'driver' => 'mysql',
                'host' => env('DB_HOST', '127.0.0.1'),
                'database' => $tenant->database_name,
                'username' => $tenant->database_username,
                'password' => $tenant->database_password,
                'charset' => 'utf8mb4',
                'collation' => 'utf8mb4_unicode_ci',
            ],
        ]);

        // Switch to the tenant connection and run migrations
        DB::purge('tenant');
        DB::setDefaultConnection('tenant');
        Artisan::call('migrate', ['--database' => 'tenant']);

        // // Run seeders
        // Artisan::call('db:seed', ['--database' => 'tenant']);

        return "Tenant {$tenantName} created successfully with database {$databaseName}.";
    }
}
