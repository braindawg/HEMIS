<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\SystemFile;
use App\Models\NoticeBoard;

class FilesDeleteController extends Controller
{
    //
    public function deleteFiles($filename,$recordID)
    {       
            $data = SystemFile::find($recordID);
            if($data)
            {
            $filename = $data->file;
            SystemFile::where('id',$recordID)->delete();
            if($filename != null)
            {
                $imagexistanse=Storage::exists('\system_files\\' . $filename);
                    if($imagexistanse)
                    {
                          Storage::delete('\system_files\\' . $filename);
                    }
            }
        }
        return redirect()->back();

    }
}
