<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class NoticeboardVisit extends Model
{
    protected $table ='noticeboard_visits';
    
    protected $guarded =[];

    public function announcement()
    {
        return $this->belongsTo(\App\Models\Announcement::class);
    }

    public function visitable()
    {
        return $this->morphTo();
    }

    public function user()
    {
        return $this->visitable();
    }

    public function date()
    {
        Carbon::setLocale('fa');
        return  Carbon::parse($this->created_at)->diffForHumans();
    }
}
