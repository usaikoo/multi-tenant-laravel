<?php

use App\Models\Tenant;
use Spatie\Multitenancy\Actions\MakeQueueTenantAwareAction;
use Spatie\Multitenancy\Actions\MigrateTenantAction;

return [
    'tenant_model' => Tenant::class,

    'default_main_domain' => env('APP_URL', 'http://localhost'),

    'switch_tenant_tasks' => [
        \Spatie\Multitenancy\Tasks\SwitchTenantDatabaseTask::class,
        \Spatie\Multitenancy\Tasks\PrefixCacheTask::class,
    ],

    'tenant_database_connection_name' => 'tenant',

    'tenant_finder' => null,
]; 