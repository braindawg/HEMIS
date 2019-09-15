<?php 

namespace App\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

trait UseByDepartment
{
    protected static function bootUseByDepartment()
    {
        static::addGlobalScope('department', function ($query) {

            //if user assigned to departments filter else not filter
            if (!auth()->guest() and !auth()->user()->allUniversities() and auth()->user()->departments->count()) {
                
                $query->whereIn($query->getQuery()->from . '.department_id',  auth()->user()->departments->pluck('id'))->orWhereNull($query->getQuery()->from . '.department_id');
   
            }

        });

    }

    public function scopeAllDepartments($query)
    {
        return $query->withoutGlobalScope('department');
    }


    public function department()
    {
        return $this->belongsTo(\App\Models\Department::class);
    }
}
