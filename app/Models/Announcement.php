<?php

namespace App\Models;

use Carbon\Carbon;
use App\Traits\Attachable;
use App\Models\NoticeboardView;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;

class Announcement extends Model
{
    use SoftDeletes,Attachable;

    protected $table = "announcements";
    protected $guarded = [];
	private $dom;

    function __construct(array $attributes = array())
    {
        parent::__construct($attributes);

    	$this->dom = new \DomDocument('1.0', 'UTF-8');
    	libxml_use_internal_errors(true); //turn off invalid html warning, it is a common problem
    }

    public function attachment()
    {
        return $this->hasMany('\App\Models\Attachment', 'model_record_id');
    }

    public function date()
    {
        Carbon::setLocale('fa');
        return  Carbon::parse($this->created_at)->diffForHumans();
    }

    public function visits()
    {
        return $this->hasMany(NoticeboardVisit::class, 'announcement_id');
    }

    public function visited()
    {           
        return auth()->user()->noticeboardVisits()->where('announcement_id', $this->id)->exists();
    }

    public function visit()
    {
        return auth()->user()->noticeboardVisits()->create(['announcement_id' => $this->id]);
    }

    public function excerpt($limit = 260, $post_fix = ' ...')
    {    	
        $this->dom->loadHtml(mb_convert_encoding($this->body, 'HTML-ENTITIES', 'UTF-8'));

    	return str_limit($this->dom->textContent, $limit, $post_fix);
    }

    public function href()
    {
        if (auth('user')->check()) {
            return route('announcements.show', $this->id);
        }

        if (auth('teacher')->check()) {
            return route('teacher.noticeboard.show', $this->id);
        }
    }
}
    
