<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use \App\Models\Province;
use \App\Models\Department;
use \App\Models\Student;
use \App\Models\University;
use Illuminate\Http\Request;
use \App\Models\StudentStatus;
use \App\Models\subject;
use \App\Models\Course;
use \App\Models\Leave;
use \App\Models\Dropout;
use \App\Models\Teacher;
use \App\Models\Transfer;
use \App\Models\Group;
use \App\Models\Announcement;
use Illuminate\Support\Facades\DB;
use DateTime;
use App\User;
use Carbon\CarbonPeriod;

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

        
        //  line chart backend code for User
        $dates = collect();
        $day = array();
        foreach( range( -30, 0 ) AS $i )
        {
            $date = Carbon::now()->addDays( $i )->format( 'M-d' );
            $day[] = Carbon::now()->addDays( $i )->format( 'd' );
            $dates->put( $date, 0);//create an array that key is date and assign zero to its value
        }


    $users = User::where( 'created_at', '>=', Carbon::now()->subDays(30))
        ->groupBy( 'date' )
        ->orderBy( 'date' )
        ->get( [
        DB::raw( 'DATE( created_at ) as date' ),
        DB::raw( 'COUNT( * ) as "count"' )
        ] )->pluck( 'count', 'date' );
                
  // Merge the two collections; any results in `$users` will overwrite the zero-value in `$dates`yz
    $users = $dates->merge( $users );
    $user = array();

    foreach ($users as $key => $value) {
    $user[Carbon::parse($key)->format('M-d')] = $value;
    }
// end line chart backend code for User
       

//line chart backend code for Leaves
    $Leave = Leave::where( 'created_at', '>=',  Carbon::now()->subDays(30))
        ->groupBy( 'date' )
        ->orderBy( 'date' )
        ->get( [
            DB::raw( 'DATE( created_at ) as date' ),
            DB::raw( 'COUNT( * ) as "count"' )
        ] )->pluck( 'count', 'date' );

    // Merge the two collections; any results in `$users` will overwrite the zero-value in `$dates`yz
    $Leave = $dates->merge( $Leave );
    $Leaves = array();

    foreach ($Leave as $key => $value) {
        $Leaves[Carbon::parse($key)->format('d')] = $value;
    }
//line chart backend code for Leaves

//line chart backend code for Taransfers
    $Taransfers = Transfer::where( 'created_at', '>=',  Carbon::now()->subDays(30))
        ->groupBy( 'date' )
        ->orderBy( 'date' )
        ->get( [
            DB::raw( 'DATE( created_at ) as date' ),
            DB::raw( 'COUNT( * ) as "count"' )
            ] )->pluck( 'count', 'date' );

        // Merge the two collections; any results in `$users` will overwrite the zero-value in `$dates`yz
        $Taransfers = $dates->merge( $Taransfers );
        $Taransfer = array();

        foreach ($Taransfers as $key => $value) {
            
            $Taransfer[Carbon::parse($key)->format('d')] = $value;
        }

// end line chart backend code for Taransfer

//line chart backend code for Dropout

    $Dropouts = Dropout::where( 'created_at', '>=',  Carbon::now()->subDays(30))
        ->groupBy( 'date' )
        ->orderBy( 'date' )
        ->get( [
            DB::raw( 'DATE( created_at ) as date' ),
            DB::raw( 'COUNT( * ) as "count"' )
            ] )->pluck( 'count', 'date' );

        // Merge the two collections; any results in `$users` will overwrite the zero-value in `$dates`yz
        $Dropouts = $dates->merge( $Dropouts );
        $Dropout = array();

        foreach ($Dropouts as $key => $value) {
            
            $Dropout[Carbon::parse($key)->format('d')] = $value;
        }
// end line chart backend code for Dropout 


//line chart backend code for GROUP
//first create an array that has 12 index  and assign it to 0    
    $Groups = Group::where( 'created_at', '>=',  Carbon::now()->subDays(30))
        ->groupBy( 'date' )
        ->orderBy( 'date' )
        ->get( [
            DB::raw( 'DATE( created_at ) as date' ),
            DB::raw( 'COUNT( * ) as "count"' )
            ] )->pluck( 'count', 'date' );

    // Merge the two collections; any results in `$users` will overwrite the zero-value in `$dates`yz
    $Groups = $dates->merge( $Groups );
    $Group = array();

    foreach ($Groups as $key => $value) {
        
        $Group[Carbon::parse($key)->format('d')] = $value;
    }

// end line chart backend code for GROUP 

//line chart backend code for Announcements
    $Announcements = Announcement::where( 'created_at', '>=',  Carbon::now()->subDays(30))
        ->groupBy( 'date' )
        ->orderBy( 'date' )
        ->get( [
            DB::raw( 'DATE( created_at ) as date' ),
            DB::raw( 'COUNT( * ) as "count"' )
            ] )->pluck( 'count', 'date' );

            // Merge the two collections; any results in `$users` will overwrite the zero-value in `$dates`yz
            $Announcements = $dates->merge( $Announcements );
            $Announcement = array();

            foreach ($Announcements as $key => $value) {
                
                $Announcement[Carbon::parse($key)->format('d')] = $value;
            }

// end line chart backend code for Announcements

//line chart backend code for Courses
//first create an array that has 12 index  and assign it to 0   
    $Courses = Course::where( 'created_at', '>=',  Carbon::now()->subDays(30))
        ->groupBy( 'date' )
        ->orderBy( 'date' )
        ->get( [
            DB::raw( 'DATE( created_at ) as date' ),
            DB::raw( 'COUNT( * ) as "count"' )
            ] )->pluck( 'count', 'date' );

        // Merge the two collections; any results in `$users` will overwrite the zero-value in `$dates`yz
        $Courses = $dates->merge( $Courses );
        $Course = array();

        foreach ($Courses as $key => $value) {
            
            $Course[Carbon::parse($key)->format('d')] = $value;
        }
// end line chart backend code for Cours  

// line chart backend code for teachers
//first create an array that has 12 index  and assign it to 0    
    $Teachers = Teacher::where( 'created_at', '>=',  Carbon::now()->subDays(30))
        ->groupBy( 'date' )
        ->orderBy( 'date' )
        ->get( [
            DB::raw( 'DATE( created_at ) as date' ),
            DB::raw( 'COUNT( * ) as "count"' )
            ] )->pluck( 'count', 'date' );

    // Merge the two collections; any results in `$users` will overwrite the zero-value in `$dates`yz
    $Teachers = $dates->merge( $Teachers );
    $Teacher = array();

    foreach ($Teachers as $key => $value) {
        
        $Teacher[Carbon::parse($key)->format('d')] = $value;
    }
// end line chart backend code for teachers 

// line chart backend code for subject
//first create an array that has 12 index  and assign it to 0    
     $subjects = subject::where( 'created_at', '>=',  Carbon::now()->subDays(30))
        ->groupBy( 'date' )
        ->orderBy( 'date' )
        ->get( [
            DB::raw( 'DATE( created_at ) as date' ),
            DB::raw( 'COUNT( * ) as "count"' )
            ] )
        ->pluck( 'count', 'date' );

    // Merge the two collections; any results in `$users` will overwrite the zero-value in `$dates`yz
    $subjects = $dates->merge( $subjects );
    $subject = array();
    foreach ($subjects as $key => $value) {
        
        $subject[Carbon::parse($key)->format('d')] = $value;
    }
   

// end line chart backend code for subject 
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
            'current_kankor_year' => $kankorYear,
            'users' => $user,
            'teachers' => $Teacher,
            'subjects' => $subject,
            'Courses' => $Course,
            'Leaves' => $Leaves,
            'Dropouts' => $Dropout,
            'Taransfers' => $Taransfer,
            'Announcements' => $Announcement,
            'Groups' => $Group,
            'dates' => $day
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