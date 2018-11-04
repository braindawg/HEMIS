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
    function uploadFile($file)
    {        
        if (!empty($file)) {

            $filepath = date("Y-m-d-h-i-sa").rand(1,1000).".".$file->getClientOriginalExtension();
            $filename = $filepath;
            $originalFileName = $file->getClientOriginalName();
            $extension = $originalFileName;

            $this->attachments()->create([
                'file' => $filename,
                'extension' => $extension,
            ]);

            Storage::put('attachments/'.$filename, \File::get($file));
                   
        }     
    }

    function deleteFile($file)
    {
        if($file) {
            $filename = $file->file;

            $imagexistanse = Storage::exists('\attachments\\' . $filename);

            if($imagexistanse) {
                Storage::delete('\attachments\\' . $filename);
            }
        }

        Attachment::where('id',$file->id)->delete();
    }

    public function attachments()
    {
        return $this->morphMany(\App\Models\Attachment::class, 'attachable');
    }

}