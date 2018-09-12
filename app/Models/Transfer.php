<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transfer extends Model
{
    protected $guarded = [];

    public function fromDepartment()
    {
        return $this->belongsTo(\App\Models\Department::class, 'from_department_id');
    }

    public function student()
    {
        return $this->belongsTo(\App\Models\Student::class, 'student_id');
    }
}