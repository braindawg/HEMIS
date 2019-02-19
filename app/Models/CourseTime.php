<?php

namespace App\Models;
use Carbon\Carbon;

use Illuminate\Database\Eloquent\Model;

class CourseTime extends Model
{

    protected $guarded = []; 

    public function day()
    {
        return $this->belongsTo(Day::class);
    }

     public function course()
    {
        return $this->belongsTo(Course::class);
    }

    // public function time()
    // {   
    //     Carbon::setLocale('fa');
    //     return  Carbon::parse($this->time)->diffForHumans();
    // }
}
