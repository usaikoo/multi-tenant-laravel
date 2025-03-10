<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Multitenancy\Models\Concerns\UsesTenantConnection;

class YourModel extends Model
{
    use UsesTenantConnection;
    
    // ... rest of your model
} 