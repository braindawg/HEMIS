<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;
use App\Traits\Attachable;


class Issue extends Model
{
    use SoftDeletes,Attachable;
    protected $table = "issues";
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
    public function user()
    {
        return $this->belongsTo(\App\User::class);
    }
    public function issueComment(){
        return $this->hasMany(\App\Models\IssueComment::class);
    }
}
    
