<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TeacherAcademicRank extends Model
{
    //
    protected $table = "teacher_academic_ranks";

    public function teachers()
    {
        return $this->hasMany(\App\Models\Teacher::class);
    }
}