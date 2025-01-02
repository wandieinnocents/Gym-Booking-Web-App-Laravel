<p>Welcome page </p>



{{-- @dd(session()->all()) --}}





@if(session('tenant'))
    <p>Tenant name: {{ session('tenant')->name  ?? ''}}</p>
    <p>Tenant DB name: {{ session('tenant')->database_name ?? '' }}</p>
    <p>Tenant DB user: {{ session('tenant')->database_username  ?? ''}}</p>

    

    {{-- @dd($data) --}}

    @php
    // Set the tenant database connection
    // Config::set('database.connections.tenant', session('tenant_connection'));
    // DB::purge('tenant'); // Reset the tenant connection
    // DB::reconnect('tenant'); // Reconnect to the tenant database
    // DB::setDefaultConnection('tenant');

    // Retrieve users from the tenant database
    // $users = \App\Models\User::all()->toArray();
    // $current_database = DB::connection()->getDatabaseName();
    // dd($current_database, $users);
@endphp
    
@endif



