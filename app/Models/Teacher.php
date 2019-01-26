<?php

namespace App\Models;

use App\Traits\UseByUniversity;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Teacher extends Authenticatable
{
    use SoftDeletes, Notifiable, UseByUniversity;

    protected $guarded = [];
    protected $dates = ['deleted_at'];


    public function setPasswordAttribute($value)
    {           
        if ($value != '') {
            $this->attributes['password'] = Hash::make($value);
        }        
    }

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

    public function courses()
    {
        return $this->hasMany(\App\Models\Course::class);
    }
    public function department(){
        
        return $this->belongsTo(\App\Models\Department::class);
    }
}
