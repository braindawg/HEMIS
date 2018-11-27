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
        return $this->belongsTo(Department::class);
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }

    public function group()
    {
        return $this->belongsTo(Group::class);
    }

    public function students()
    {
        return $this->belongsToMany(Student::class)->orderBy('name');
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

    public function scores()
    {
        return $this->hasMany(Score::class);
    }
}
