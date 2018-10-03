<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\SystemAttacheFile;

class SystemFile extends Model
{
    use SystemAttacheFile;
    protected $table ='system_files';
    protected $fillable =[
        'model_record_id',
        'model',
        'file',
        'extension'
          ];
public function noticeboard()
    {
        return $this->belongsTo(\App\Models\NoticeBoard::class);
    }
}
