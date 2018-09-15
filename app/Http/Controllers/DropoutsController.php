<?php

namespace App\Http\Controllers;

use App\Models\Dropouts;
use App\Models\Student;
use App\Models\Transfer;
use App\Models\University;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Maklad\Permission\Models\Role;
use App\DataTables\DropoutsDataTable;
use Maklad\Permission\Models\Permission;

class DropoutsController extends Controller
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
    public function index(DropoutsDataTable $dataTable)
    {        
        return $dataTable->render('dropouts.index', [
            'title' => trans('general.dropouts'),
            'description' => trans('general.dropouts_list')
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dropouts.create', [
            'title' => trans('general.dropouts'),
            'description' => trans('general.new_dropouts'),
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
        ]);

        \DB::transaction(function () use ($request){
            $student = Student::find($request->student_id);
            
            $dropouts = Dropouts::create([
                'student_id' => $request->student_id,
                'dropouts_date' => '2018-09-12',
                'note' => $request->note
            ]);

            $student->update([
                'status_id' => 3,
            ]);
        });

        return redirect(route('dropouts.index'));
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($dropout)
    {

        \DB::transaction(function () use ($dropout){
            $dropout->student->update([
                'status_id' => 1
            ]);
            $dropout->delete();
        });

        return redirect(route('dropouts.index'));
    }
}