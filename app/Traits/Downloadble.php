<?php  
namespace App\Traits;

use Illuminate\Http\Response;
use App\Models\Attachment;
use Illuminate\Support\Facades\Storage;
use PDF;

Trait Downloadble
{	

    /**
    * upload a file
    *
    * @param  $file file
    * @return void
    */
    public function download($student, $fileName, $request)
    {
    //  dd($fileName);   
        $pdf = PDF::loadView('pdf.students.downloads.'.$fileName, compact('student','request'), [], [            
            'title' => implode(explode('-', $fileName), ' ')
        ]);

        return $pdf->stream('document.pdf');
    }

}