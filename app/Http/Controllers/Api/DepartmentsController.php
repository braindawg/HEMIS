<?php

namespace App\Http\Controllers\Api;

use App\Models\Department;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DepartmentsController extends Controller
{
    public function __invoke(Request $request, $university = null)
    {
        $departments =  Department::select('id', 'name as text');
        
        if ($university) {            
            $departments->allUniversities()                
                ->where('university_id', $university->id);
        }
        
        if ($request->q != '') {
            $departments->where('name', 'like', '%'.$request->q.'%');
        }
                
        return $departments->get();
    }
}
