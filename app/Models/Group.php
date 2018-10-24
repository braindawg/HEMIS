<?php

namespace App\Models;

use App\Traits\UseByUniversity;
use App\Traits\UseByDepartment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;

class Group extends Model
{
    use SoftDeletes, UseByUniversity, UseByDepartment;

    protected $guarded = [];

    public function students()
    {
        return $this->hasMany(\App\Models\Student::class)->orderBy('name');
    }
}
