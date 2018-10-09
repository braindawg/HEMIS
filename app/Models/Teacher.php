<?php

namespace App\Models;

use App\Traits\UseByUniversity;
use App\Traits\UseByDepartment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;

class Teacher extends Model
{
    use SoftDeletes, UseByUniversity, UseByDepartment;

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


    public function province()
    {
        return $this->belongsTo(\App\Models\Province::class, 'province');
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
}
