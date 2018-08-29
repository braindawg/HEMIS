<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class University extends Model
{
    use SoftDeletes;

    protected $guarded = [];
    protected $dates = ['deleted_at'];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {                                   
        });
        
        static::updating(function ($model) {                                   
        });
    }

    public function departments()
    {
        return $this->hasMany(\App\Models\Department::class);
    }
}