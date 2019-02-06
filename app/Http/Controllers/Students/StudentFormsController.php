<?php

namespace App\Http\Controllers\students;

use App\Models\Student;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;


class StudentFormsController extends Controller
{
    
    public function index ( $student){

        $files = [];

        if (file_exists( resource_path ("views/pdf/students/downloads") )) {
            $files = File::allFiles( resource_path ("views/pdf/students/downloads"));
        }

    	return view('students.student-forms', compact('student', 'files'));
    }

    public function generateForm(Request $request , $student){
        
        $student->download($student , $request->file , $request);
    }
}
