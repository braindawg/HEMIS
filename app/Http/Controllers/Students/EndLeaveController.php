<?php

namespace App\Http\Controllers\students;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EndLeaveController extends Controller
{
    public function index($leave)
    {
        
        if( $leave->end_leave == false )
        {
            $leave->update([
                
                'end_leave' => true
            ]);

            $leave->student->update([
                'status_id' => 2
            ]);
        }

        return redirect(route('leaves.index'));
    }
}
