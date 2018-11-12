<?php

namespace App\Http\Controllers\Api;

use App\Models\Teacher;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TeachersController extends Controller
{
    public function __invoke(Request $request,$university = null)
    {

        $teachers =  Teacher::select('id', 'name as text');

        if ($university) {
            $teachers->where('university_id', $university->id);
        }
        if ($request->q != '') {
            $teachers->where('name', 'like', '%'.$request->q.'%');
        }

        return $teachers->take(5)->get();
    }
}
