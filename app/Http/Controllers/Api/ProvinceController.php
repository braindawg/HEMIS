<?php

namespace App\Http\Controllers\Api;

use App\Models\Province;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProvinceController extends Controller
{
    public function __invoke(Request $request)
    {
        $provinces =  Province::select('id', 'name as text');

        if ($request->q != '') {
            $provinces->where('name', 'like', '%'.$request->q.'%')
                ->take(5);
        }
                
        return $provinces->get();
    }
}
