<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attachment;
use Response;

class SystemDownloadController extends Controller
{
    //
    public function download($file)
    {
        $attachment = Attachment::find($file);
        $filename = $attachment->file;

        if($filename) {

            $downloadFIleName =$attachment->extension;
            $path = storage_path('app').'\attachments/'. $filename;
            return response()->download($path,$downloadFIleName);

        }
        return "فایل وجود ندارد";
    }
}
