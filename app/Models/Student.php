<?php

namespace App\Models;

use App\Traits\Downloadble;
use App\Traits\UseByUniversity;
use App\Traits\UseByDepartment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Model
{
    use SoftDeletes, UseByUniversity, UseByDepartment, Downloadble;

    protected $guarded = [];
    protected $dates = ['deleted_at'];


    public function creator()
    {
        return $this->belongsTo(\App\User::class, 'created_by');
    }

    public function updater()
    {
        return $this->belongsTo(\App\User::class, 'updated_by');
    }
    
    public function department()
    {
        return $this->belongsTo(Department::class);
    }
    
    public function status()
    {
        return $this->belongsTo(StudentStatus::class);
    }

    public function relatives()
    {
        return $this->hasMany(Relative::class);
    }
    public function courses()
    {
        return $this->belongsToMany(Course::class,'course_student');
    }

    public function originalProvince()
    {
        return $this->belongsTo(Province::class, 'province');
    }

    public function currentProvince()
    {
        return $this->belongsTo(Province::class, 'province_current');
    }

    public function photo()
    {
        if (file_exists($this->photo_url)) {
            return asset($this->photo_url);
        } 

        return asset("img/avatar-placeholder.png");
    }

    public function getFullNameAttribute()
    {
        return $this->name." ".$this->last_name;
    }

    public function scores()
    {
        return $this->hasMany(Score::class);
    }

    public function group()
    {
        return $this->belongsTo(Group::class);
    }
}
