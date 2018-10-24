<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;
use App\Traits\Attachable;


class IssueComment extends Model
{
    use Attachable;
    protected $table = "issues_comments";
    protected $guarded = [];
    public function attachment()
    {
        return $this->hasMany('\App\Models\Attachment', 'model_record_id');
    }
    public function date()
    {
        Carbon::setLocale('fa');
        return  Carbon::parse($this->created_at)->diffForHumans();
    }
    public function convertDate($date)
    {
        Carbon::setLocale('fa');
        return  Carbon::parse($date)->diffForHumans();
    }
    public function user()
    {
        return $this->belongsTo(\App\User::class);
    }
    public function issue()
    {
        return $this->belongsTo(\App\Issue::class);
    }
}
    
