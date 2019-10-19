<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\SoftDeletes;

class Score extends Model
{
    use SoftDeletes, LogsActivity;

    protected $guarded = [];
    protected static $logUnguarded = true;

    public static function boot()
    {
        parent::boot();

        static::saving(function ($model) {
            $model->total = $model->classwork + $model->homework + $model->midterm + $model->final;

            if ($model->chance_four != "" and $model->chance_four >= 55) {
                $model->passed = 1;
            } elseif ($model->chance_three != "" and $model->chance_three >= 55) {
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

    public function subject()
    {
        return $this->belongsTo(Subject::class, 'subject_id');
    }

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }
    
    public function getDescriptionForEvent(string $eventName): string
    {
        return trans("general.score_of_subject_for_student_was_action", [            
                'subject' => $this->subject->title,
                'student' => $this->student->code." ".$this->student->full_name,
                'action' => trans('general.'.$eventName)            
            ]);
    }

    public function validForChanceTwo()
    {
        return $this->total < 55;                    
    }
    
    public function validForChanceThree()
    {
        return $this->chance_two !== null  and $this->chance_two < 55 ;                    
    }
    
    public function validForChanceFour()
    {
        return $this->chance_three !== null and $this->chance_three < 55 ;                    
    }        
}
