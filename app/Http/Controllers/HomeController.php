<?php
namespace App\Http\Controllers;
use \App\Models\Student;
use \App\Models\University;
use Illuminate\Http\Request;
use \App\Models\StudentStatus;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $provinces = Student::select('province', \DB::raw('count(id) as count'))
        ->groupBy('province')
        ->withoutGlobalScopes()
        ->get();
        
        $universities = Student::leftJoin('universities', 'universities.id', '=', 'university_id')
            ->select('universities.name', \DB::raw('count(students.id) as count'))
            ->groupBy('universities.name')
            ->with('university')
            ->withoutGlobalScopes()
            ->get();
        $statuses = StudentStatus::get();
        $universityStatus = University::with('studentsByStatus')->get();
       // dd($universityStatus->first()->studentsByStatus);
        return view('home', [
            'title' => trans('general.dashboard'),
            'statuses' => $statuses,
            'provinces' => $provinces,
            'universities' => $universities,
            'universityStatus' => $universityStatus
        ]);
    }
}