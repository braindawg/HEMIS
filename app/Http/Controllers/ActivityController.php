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

class ActivityController extends Controller
{
    public function index(){

        $dates = collect();
        $day = array();
        foreach( range( -7, 0 ) AS $i )
        {
            $date = Carbon::now()->addDays( $i )->format( 'M-d' );
            $day[] = Carbon::now()->addDays( $i )->format( 'd' );
            $dates->put( $date, 0);//create an array that key is date and assign zero to its value
        }


    $Users = User::where( 'created_at', '>=', Carbon::now()->subDays(7))
        ->groupBy( 'date' )
        ->orderBy( 'date' )
        ->get( [
        DB::raw( 'DATE( created_at ) as date' ),
        DB::raw( 'COUNT( * ) as "count"' )
        ] )->pluck( 'count', 'date' );
                
  // Merge the two collections; any results in `$users` will overwrite the zero-value in `$dates`yz
    $Users = $dates->merge( $Users );
    $User = array();

    foreach ($Users as $key => $value) {
    $User[Carbon::parse($key)->format('m-d')] = $value;
    }
// end line chart backend code for User
       

//line chart backend code for Leaves
    $Leave = Leave::where( 'created_at', '>=',  Carbon::now()->subDays(7))
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
        $Leaves[Carbon::parse($key)->format('m-d')] = $value;
    }
//line chart backend code for Leaves

//line chart backend code for Taransfers
    $Taransfers = Transfer::where( 'created_at', '>=',  Carbon::now()->subDays(7))
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
            
            $Taransfer[Carbon::parse($key)->format('m-d')] = $value;
        }

        
 

// end line chart backend code for Taransfer

//line chart backend code for Dropout

    $Dropouts = Dropout::where( 'created_at', '>=',  Carbon::now()->subDays(7))
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
            
            $Dropout[Carbon::parse($key)->format('m-d')] = $value;
        }
// end line chart backend code for Dropout 


//line chart backend code for GROUP
//first create an array that has 12 index  and assign it to 0    
    $Groups = Group::where( 'created_at', '>=',  Carbon::now()->subDays(7))
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
        
        $Group[Carbon::parse($key)->format('m-d')] = $value;
    }

// end line chart backend code for GROUP 

//line chart backend code for Announcements
    $Announcements = Announcement::where( 'created_at', '>=',  Carbon::now()->subDays(7))
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
                
                $Announcement[Carbon::parse($key)->format('m-d')] = $value;
            }

// end line chart backend code for Announcements

//line chart backend code for Courses
//first create an array that has 12 index  and assign it to 0   
    $Courses = Course::where( 'created_at', '>=',  Carbon::now()->subDays(7))
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
            
            $Course[Carbon::parse($key)->format('m-d')] = $value;
        }
// end line chart backend code for Cours  

// line chart backend code for teachers
//first create an array that has 12 index  and assign it to 0    
    $Teachers = Teacher::where( 'created_at', '>=',  Carbon::now()->subDays(7))
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
        
        $Teacher[Carbon::parse($key)->format('m-d')] = $value;
    }
// end line chart backend code for teachers 

// line chart backend code for subject
//first create an array that has 12 index  and assign it to 0    
     $Subjects = subject::where( 'created_at', '>=',  Carbon::now()->subDays(7))
        ->groupBy( 'date' )
        ->orderBy( 'date' )
        ->get( [
            DB::raw( 'DATE( created_at ) as date' ),
            DB::raw( 'COUNT( * ) as "count"' )
            ] )
        ->pluck( 'count', 'date' );

    // Merge the two collections; any results in `$users` will overwrite the zero-value in `$dates`yz
    $Subjects = $dates->merge( $Subjects );
    $Subject = array();
    foreach ($Subjects as $key => $value) {
        
        $Subject[Carbon::parse($key)->format('m-d')] = $value;
    }

    $universities = University::all();

    return view('layouts.activity_chart', [
        'title' => trans('general.activity'),
        'allUniversities' => $universities,
        'users' => $User,
        'teachers' => $Teacher,
        'subjects' => $Subject,
        'Courses' => $Course,
        'Leaves' => $Leaves,
        'Dropouts' => $Dropout,
        'Taransfers' => $Taransfer,
        'Announcements' => $Announcement,
        'Groups' => $Group,
        'dates' => $dates
    ]);
    }

    
 public function getActivityByUniversity(Request $request)
 {

   $diff = Carbon::parse($request->startdate)->diffInDays(Carbon::parse($request->enddate));
    
     $dates = collect();
     $day = array();
     foreach( range( $diff, 0 ) AS $i )
     {
        //echo "i am i ".$i."<br>";
         $date = Carbon::parse($request->startdate)->addDays( $i )->format( 'M-d' );
        // echo "i am date ".$date."<br>";
         $day[] = Carbon::parse($request->startdate)->addDays( $i )->format( 'd' );
         //echo "i am date ".$date."<br>";
         $dates->put( $date, 0);//create an array that key is date and assign zero to its value
     }
    
 
     // for users
     ///////////////////////////////////***************************************************** */
     $users = User::where( 'created_at', '>=',Carbon::parse($request->startdate) )
     ->where( 'created_at', '<=',Carbon::parse($request->enddate) )
     ->where('university_id',$request->universities)
     ->groupBy( 'date' )
     ->orderBy( 'date' )
     ->get( [
             DB::raw( 'DATE( created_at ) as date' ),
              DB::raw( 'COUNT( * ) as "count"' )
             ] )->pluck( 'count', 'date' );
   
$users = $dates->merge( $users );
$user = array();


foreach ($users as $key => $value) {
 $user[Carbon::parse($key)->format('m-d')] = $value;
 //$user[$key] = $value;
}
//////////////////////////////////************************************************ */


 // line chart backend code for teachers
    //first create an array that has 12 index  and assign it to 0    
        $teachers = Teacher::where( 'created_at', '>=', Carbon::parse($request->startdate) )
            ->where( 'created_at', '<=', Carbon::parse($request->enddate) )
            ->where('university_id', $request->universities)
            ->groupBy( 'date' )
            ->orderBy( 'date' )
            ->get( [
                DB::raw( 'DATE( created_at ) as date' ),
                DB::raw( 'COUNT( * ) as "count"' )
                ] )->pluck( 'count', 'date' );

        // Merge the two collections; any results in `$users` will overwrite the zero-value in `$dates`yz
        $teachers = $dates->merge( $teachers );
        $Teacher = array();

        foreach ($teachers as $key => $value) {
            
            $Teacher[Carbon::parse($key)->format('m-d')] = $value;
        }
    // end line chart backend code for teachers 


    //line chart backend code for Courses
    //first create an array that has 12 index  and assign it to 0   
        $courses = Course::where( 'created_at', '>=',Carbon::parse($request->startdate) )
            ->where( 'created_at', '<=',Carbon::parse($request->enddate) )
            ->where('university_id',$request->universities)
            ->groupBy( 'date' )
            ->orderBy( 'date' )
            ->get( [
                DB::raw( 'DATE( created_at ) as date' ),
                DB::raw( 'COUNT( * ) as "count"' )
                ] )->pluck( 'count', 'date' );

            // Merge the two collections; any results in `$users` will overwrite the zero-value in `$dates`yz
            $courses = $dates->merge( $courses );
            $course = array();

            foreach ($courses as $key => $value) {
                
                $course[Carbon::parse($key)->format('m-d')] = $value;
            }
    // end line chart backend code for Cours  

    // line chart backend code for subject
    //first create an array that has 12 index  and assign it to 0    
        $subjects = subject::where( 'created_at', '>=',Carbon::parse($request->startdate) )
        ->where( 'created_at', '<=',Carbon::parse($request->enddate) )
        ->where('university_id',$request->universities)
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

$uniname = University::find($request->universities)->name;
return view('layouts.activity_chart', compact('user','allUniversities','Teacher','course','uniname','dates','diff', 'subject'));  
 }

}
