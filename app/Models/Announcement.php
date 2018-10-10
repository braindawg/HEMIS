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
    public function excerpt($limit = 260, $post_fix = ' ...')
    {
        $this->dom->loadHtml(mb_convert_encoding($this->body, 'HTML-ENTITIES', 'UTF-8'));
        return str_limit($this->dom->textContent, $limit, $post_fix);
    }
    public function noticeboardView()
    {
        return $this->hasMany(\App\Models\NoticeboardView::class);
    }
    //check whether the current user seen the announcement
    public function userView($announcement_id,$user_id)
    {
       $checkuser = NoticeboardView::where('user_id',$user_id)->where('announcement_id',$announcement_id)->get();
       if($checkuser->count()>0 ){
           return 1;
       }
       else {
           return 0;
       }
    }
}
    
