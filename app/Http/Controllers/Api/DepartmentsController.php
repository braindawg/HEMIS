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
        
       $departments =  Department::select('id', 'name as text')
        ->where('university_id', $universityId);

        if ($request->q != '') {
            $departments->where('code', 'like', '%'.$request->q.'%')
                ->orWhere('code', 'like', '%'.$request->q.'%');
        }
                
        return $departments->get();
    }
}
