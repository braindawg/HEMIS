<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;

class Dropouts extends Model
{
    //
    protected $guarded = [];

    public function student()
    {
        return $this->belongsTo(\App\Models\Student::class, 'student_id');
    }
}
