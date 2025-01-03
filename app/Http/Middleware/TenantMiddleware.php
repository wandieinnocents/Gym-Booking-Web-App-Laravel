<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Config;


class TenantMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        //set the current tenant connection
        if (Session::has('tenant_connection')) {
            Config::set('database.connections.tenant', Session::get('tenant_connection'));
            DB::purge('tenant'); // Reset the tenant connection
            DB::reconnect('tenant'); // Reconnect to the tenant database
            DB::setDefaultConnection('tenant'); //set current tenant connection as default
        }

        return $next($request);
    }
}
