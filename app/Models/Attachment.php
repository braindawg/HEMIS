<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Attachable;

class Attachment extends Model
{
    use Attachable;
    protected $table ='attachments';
    protected $fillable =[
        'model_record_id',
        'model',
        'file',
        'extension'
          ];
public function announcement()
    {
        return $this->belongsTo(\App\Models\Announcement::class);
    }
}
