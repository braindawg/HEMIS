<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Grade extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    public function students()
    {
        return $this->hasMany(Student::class);
    }
}
