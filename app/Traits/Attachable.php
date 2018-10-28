<?php  
namespace App\Traits;

use Illuminate\Http\Response;
use App\Models\Attachment;
use Illuminate\Support\Facades\Storage;

Trait Attachable
{	
    protected $path = "storage/app/attachments";

    /**
    * upload a file
    *
    * @param  $file file
    * @return void
    */
    function uploadFile($file,$parrentRecordId, $modelName)
    {        
        $filename=null;
        $filepath =null; 
        $i=1;

        if (!empty($file)) 
        {

            $i=0;
            $filepath = date("Y-m-d-h-i-sa").rand(1,1000).".".$file->getClientOriginalExtension();
            $filename= $filepath;
            $original_file_name = $file->getClientOriginalName();
            $extension = $original_file_name;

            Attachment::create([
                'model_record_id' => $parrentRecordId,
                'model' => $modelName,
                'file' => $filename,
                'extension' => $extension,
            ]);

            if($i==0) {
                 Storage::put('attachments/'.$filename, \File::get($file));
            }        
        }
        return "";        
    }

    function deleteFile($file)
    {
        if($file != null)
        {
            $filename = $file->file;

            $imagexistanse=Storage::exists('\attachments\\' . $filename);

                if($imagexistanse) {
                        Storage::delete('\attachments\\' . $filename);
                    }
            }

        Attachment::where('id',$file->id)->delete();
    }

    public function getFile($parrentId,$modelNname)
    {
        $data = Attachment::where('model_record_id',$parrentId)->where('model',$modelNname)->get();
        return $data;
    }
}