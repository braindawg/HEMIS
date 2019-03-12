<?php

namespace App\Http\Controllers\Users;

use App\User;
use App\Models\Role;
use App\Models\Grade;
use App\Models\University;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\DataTables\UsersDataTable;

use App\Http\Controllers\Controller;

class UsersController extends Controller
{
    public function __construct()
    {        
         $this->middleware('permission:view-user', ['only' => ['index', 'show']]);        
         $this->middleware('permission:create-user', ['only' => ['create','store']]);
         $this->middleware('permission:edit-user', ['only' => ['edit','update']]);
         $this->middleware('permission:delete-user', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(UsersDataTable $dataTable)
    {         
        return $dataTable->render('users.index', [
            'title' => trans('general.users'),
            'description' => trans('general.users_list') 
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        
        return view('users.create', [
            'title' => trans('general.users'),
            'description' => trans('general.create_account'),
            'roles' => Role::all(),            
            'universities' => ['-1' => trans('general.all_options')] + University::pluck('name', 'id')->toArray(),
            'departments' => old('departments') ? Department::whereIn('id', old('departments'))->pluck('name', 'id') : [],
            'grades' => Grade::pluck('name', 'id')
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
            'name' => 'required',
            'position' => 'required',            
            'email' => 'required|email|unique:users',
            'phone' => 'nullable',
            'password' => 'required|confirmed'            
        ]);
        
        \DB::transaction(function () use ($request) {
            $user = User::create([
                'name' => $request->name,
                'position' => $request->position,
                'email' => $request->email,
                'phone' => $request->phone,
                'university_id' => $request->university_id ?? null,
                'password' => $request->password ?? null,
                'active' => $request->has('active'),
            ]);

            $user->roles()->sync($request->roles ?? []);

            $user->departments()->sync($request->departments ?? []); 
            
            $user->grades()->sync($request->grades ?? []); 
        });

        return redirect(route('users.index'));
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
    public function edit($user)
    {        
        return view('users.edit', [
            'title' => trans('general.users'),
            'description' => trans('general.edit_account'),
            'user' => $user,
            'roles' => Role::all(),
            'universities' => ['-1' => trans('general.all_options')] + University::pluck('name', 'id')->toArray(),
            'departments' => old('departments') ? Department::whereIn('id', old('departments'))->pluck('name', 'id') : $user->departments()->pluck('name', 'id'),
            'grades' => Grade::pluck('name', 'id')
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $user)
    {        
        $validatedData = $request->validate([
            'name' => 'required',
            'position' => 'required',            
            'email' => [
                'required', 
                Rule::unique('users')->ignore($user->id, 'id')->whereNull('deleted_at')
            ],
            'phone' => 'nullable',
            'university_id' => 'nullable',
            'password' => 'nullable|confirmed'            
        ]);
        
        \DB::transaction(function () use ($user, $request) {
            $user->update([
                'name' => $request->name,
                'position' => $request->position,
                'email' => $request->email,
                'phone' => $request->phone,
                'university_id' => $request->university_id ?? null,
                'password' => $request->password ?? null,
                'active' => $request->has('active')
            ]);

            $user->roles()->sync($request->roles ?? []);
            
            $user->departments()->sync($request->departments ?? []);

            $user->grades()->sync($request->grades ?? []);
        });

        return redirect(route('users.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($user)
    {
        $user->delete();

        return redirect(route('users.index'));
    }
}
