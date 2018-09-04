<?php

namespace App\Models;

use App\Traits\University;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Model
{
    use SoftDeletes;

    protected $guarded = [];
    protected $dates = ['deleted_at'];

    protected static function boot()
    {
        parent::boot();         

        static::addGlobalScope('department', function (Builder $builder) {           
            if (! auth()->user()->allUniversities()) {
                $builder->where('students.university_id', auth()->user()->university_id);                
            }
        });
    }

    public function creator()
    {
        return $this->belongsTo(\App\User::class, 'created_by');
    }

    public function updater()
    {
        return $this->belongsTo(\App\User::class, 'updated_by');
    }

    public function university()
    {
        return $this->belongsTo(\App\Models\University::class);
    }
    
    public function department()
    {
        return $this->belongsTo(\App\Models\Department::class);
    }
    
    public function status()
    {
        return $this->belongsTo(\App\Models\StudentStatus::class);
    }

    public function relatives()
    {
        return $this->hasMany(\App\Models\Relative::class);
    }

    public function currentProvince()
    {
        return $this->belongsTo(\App\Models\Province::class, 'province_current');
    }
}
