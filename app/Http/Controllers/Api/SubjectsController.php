<?php

namespace App\Http\Controllers\Api;

use App\Models\Subject;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SubjectsController extends Controller
{
    public function __invoke(Request $request,$department = null)
    {        
        $subjects =  Subject::select('id', 'title as text');

        if ($department) {
            $subjects->where('department_id', $department->id);
        }
        if ($request->q != '') {
            $subjects->where('title', 'like', '%'.$request->q.'%');
        }
                
        return $subjects->take(5)->get();
    }
}
