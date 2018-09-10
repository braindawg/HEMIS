<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;

class Department extends Model
{
    use SoftDeletes;

    protected $guarded = [];
    protected $dates = ['deleted_at'];

    protected static function boot()
    {
        parent::boot();         

        static::addGlobalScope('department', function (Builder $builder) {           
            if (! auth()->user()->allUniversities()) {
                $builder->where('departments.university_id', auth()->user()->university_id);                
            }
        });
    }

    public function users()
    {
        return $this->belongsToMany(\App\User::class)->withTimestamps();
    }

    public function students()
    {
        return $this->hasMany(\App\Models\Student::class);
    }

    public function studentsByStatus()
    {
        return $this->students()->select('department_id', 'status_id', \DB::raw('COUNT(students.id) as students_count'))->groupBy('department_id', 'status_id');
    }

}
