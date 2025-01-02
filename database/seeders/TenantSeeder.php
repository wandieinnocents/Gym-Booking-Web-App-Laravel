<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Tenant;
use Illuminate\Support\Facades\DB;



class TenantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
            // Create tenants with their respective database credentials
            DB::table('tenants')->updateOrInsert(
                ['code' => 'T001'], 
                [
                    'name' => 'Tenant1',
                    'database_name' => 'tenant1_db',
                    'database_username' => 'root',
                    'database_password' => 'wandie22', 
                ]
            );
            
            DB::table('tenants')->updateOrInsert(
                ['code' => 'T002'], 
                [
                    'name' => 'Tenant2',
                    'database_name' => 'tenant2_db',
                    'database_username' => 'root',
                    'database_password' => 'wandie22', 
                ]
            );

            //multi tenancy in laravel without a package with central database, and two child databases
            

            
    }
}
