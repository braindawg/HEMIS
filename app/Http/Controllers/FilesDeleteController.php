<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Attachment;
use App\Models\Announcement;

class FilesDeleteController extends Controller
{
    //
    public function deleteFiles($filename,$recordID)
    {       
            $data = Attachment::find($recordID);
            if($data)
            {
            $filename = $data->file;
            Attachment::where('id',$recordID)->delete();
            if($filename != null)
            {
                $imagexistanse=Storage::exists('\attachments\\' . $filename);
                    if($imagexistanse)
                    {
                          Storage::delete('\attachments\\' . $filename);
                    }
            }
        }
        return redirect()->back();

    }
}
