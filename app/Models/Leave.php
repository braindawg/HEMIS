<?php

namespace App\Models;

use App\Traits\UseByUniversity;
use App\Traits\Downloadble;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;

class Leave extends Model
{
    use SoftDeletes, UseByUniversity, Downloadble;
    protected $guarded = [];
    public function student()
    {
        return $this->belongsTo(\App\Models\Student::class, 'student_id');
    }

    public function approved (){
        
        return $this->approved = true;
    }
}
