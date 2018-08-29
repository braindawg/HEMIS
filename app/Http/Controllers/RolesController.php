<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\DataTables\RolesDataTable;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesController extends Controller
{

    public function __construct()
    {        
         $this->middleware('permission:view-role', ['only' => ['index', 'show']]);        
         $this->middleware('permission:create-role', ['only' => ['create','store']]);
         $this->middleware('permission:edit-role', ['only' => ['edit','update']]);
         $this->middleware('permission:delete-role', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(RolesDataTable $dataTable)
    {        
        return $dataTable->render('roles.index', [
            'title' => trans('general.users'),
            'description' => trans('general.roles_list'),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('roles.create', [
            'title' => trans('general.users'),
            'description' => trans('general.create_role'),
            'abilities' => Permission::all()
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
            'name' => 'required|unique:roles',
            'title' => 'required'                         
        ]);
        
        $role = Role::create($validatedData);

        if ($request->abilities) {
            $role->permissions()->sync($request->abilities);
        }
        
        return redirect(route('roles.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($user)
    {
        exit();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($role)
    {
        return view('roles.edit', [
            'title' => trans('general.users'),
            'description' => trans('general.edit_role'),
            'role' => $role,
            'abilities' => Permission::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $role)
    {
                
        $validatedData = $request->validate([            
            'name' => [
                'required', 
                Rule::unique('roles')->ignore($role->id, 'id')
            ],
            'title' => 'required'              
        ]);
        
        $role->update($validatedData);

        if ($request->abilities) {
            $role->permissions()->sync($request->abilities);
        }
        
        return redirect(route('roles.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($role)
    {
        $role->syncPermissions([]);
        $role->delete();

        return redirect(route('roles.index'));
    }
}
