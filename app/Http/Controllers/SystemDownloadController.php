<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attachment;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Str;

class SystemDownloadController extends Controller
{
    //
    public function download($file , array $headers = array())
    {
        $attachment = Attachment::find($file);
        $filename = $attachment->file;

        if($filename) {

            $filename = Str::ascii(basename($filename));
            $downloadFIleName = $attachment->extension;
            $path = storage_path('app').'/attachments/'. $filename;

            return response()->download($path, $downloadFIleName , $headers);


        }
        return "فایل وجود ندارد";
    }
}
