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
    public function download($student, $fileName, $request, $model)
    {
        
        $pdf = PDF::loadView('pdf.students.downloads.'.$fileName, compact('student','request','model'), [], [            
            'title' => implode(explode('-', $fileName), ' ')
        ]);

        return $pdf->stream('document.pdf');
    }

}