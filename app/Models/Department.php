<?php

namespace App\Models;

use App\Traits\UseByUniversity;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;

class Department extends Model
{
    use SoftDeletes, UseByUniversity;

    protected $guarded = [];
    protected $dates = ['deleted_at'];

    public function users()
    {
        return $this->belongsToMany(\App\User::class)->withTimestamps();
    }

    public function students()
    {
        return $this->hasMany(\App\Models\Student::class);
    }

    public function studentsByStatus()
    {
        return $this->students()->select('department_id', 'status_id', \DB::raw('COUNT(students.id) as students_count'))->groupBy('department_id', 'status_id');
    }
}
