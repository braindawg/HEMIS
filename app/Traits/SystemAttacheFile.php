<?php  
namespace App\Traits;

use Illuminate\Http\Response;
use App\Models\SystemFile;
use App\Traits\SystemAttacheFile;
use Illuminate\Support\Facades\Storage;

Trait SystemAttacheFile
{	
    protected $path = "storage/app/system_files";

    /**
    * upload a file
    *
    * @param  $file file
    * @return void
    */
    function uploadFile($file,$parrent_record_id, $Model_Name)
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
            SystemFile::create([
                'model_record_id' => $parrent_record_id,
                'model' => $Model_Name,
                'file' => $filename,
                'extension' => $extension,
            ]);
            if($i1==0){ Storage::put('system_files/'.$filename, \File::get($file));}        
        }
        return "";        
    }

    function deleteFile($file){
        if($file!=null)
            {
    //deleting related images in server
                $filename = $file->file;
                $imagexistanse=Storage::exists('\system_files\\' . $filename);
                    if($imagexistanse)
                        {
                            Storage::delete('\system_files\\' . $filename);
                        }
            }
        //deleting related childs records
        SystemFile::where('id',$file->id)->delete();
    }
}