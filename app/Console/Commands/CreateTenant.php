<?php

namespace App\Console\Commands;

use App\Models\Tenant;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class CreateTenant extends Command
{
    protected $signature = 'tenant:create {name} {domain}';
    protected $description = 'Create a new tenant';

    public function handle()
    {
        $name = $this->argument('name');
        $domain = $this->argument('domain');
        $database = 'tenant_' . $domain;

        try {
            // Create the database with proper MySQL syntax
            DB::statement("CREATE DATABASE IF NOT EXISTS `$database`");

            // Create the tenant
            $tenant = Tenant::create([
                'name' => $name,
                'domain' => $domain,
                'database' => $database,
            ]);

            // Switch to the tenant and run migrations
            $tenant->makeCurrent();
            $this->call('migrate');

            $this->info("Tenant '{$name}' created successfully!");
        } catch (\Exception $e) {
            $this->error("Failed to create tenant: " . $e->getMessage());
        }
    }
} 