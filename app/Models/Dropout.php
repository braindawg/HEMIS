<?php

namespace App\Models;

use App\Traits\UseByUniversity;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;

class Dropout extends Model
{
    use SoftDeletes, UseByUniversity;

    protected $guarded = [];

    public function student()
    {
        return $this->belongsTo(\App\Models\Student::class, 'student_id');
    }
}
