<?php

namespace App\Models;

use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Traits\HasRoles;
use App\Traits\UseByUniversity;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Lab404\Impersonate\Models\Impersonate;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\Teacher as Authenticatable;

class Teacher extends Authenticatable
{
    use SoftDeletes, UseByUniversity, Notifiable, SoftDeletes, HasRoles, Impersonate;


    protected $guarded = [];
    protected $dates = ['deleted_at'];
    
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function teacherAcademic()
    {
        return $this->belongsTo(\App\Models\TeacherAcademicRank::class, 'academic_rank_id');
    }

    public function province()
    {
        return $this->belongsTo(\App\Models\Province::class, 'province');
    }

    public function setPasswordAttribute($value)
    {           
        if ($value != '') {
            $this->attributes['password'] = Hash::make($value);
        }        
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
        
        return $this->belongsTo(\App\Models\department::class);
    }
}
