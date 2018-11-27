<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Score extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    public function getTotalAttribute()
    {
        $total = $this->homework + $this->classwork + $this->midterm + $this->final;
        
        return $total > 0 ? $total : '';
    }
}
