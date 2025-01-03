<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Models\Tenant;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;
use App\Models\User;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Artisan;



class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    // public function store(LoginRequest $request): RedirectResponse
    public function store(Request $request)

    {
        
        $tenant_code = $request->input('code'); 
        $tenant = Tenant::where('code', $tenant_code)->first();
        
        if($tenant && $tenant->code == $request->input('code') && $tenant->database_password == $request->input('database_password')) {

             // Set database connection dynamically
             $tenantConnection = [
                'driver' => 'mysql',
                'host' => env('DB_HOST', '127.0.0.1'),
                'port' => env('DB_PORT', '3306'),
                'database' => $tenant->database_name,
                'username' => $tenant->database_username,
                'password' => $tenant->database_password,
                'charset' => 'utf8mb4',
                'collation' => 'utf8mb4_unicode_ci',
            ];

            Config::set('database.connections.tenant', $tenantConnection);

            DB::purge('tenant'); // Reset the tenant connection
            DB::setDefaultConnection('tenant'); // Set the tenant connection as default
            DB::reconnect('tenant'); // Reconnect to the tenant database

            $current_database = DB::connection('tenant')->getDatabaseName();
            $users = DB::connection('tenant')->table('users')->get();
            // dd('Current Database:', $current_database, 'Users:', $users);
            \Session::put('tenant', $tenant);
            \Session::put('tenant_connection', $tenantConnection);

           

            return redirect()->route('landing');
        } else {
            dd('Tenant not found or credentials mismatch.');
        }


    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
