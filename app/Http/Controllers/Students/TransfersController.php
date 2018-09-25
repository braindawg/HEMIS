<?php

namespace App\Http\Controllers\Students;

use App\Models\Student;
use App\Models\Transfer;
use App\Models\University;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Maklad\Permission\Models\Role;
use App\Http\Controllers\Controller;
use App\DataTables\TransfersDataTable;
use Maklad\Permission\Models\Permission;

class TransfersController extends Controller
{
    public function __construct()
    {        
          $this->middleware('permission:view-transfer', ['only' => ['index', 'show']]);        
          $this->middleware('permission:create-transfer', ['only' => ['create','store']]);
          $this->middleware('permission:delete-transfer', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(TransfersDataTable $dataTable)
    {        
        return $dataTable->render('transfers.index', [
            'title' => trans('general.transfers'),
            'description' => trans('general.transfers_list')            
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('transfers.create', [
            'title' => trans('general.transfers'),
            'description' => trans('general.new_transfer'),
            'universities' => University::pluck('name', 'id')
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
            'university_id' => 'required',
            'department_id' => 'required'
        ]);

        \DB::transaction(function () use ($request){
            $student = Student::find($request->student_id);
            
            $transfer = Transfer::create([
                'student_id' => $request->student_id,
                'from_department_id' => $student->department_id, //from studetn existing department
                'to_department_id' => $request->department_id, //to requested department  
                'note' => $request->note
            ]);

            $student->update([
                'university_id' => $request->university_id,
                'department_id' => $request->department_id
            ]);
        });

        return redirect(route('transfers.index'));
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($transfer)
    {
        \DB::transaction(function () use ($transfer){
            $transfer->student->update([
                'university_id' => $transfer->fromDepartment->university_id,
                'department_id' => $transfer->from_department_id
            ]);
            $transfer->delete();
        });

        return redirect(route('transfers.index'));
    }
}