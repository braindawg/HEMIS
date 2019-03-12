<?php 

namespace App\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

trait UseByGrade
{
    protected static function bootUseByGrade()
    {
        static::addGlobalScope('grade', function ($query) {

            //if user assigned to grades filter else not filter
            if (!auth()->guest() and auth()->user()->grades->count()) {
                
                $query->whereIn($query->getQuery()->from . '.grade_id',  auth()->user()->grades->pluck('id'));
   
            }

        });

    }

    public function scopeAllGradess($query)
    {
        return $query->withoutGlobalScope('grade');
    }


    public function grade()
    {
        return $this->belongsTo(\App\Models\Grade::class);
    }
}
