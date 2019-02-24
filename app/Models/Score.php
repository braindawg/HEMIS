<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Score extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    public static function boot()
    {
        parent::boot();

        static::saving(function ($model) {
            $model->total = $model->classwork + $model->homework + $model->midterm + $model->final;

            if ($model->chance_three != "" and $model->chance_three >= 55) {
                $model->passed = 1;
            } elseif ($model->chance_two != "" and $model->chance_two >= 55) {
                $model->passed = 1;
            } elseif ($model->total >= 55) {
                $model->passed = 1;
            } else {
                $model->passed = 0;
            }
            
        });
    }

    public function scopeCourseId($query, $courseId)
    {
        return $query->where('course_id', $courseId);
    }   
}
