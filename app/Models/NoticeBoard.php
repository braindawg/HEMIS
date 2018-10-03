<?php

namespace App\Models;

use App\Traits\UseByUniversity;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\SystemAttacheFile;


class NoticeBoard extends Model
{
    use SoftDeletes,SystemAttacheFile;
    protected $guarded = [];
    public function systemfile()
    {
        return $this->hasMany('\App\Models\SystemFile', 'model_record_id');
    }
}
    
