<?php

namespace App\Http\Controllers\Api;

use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;

class DepartmentsController extends Controller
{
    public function index(Request $request, $universityId)
    {
        
       $departments =  Department::select('id', 'name as text');

        if ($request->q != '') {
            $departments->where('name', 'like', '%'.$request->q.'%')
                ->where('university_id', $universityId);
        }
                
        return $departments->get();
    }
}
