<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SystemFile;
use Response;

class SystemDownloadController extends Controller
{
    //
    public function download($filename,$recordID,$foldername){
            $record_id = $recordID;
            $data = SystemFile::find($recordID);
            $filename = $data->file;
            if($filename)
            {
            $downloadFIleName =$data->extension;
            $path = storage_path('app').'/'.$foldername.'/'.$filename;
            return response()->download($path,$downloadFIleName);
            }
        return "فایل وجود ندارد";
    }
}
