<?php

namespace App\Http\Controllers;
use App\Models\Department;
use App\Models\Student;
use App\Events\GroupsGenerateEvent;

use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index(){

        return view('settings.index', [
            'title' => trans('general.settings')
        ]);
    }

    // public function generateGroups(){

    //     $departments = Department::all();

    //    $groups =  event(new GroupsGenerateEvent($departments));

    //     return redirect(route('setting'))->with('message' , $groups[0]);
        
    // }


    // public function createTimetable(){
    //     return view('settings.timetable', [
    //         'title' => trans('general.settings')
    //     ]);
    // }
}
