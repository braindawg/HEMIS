<?php

namespace App\Http\Controllers\Api;

use App\Models\Subject;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SubjectsController extends Controller
{
    public function __invoke(Request $request)
    {        
        $subjects =  Subject::select('id', 'name as text');
        
        if ($request->q != '') {
            $subjects->where('name', 'like', '%'.$request->q.'%');
        }
                
        return $subjects->get();
    }
}
