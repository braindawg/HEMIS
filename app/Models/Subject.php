<?php

namespace App\Models;

use App\Traits\UseByUniversity;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;

class Subject extends Model
{
    use SoftDeletes, useByUniversity;

    protected $guarded = [];
    protected $dates = ['deleted_at'];

    protected static function boot()
    {
        parent::boot();         

    }

    public function department()
    {
        return $this->belongsTo(\App\Models\Department::class);
    }
}
