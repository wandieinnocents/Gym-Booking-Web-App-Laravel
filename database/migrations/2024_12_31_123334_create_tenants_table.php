<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Artisan;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tenants', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('code');
            $table->string('database_name');
            $table->string('database_username');
            $table->string('database_password');
            $table->timestamps();
        });

         // Run the seeder after creating the table
        Artisan::call('db:seed', [
            '--class' => 'TenantSeeder', // Replace with your seeder class name
            '--database' => 'tenant' // Specify the tenant connection if needed
        ]);

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tenants');
    }
};
