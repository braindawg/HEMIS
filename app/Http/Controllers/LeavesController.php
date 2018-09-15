<?php

namespace App\Http\Controllers;

use App\Models\Leave;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Maklad\Permission\Models\Role;
use App\DataTables\LeavesDataTable;
use Maklad\Permission\Models\Permission;

class LeavesController extends Controller
{
    public function __construct()
    {        
        //  $this->middleware('permission:view-transfer', ['only' => ['index', 'show']]);        
        //  $this->middleware('permission:create-transfer', ['only' => ['create','store']]);
        //  $this->middleware('permission:edit-transfer', ['only' => ['edit','update', 'updateStatus']]);
        //  $this->middleware('permission:delete-transfer', ['only' => ['destroy']]);
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
            'students' => Student::pluck('name', 'id')
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
            
            $leaves = Leave::create([
                'student_id' => $request->student_id,
                'leave_year' => $request->leave_year,
                'note' => $request->note
            ]);

            $student->update([
                'status_id' => 4,
            ]);
        });

        return redirect(route('leaves.index'));
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