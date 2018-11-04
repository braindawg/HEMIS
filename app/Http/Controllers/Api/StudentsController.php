<?php

namespace App\Http\Controllers\Api;

use App\Models\Student;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StudentsController extends Controller
{
    public function __invoke(Request $request)
    {
       $students =  Student::select('id', \DB::raw('CONCAT(form_no, " ", name, " ", last_name) as text'));

        if ($request->q != '') {
            $students->where('form_no', 'like', '%'.$request->q.'%')
                ->orWhere('name', 'like', '%'.$request->q.'%')
                ->orWhere('father_name', 'like', '%'.$request->q.'%')
                ->take(5);
        }
                
        return $students->get();
    }
}
