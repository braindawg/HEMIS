<?php 

namespace App\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

trait UseByUniversity
{
    protected static function bootUseByUniversity()
    {
        static::addGlobalScope('university', function ($query) {

            if (!auth()->guest() and !auth()->user()->allUniversities()) {

                $query->where($query->getQuery()->from . '.university_id', auth()->user()->university_id);
   
            }

        });

        static::saving(function (Model $model) {
            if (!isset($model->university_id)) {
                $model->university_id = auth()->user()->university_id;
            }
        });
    }

    public function scopeAllUniversities($query)
    {
        return $query->withoutGlobalScope('university');
    }


    public function university()
    {
        return $this->belongsTo(\App\Models\University::class);
    }
}
