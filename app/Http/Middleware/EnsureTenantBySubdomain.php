<?php

namespace App\Http\Middleware;

use App\Models\Tenant;
use Closure;
use Illuminate\Http\Request;

class EnsureTenantBySubdomain
{
    public function handle(Request $request, Closure $next)
    {
        $host = $request->getHost();
        $mainDomain = config('multitenancy.default_main_domain');
        
        // Extract subdomain
        $subdomain = str_replace('.' . $mainDomain, '', $host);
        
        // Find tenant by subdomain
        $tenant = Tenant::where('domain', $subdomain)->first();
        
        if (!$tenant) {
            abort(404, 'Tenant not found');
        }
        
        $tenant->makeCurrent();
        
        return $next($request);
    }
} 