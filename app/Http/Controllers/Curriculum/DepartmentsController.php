<?php

namespace App\Http\Controllers\Curriculum;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Maklad\Permission\Models\Role;
use App\Http\Controllers\Controller;
use App\DataTables\DepartmentsDataTable;

class DepartmentsController extends Controller
{

    public function __construct()
    {        
        //  $this->middleware('permission:view-department', ['only' => ['index', 'show']]);        
        //  $this->middleware('permission:create-department', ['only' => ['create','store']]);
        //  $this->middleware('permission:edit-department', ['only' => ['edit','update']]);
        //  $this->middleware('permission:delete-department', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(DepartmentsDataTable $dataTable, $university)
    {        
        return $dataTable->render('curriculum.departments', [
            'title' => $university->name,
            'description' => trans('general.departments_list'),
            'university' => $university
        ]);
    }
}
