<?php

namespace App\Http\Controllers\Api;

use App\Models\Teacher;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TeachersController extends Controller
{
    public function __invoke(Request $request)
    {        
        $teachers =  Teacher::select('id', DB::raw('CONCAT(name," ",last_name) as text'));
           
        if ($request->q != '') {
            $teachers->where('name', 'like', '%'.$request->q.'%')
                ->where('last_name', 'like', '%'.$request->q.'%');
        }
                
        return $teachers->get();
    }
}
