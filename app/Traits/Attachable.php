<?php  
namespace App\Traits;

use Illuminate\Http\Response;
use App\Models\Attachment;
use App\Traits\Attachable;
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
        $i1=1;  
        if (!empty($file)) 
        {   
            $i1=0;
            $filepath = date("Y-m-d-h-i-sa").rand(1,1000).".".$file->getClientOriginalExtension();//generate unique name for Attachedfile
            $filename= $filepath;
            $original_file_name = $file->getClientOriginalName(); //get the original file name along with it's extension
            $extension = $original_file_name;

            Attachment::create([
                'model_record_id' => $parrentRecordId,
                'model' => $modelName,
                'file' => $filename,
                'extension' => $extension,
            ]);
            if($i1==0)
            {
                 Storage::put('attachments/'.$filename, \File::get($file));
            }        
        }
        return "";        
    }

    function deleteFile($file)
    {
        if($file!=null)
        {
    //deleting related images in server
            $filename = $file->file;
            $imagexistanse=Storage::exists('\attachments\\' . $filename);
                if($imagexistanse)
                    {
                        Storage::delete('\attachments\\' . $filename);
                    }
            }
        //deleting related childs records
        Attachment::where('id',$file->id)->delete();
    }

    //get Child rows by passing parrent record ID and model Name
    public function getFile($parrentId,$modelNname)
    {
        $data = Attachment::where('model_record_id',$parrentId)->where('model',$modelNname)->get();
        return $data;
    }
}