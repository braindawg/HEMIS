<?php

namespace App\Http\Controllers\Api;

use App\Models\Group;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GroupsController extends Controller
{
    public function __invoke(Request $request,$department = null)
    {        
        $groups =  Group::select('id', 'name as text');

        /* if ($department) {
            $groups->where('department_id', $department->id);
        } */
        if ($request->q != '') {
            $groups->where('name', 'like', '%'.$request->q.'%');
        }
                
        return $groups->take(5)->get();
    }
}
