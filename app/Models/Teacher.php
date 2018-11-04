<?php

namespace App\Models;

use App\Traits\UseByUniversity;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;

class Teacher extends Model
{
    use SoftDeletes, UseByUniversity;

    protected $guarded = [];
    protected $dates = ['deleted_at'];

    public function teacherAcademic()
    {
        return $this->belongsTo(\App\Models\TeacherAcademicRank::class, 'academic_rank_id');
    }

    public function province()
    {
        return $this->belongsTo(\App\Models\Province::class, 'province');
    }
    
    public function getFullNameAttribute()
    {
        return $this->name." ".$this->last_name;
    }
}
