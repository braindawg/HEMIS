<?php

namespace App\Models;

use Spatie\Permission\Models\Role as BaseRole;

class Role extends BaseRole
{
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('admin', function ($builder) {
            
            if (!auth()->user()->allUniversities()) {
                
                $builder->where('admin', 0);
            }

        });
    }
}
