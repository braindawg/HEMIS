<?php

namespace App\Models;
use App\Models\NoticeboardView;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;
use App\Traits\Attachable;


class Announcement extends Model
{
    use SoftDeletes,Attachable;
    protected $table = "announcements";
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

    public function noticeboardView()
    {
        return $this->hasMany(\App\Models\NoticeboardView::class);
    }

    public function userView($announcement_id,$user_id)
    {
       $checkuser = NoticeboardView::where('user_id',$user_id)->where('announcement_id',$announcement_id)->get();

           if($checkuser ){
               return 1;
           } else {
               return 0;
           }
    }
}
    
