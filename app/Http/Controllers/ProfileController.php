<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        return view('profile.index', [
            'title' => trans('general.profile'),
            'description' => trans('general.change_password'),
        ]);
    }

    public function store(Request $request)
    {   
        $this->validate($request, [
            'password' => 'required|confirmed|min: 8'            
        ]);

        auth()->user()->update([
            'password' => $request->password
        ]);

        if (auth('teacher')->check()) {
            return redirect('/teacher');
        }

        return redirect('/');
    }
}
