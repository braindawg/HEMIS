<?php

namespace App\Http\Controllers\Students;

use App\Models\Leave;
use App\Models\Student;
use Illuminate\Http\Request;
use App\DataTables\LeavesDataTable;
use App\Http\Controllers\Controller;

class LeavesController extends Controller
{
    public function __construct()
    {        
        $this->middleware('permission:view-leave', ['only' => ['index', 'show']]);        
        $this->middleware('permission:create-leave', ['only' => ['create','store']]);
        $this->middleware('permission:delete-leave', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(LeavesDataTable $dataTable)
    {        
        return $dataTable->render('leaves.index', [
            'title' => trans('general.leaves'),
            'description' => trans('general.leaves_list')
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('leaves.create', [
            'title' => trans('general.leaves'),
            'description' => trans('general.new_leaves'),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([            
            'student_id' => 'required',
            'leave_year' => 'required',
        ]);

        \DB::transaction(function () use ($request){
            
            $student = Student::find($request->student_id);
            
            $leave = Leave::create([
                'student_id' => $request->student_id,
                'leave_year' => $request->leave_year,
                'semister' => $request->semister,
                'note' => $request->note,
                'university_id' => $student->university_id
            ]);

            //will update after admin approve
            // $student->update([
            //     'status_id' => 4,
            // ]);
            $leave->download($student , 'درخواست-تاجیلی', $request);

            
        });

        return redirect(route('leaves.index'));
    }

   public function edit($leave)
   {

        if( $leave->approved == false )
        {
            $leave->update([
                'approved' => true
            ]);
        }

        return redirect(route('leaves.index'));

   }
   public function update()
   {
   }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($leave)
    {
        \DB::transaction(function () use ($leave){
            
            $leave->student->update([
                'status_id' => 1
            ]);

            $leave->delete();

        });

        return redirect(route('leaves.index'));
    }
}