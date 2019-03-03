<?php

namespace App\Http\Controllers;

use \App\Models\Province;
use \App\Models\Department;
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
    public function index($kankorYear = null)
    {        
        $kankorYear = $kankorYear ?? \App\Models\Student::max('kankor_year');
        
        $kankorYears = Student::select('kankor_year')->distinct()->orderBy('kankor_year', 'desc')->get();

        $universityName = '';
         if( auth()->user()->allUniversities() ) {
            $studentsByStatus = University::with(['studentsByStatus' => function ($students) use ($kankorYear){
                $students->where('kankor_year' , $kankorYear);
            }])->get();
            
            $allUniversities = University::get();
        }
        else {
            $studentsByStatus = Department::with(['studentsByStatus' => function ($students) use ($kankorYear){
                $students->where('kankor_year' , $kankorYear);
            }])->get();
            $allUniversities = University::where('id', auth()->user()->university_id)->get();
            $universityName = $allUniversities->first()->name;
        }

        //this query returns some basic states such as total universities, departments, students count by status
        $allProvinces = Province::get();
        
        $allDepartments = Department::get();

        $allStudents = Student::where('kankor_year', $kankorYear)->count();


        $totalStudentsByStatus = Student::select(\DB::raw('count(students.id) as students_count'),'status_id as status')
            ->where('kankor_year', $kankorYear)
            ->groupBy('status_id')
            ->get();

        $provinces = Student::select('provinces.name as province', \DB::raw('count(students.id) as count'))
        ->leftJoin('provinces', 'provinces.id', '=', 'students.province')
        ->groupBy('provinces.name')
        ->where('kankor_year', $kankorYear)
        ->withoutGlobalScopes()
        ->get();
        
        $universities = Student::leftJoin('universities', 'universities.id', '=', 'university_id')
            ->select('universities.name', \DB::raw('count(students.id) as count'))
            ->where('kankor_year', $kankorYear)
            ->groupBy('universities.name')
            ->with('university')
            ->withoutGlobalScopes()
            ->get();

        // to take the first city for province data manipulation
        $city = $allProvinces->first();

        // to take the first university for university data manipulation
        $university = $allUniversities->first();

        // this query is used to fetch students of a specific city in all the universities
        $provinceStudentsInUnis = Student::leftJoin('universities', 'universities.id', '=', 'university_id')
            ->select('universities.name', \DB::raw('count(students.id) as std_count'))
            ->where('province', $city->id)
            ->where('kankor_year', $kankorYear)
            ->orderBy('std_count', 'asc')
            ->groupBy('universities.name')
            ->withoutGlobalScopes()
            ->get();


        //  This query is used to fetch data of a specific university grouped by provinces
        $uniStudentsFromProvinces = Student::leftJoin('provinces', 'provinces.id', '=', 'province')
            ->select('provinces.name', \DB::raw('count(students.id) as std_count'))
            ->where('university_id', $university->id)
            ->where('kankor_year', $kankorYear)
            ->orderBy('std_count', 'asc')
            ->groupBy('provinces.name')
            ->withoutGlobalScopes()
            ->get(); 

        $statuses = \DB::table('student_statuses')->orderBy('id', 'desc')->get();

   
        return view('home', [
            'title' => trans('general.dashboard'),
            'statuses' => $statuses,
            'city' => $city->name,
            'provinces' => $provinces,
            'uniName' => $university->name,
            'universityName' => $universityName,
            'universities' => $universities,
            'studentsByStatus' => $studentsByStatus,
            'uniSpecStudents' => $provinceStudentsInUnis,
            'proSpecStudents' => $uniStudentsFromProvinces,
            'allUniversities' => $allUniversities,
            'allDepartments' => $allDepartments,
            'allProvinces' => $allProvinces,
            'allStudents' => $allStudents,
            'studentsByStatusCount' => $totalStudentsByStatus,
            'kankorYears' => $kankorYears,
            'current_kankor_year' => $kankorYear
        ]);
    }


    public function updateData(Request $request) {
        
        // Check if the request is made to fetch province specific data
        if($request->pro) {

        // this query is used to fetch students of a specific city in all the universities

            $provinceStudentsInUnis = Student::leftJoin('universities', 'universities.id', '=', 'university_id')
                ->select('universities.name', \DB::raw('count(students.id) as std_count'))
                ->where('province', $request->pro)
                ->where('kankor_year', 1397)
                ->orderBy('std_count', 'asc')
                ->groupBy('universities.name')
                ->withoutGlobalScopes()
                ->get();

            $meta = Province::select('name')->where('id',$request->pro)->get();
        

            return response()->json(array('specData'=> $provinceStudentsInUnis, 'meta' => $meta), 200);

        }

        // Check if the request is made to fetch university specific data
        if($request->uni) {

                //  This query is used to fetch data of a specific university grouped by provinces
                $uniStudentsFromProvinces = Student::leftJoin('provinces', 'provinces.id', '=', 'province')
                    ->select('provinces.name', \DB::raw('count(students.id) as std_count'))
                    ->where('university_id', $request->uni)
                    ->where('kankor_year', 1397)
                    ->orderBy('std_count', 'asc')
                    ->groupBy('provinces.name')
                    ->withoutGlobalScopes()
                    ->get();

                $meta = University::select('name')->where('id',$request->uni)->get();
                


                return response()->json(array('specData'=> $uniStudentsFromProvinces, 'meta' => $meta), 200);

        } else {

            return response()->json('Request could not be processed', 404);
        }


    }
}