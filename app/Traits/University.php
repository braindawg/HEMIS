<?php 

namespace App\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

trait University
{
    /**
     * Boot the global scope
     */
    protected static function bootUniversity()
    {
        static::addGlobalScope('university', function ($query) {
            if (!auth()->guest() and auth()->user()->university_id != '') {
                $query->where($query->getQuery()->from . '.university_id', auth()->user()->university_id);
            }
        });

        // static::saving(function (Model $model) {
        //     static::universityGuard();

        //     if (!isset($model->university_id)) {
        //         $model->university_id = auth()->user()->university_id;
        //     }
        // });
    }

    /**
     * @param Builder $query
     * @return mixed
     */
    public function scopeAllUniversities($query)
    {
        return $query->withoutGlobalScope('university');
    }

    /**
     * @return mixed
     */
    public function university()
    {
        return $this->belongsTo(\App\Models\University::class);
    }
}
