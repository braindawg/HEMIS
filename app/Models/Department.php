<?php

namespace App\Models;

use App\Traits\UseByUniversity;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;

class Department extends Model
{
    use SoftDeletes, UseByUniversity;

    protected $guarded = [];
    protected $dates = ['deleted_at'];

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('department', function ( $query) {
            //if user assigned to departments filter else not filter
            if (!auth()->guest() and !auth()->user()->allUniversities() and auth()->user()->departments->count()) {
                
                $query->whereIn($query->getQuery()->from . '.id',  auth()->user()->departments->pluck('id'));
   
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

    public function subjects()
    {
        return $this->hasMany(\App\Models\Subject::class);
    }

    public function courses()
    {
        return $this->hasMany(\App\Models\Course::class);
    }

    public function studentsByStatus()
    {
        return $this->students()->select('department_id', 'status_id', \DB::raw('COUNT(students.id) as students_count'))->groupBy('department_id', 'status_id');
    }
}
