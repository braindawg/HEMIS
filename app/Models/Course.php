<?php

namespace App\Models;

use App\Traits\UseByUniversity;
use App\Traits\UseByDepartment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Course extends Model
{
    use SoftDeletes, UseByUniversity, UseByDepartment;

    protected $guarded = [];
    protected $dates = ['deleted_at'];

    public function department()
    {
        return $this->belongsTo(\App\Models\Department::class);
    }

    public function subject()
    {
        return $this->belongsTo(\App\Models\Subject::class);
    }

    public function teacher()
    {
        return $this->belongsTo(\App\Models\Teacher::class);
    }

    public function group()
    {
        return $this->belongsTo(\App\Models\Group::class);
    }

    public function students()
    {
        return $this->belongsToMany(\App\Models\Student::class)->orderBy('name');
    }

    public function getGradeAttribute()
    {
        if ($this->semester) {
            return ceil($this->semester/2);
        }
    }

    public function getHalfYearTextAttribute()
    {
        return trans('general.'.$this->half_year);
    }

}
