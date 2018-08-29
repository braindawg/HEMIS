<?php

namespace App\Http\Controllers;

use App\Models\University;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Maklad\Permission\Models\Role;
use Maklad\Permission\Models\Permission;
use App\DataTables\UniversitiesDataTable;

class UniversitiesController extends Controller
{

    public function __construct()
    {        
         $this->middleware('permission:view-university', ['only' => ['index', 'show']]);        
         $this->middleware('permission:create-university', ['only' => ['create','store']]);
         $this->middleware('permission:edit-university', ['only' => ['edit','update']]);
         $this->middleware('permission:delete-university', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(UniversitiesDataTable $dataTable)
    {        
        return $dataTable->render('universities.index', [
            'title' => trans('general.universities'),
            'description' => trans('general.universities_list'),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('universities.create', [
            'title' => trans('general.universities'),
            'description' => trans('general.create_university'),
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
            'code' => [
                'required', 
                Rule::unique('universities')->whereNull('deleted_at')
            ],
            'name' => 'required',
            'domain' => 'required'            
        ]);
        
        $university = University::create($validatedData);

        return redirect(route('universities.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($university)
    {
        exit();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($university)
    {
        return view('universities.edit', [
            'title' => trans('general.universities'),
            'description' => trans('general.edit_university'),
            'university' => $university
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $university)
    {
        $validatedData = $request->validate([
            'code' => [
                'required', 
                Rule::unique('universities')->ignore($university->id, 'id')->whereNull('deleted_at')
            ],
            'name' => 'required'                                   
        ]);
        
        $university->update($validatedData);        

        return redirect(route('universities.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($university)
    {
        $university->delete();

        return redirect(route('universities.index'));
    }
}
