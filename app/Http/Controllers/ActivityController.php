<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use \App\Models\Student;
use \App\Models\University;
use Illuminate\Http\Request;
use \App\Models\Subject;
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
    public function index($university = null , $startdate =null , $enddate =null){

        $uniname = "";
        $user = null;
        $teacher = null;
        $subject = null;
        $course = null;
        $dropout = null;
        $group = null;
        $leave = null;
        $transfer = null;
        $dates = null;
        $diff = 7;
        $university_id = null;

        $allUniversities = University::all();
        $dates = collect();
        $day = array();

        if($university == null){

            foreach( range( -7, 0 ) AS $i )
            {
                $date = Carbon::now()->addDays( $i )->format( 'M-d' );
                $day[] = Carbon::now()->addDays( $i )->format( 'd' );
                $dates->put( $date, 0);//create an array that key is date and assign zero to its value
            }


            $users = User::where( 'created_at', '>=', Carbon::now()->subDays(7))
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
            }
        
            $leaves = Leave::where( 'created_at', '>=',  Carbon::now()->subDays(7))
                ->groupBy( 'date' )
                ->orderBy( 'date' )
                ->get( [
                    DB::raw( 'DATE( created_at ) as date' ),
                    DB::raw( 'COUNT( * ) as "count"' )
                    ] )->pluck( 'count', 'date' );

            $leaves = $dates->merge( $leaves );
            $leave = array();


            foreach ($leaves as $key => $value) {
                $leave[Carbon::parse($key)->format('m-d')] = $value;
            }

            $transfers = Transfer::where( 'created_at', '>=',  Carbon::now()->subDays(7))
                ->groupBy( 'date' )
                ->orderBy( 'date' )
                ->get( [
                    DB::raw( 'DATE( created_at ) as date' ),
                    DB::raw( 'COUNT( * ) as "count"' )
                    ] )->pluck( 'count', 'date' );

            $transfers = $dates->merge( $transfers );
            $transfer = array();

            foreach ($transfers as $key => $value) {
                
                $transfer[Carbon::parse($key)->format('m-d')] = $value;
            }
            

            $dropouts = Dropout::where( 'created_at', '>=',  Carbon::now()->subDays(7))
                ->groupBy( 'date' )
                ->orderBy( 'date' )
                ->get( [
                    DB::raw( 'DATE( created_at ) as date' ),
                    DB::raw( 'COUNT( * ) as "count"' )
                    ] )->pluck( 'count', 'date' );

            $dropouts = $dates->merge( $dropouts );
            $dropout = array();

            foreach ($dropouts as $key => $value) {
                
                $dropout[Carbon::parse($key)->format('m-d')] = $value;
            }

            $groups = Group::where( 'created_at', '>=',  Carbon::now()->subDays(7))
                ->groupBy( 'date' )
                ->orderBy( 'date' )
                ->get( [
                    DB::raw( 'DATE( created_at ) as date' ),
                    DB::raw( 'COUNT( * ) as "count"' )
                    ] )->pluck( 'count', 'date' );


            $groups = $dates->merge( $groups );
            $group = array();

            foreach ($groups as $key => $value) {
                
                $group[Carbon::parse($key)->format('m-d')] = $value;
            }

            $courses = Course::where( 'created_at', '>=',  Carbon::now()->subDays(7))
                ->groupBy( 'date' )
                ->orderBy( 'date' )
                ->get( [
                    DB::raw( 'DATE( created_at ) as date' ),
                    DB::raw( 'COUNT( * ) as "count"' )
                    ] )->pluck( 'count', 'date' );

            $courses = $dates->merge( $courses );
            $course = array();

            foreach ($courses as $key => $value) {
                
                $course[Carbon::parse($key)->format('m-d')] = $value;
            }


            $teachers = Teacher::where( 'created_at', '>=',  Carbon::now()->subDays(7))
                ->groupBy( 'date' )
                ->orderBy( 'date' )
                ->get( [
                    DB::raw( 'DATE( created_at ) as date' ),
                    DB::raw( 'COUNT( * ) as "count"' )
                    ] )->pluck( 'count', 'date' );

            $teachers = $dates->merge( $teachers );
            $teacher = array();

            foreach ($teachers as $key => $value) {
                
                $teacher[Carbon::parse($key)->format('m-d')] = $value;
            }


            $subjects = Subject::where( 'created_at', '>=',  Carbon::now()->subDays(7))
                ->groupBy( 'date' )
                ->orderBy( 'date' )
                ->get( [
                    DB::raw( 'DATE( created_at ) as date' ),
                    DB::raw( 'COUNT( * ) as "count"' )
                    ] )
                ->pluck( 'count', 'date' );

            $subjects = $dates->merge( $subjects );
            $subject = array();
                
            foreach ($subjects as $key => $value) {
                
                $subject[Carbon::parse($key)->format('m-d')] = $value;
            }

        }else if($university == "0"){
            
            $diff = Carbon::parse($startdate)->diffInDays(Carbon::parse($enddate));

            foreach( range( $diff, 0 ) AS $i )
            {
            
                $date = Carbon::parse($startdate)->addDays( $i )->format( 'M-d' );
                $day[] = Carbon::parse($startdate)->addDays( $i )->format( 'd' );

                $dates->put( $date, 0);
            }
            
            $users = User::where( 'created_at', '>=',Carbon::parse($startdate) )
                ->where( 'created_at', '<=',Carbon::parse($enddate) )
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
                    }


            $leaves = Leave::where( 'created_at', '>=',Carbon::parse($startdate) )
                ->where( 'created_at', '<=',Carbon::parse($enddate) )
                    ->groupBy( 'date' )
                    ->orderBy( 'date' )->get( [
                        DB::raw( 'DATE( created_at ) as date' ),
                        DB::raw( 'COUNT( * ) as "count"' )
                        ] )->pluck( 'count', 'date' );

            $leaves = $dates->merge( $leaves );
            $leave = array();

            foreach ($leaves as $key => $value) {

            $leave[Carbon::parse($key)->format('m-d')] = $value;
            
            }
            
            $transfers = Transfer::where( 'created_at', '>=',Carbon::parse($startdate) )
                ->where( 'created_at', '<=',Carbon::parse($enddate) )
                ->groupBy( 'date' )
                ->orderBy( 'date' )
                ->get( [
                    DB::raw( 'DATE( created_at ) as date' ),
                    DB::raw( 'COUNT( * ) as "count"' )
                    ] )->pluck( 'count', 'date' );

            $transfers = $dates->merge( $transfers );
            $transfer = array();

            foreach ($transfers as $key => $value) {
                
                $transfer[Carbon::parse($key)->format('m-d')] = $value;
            }
            

            $dropouts = Dropout::where( 'created_at', '>=',Carbon::parse($startdate) )
                ->where( 'created_at', '<=',Carbon::parse($enddate) )
                ->where('university_id',$university)
                ->groupBy( 'date' )
                ->orderBy( 'date' )
                ->get( [
                    DB::raw( 'DATE( created_at ) as date' ),
                    DB::raw( 'COUNT( * ) as "count"' )
                    ] )->pluck( 'count', 'date' );

            $dropouts = $dates->merge( $dropouts );
            $dropout = array();

            foreach ($dropouts as $key => $value) {
                
            $dropout[Carbon::parse($key)->format('m-d')] = $value;
            }

            $groups = Group::where( 'created_at', '>=',Carbon::parse($startdate) )
                ->where( 'created_at', '<=',Carbon::parse($enddate) )
                ->groupBy( 'date' )
                ->orderBy( 'date' )
                ->get( [
                    DB::raw( 'DATE( created_at ) as date' ),
                    DB::raw( 'COUNT( * ) as "count"' )
                    ] )->pluck( 'count', 'date' );

            $groups = $dates->merge( $groups );
            $group = array();

            foreach ($groups as $key => $value) {
                
            $group[Carbon::parse($key)->format('m-d')] = $value;
            } 

            $teachers = Teacher::where( 'created_at', '>=', Carbon::parse($startdate) )
                ->where( 'created_at', '<=', Carbon::parse($enddate) )
                ->groupBy( 'date' )
                ->orderBy( 'date' )
                ->get( [
                    DB::raw( 'DATE( created_at ) as date' ),
                    DB::raw( 'COUNT( * ) as "count"' )
                    ] )->pluck( 'count', 'date' );

            $teachers = $dates->merge( $teachers );
            $teacher = array();

            foreach ($teachers as $key => $value) {
                
            $teacher[Carbon::parse($key)->format('m-d')] = $value;
            }

            $courses = Course::where( 'created_at', '>=',Carbon::parse($startdate) )
                ->where( 'created_at', '<=',Carbon::parse($enddate) )
                ->groupBy( 'date' )
                ->orderBy( 'date' )
                ->get( [
                    DB::raw( 'DATE( created_at ) as date' ),
                    DB::raw( 'COUNT( * ) as "count"' )
                    ] )->pluck( 'count', 'date' );

            $courses = $dates->merge( $courses );
            $course = array();

            foreach ($courses as $key => $value) {
                
            $course[Carbon::parse($key)->format('m-d')] = $value;
            }   
        
            $subjects = subject::where( 'created_at', '>=',Carbon::parse($startdate) )
            ->where( 'created_at', '<=',Carbon::parse($enddate) )
            ->groupBy( 'date' )
                ->orderBy( 'date' )
                ->get( [
                    DB::raw( 'DATE( created_at ) as date' ),
                    DB::raw( 'COUNT( * ) as "count"' )
                    ] )->pluck( 'count', 'date' );

            $subjects = $dates->merge( $subjects );
            $subject = array();

            foreach ($subjects as $key => $value) {
                
            $subject[Carbon::parse($key)->format('m-d')] = $value;
            }
        } else { // start of else condition

                $university_id = $university;
                $diff = Carbon::parse($startdate)->diffInDays(Carbon::parse($enddate));

                foreach( range( $diff, 0 ) AS $i )
                {
                
                    $date = Carbon::parse($startdate)->addDays( $i )->format( 'M-d' );
                    $day[] = Carbon::parse($startdate)->addDays( $i )->format( 'd' );

                    $dates->put( $date, 0);
                }
                
                $users = User::where( 'created_at', '>=',Carbon::parse($startdate) )
                    ->where( 'created_at', '<=',Carbon::parse($enddate) )
                    ->where('university_id',$university)
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
                        }


                $leaves = Leave::where( 'created_at', '>=',Carbon::parse($startdate) )
                    ->where( 'created_at', '<=',Carbon::parse($enddate) )
                    ->where('university_id',$university)
                        ->groupBy( 'date' )
                        ->orderBy( 'date' )->get( [
                            DB::raw( 'DATE( created_at ) as date' ),
                            DB::raw( 'COUNT( * ) as "count"' )
                            ] )->pluck( 'count', 'date' );

                $leaves = $dates->merge( $leaves );
                $leave = array();

                foreach ($leaves as $key => $value) {

                $leave[Carbon::parse($key)->format('m-d')] = $value;
                
                }

                $dropouts = Dropout::where( 'created_at', '>=',Carbon::parse($startdate) )
                    ->where( 'created_at', '<=',Carbon::parse($enddate) )
                    ->where('university_id',$university)
                    ->groupBy( 'date' )
                    ->orderBy( 'date' )
                    ->get( [
                        DB::raw( 'DATE( created_at ) as date' ),
                        DB::raw( 'COUNT( * ) as "count"' )
                        ] )->pluck( 'count', 'date' );

                $dropouts = $dates->merge( $dropouts );
                $dropout = array();

                foreach ($dropouts as $key => $value) {
                    
                $dropout[Carbon::parse($key)->format('m-d')] = $value;
                }

                $groups = Group::where( 'created_at', '>=',Carbon::parse($startdate) )
                    ->where( 'created_at', '<=',Carbon::parse($enddate) )
                    ->where('university_id',$university)
                    ->groupBy( 'date' )
                    ->orderBy( 'date' )
                    ->get( [
                        DB::raw( 'DATE( created_at ) as date' ),
                        DB::raw( 'COUNT( * ) as "count"' )
                        ] )->pluck( 'count', 'date' );

                $groups = $dates->merge( $groups );
                $group = array();

                foreach ($groups as $key => $value) {
                    
                $group[Carbon::parse($key)->format('m-d')] = $value;
                } 

                $teachers = Teacher::where( 'created_at', '>=', Carbon::parse($startdate) )
                    ->where( 'created_at', '<=', Carbon::parse($enddate) )
                    ->where('university_id', $university)
                    ->groupBy( 'date' )
                    ->orderBy( 'date' )
                    ->get( [
                        DB::raw( 'DATE( created_at ) as date' ),
                        DB::raw( 'COUNT( * ) as "count"' )
                        ] )->pluck( 'count', 'date' );

                $teachers = $dates->merge( $teachers );
                $teacher = array();

                foreach ($teachers as $key => $value) {
                    
                $teacher[Carbon::parse($key)->format('m-d')] = $value;
                }

                $courses = Course::where( 'created_at', '>=',Carbon::parse($startdate) )
                    ->where( 'created_at', '<=',Carbon::parse($enddate) )
                    ->where('university_id',$university)
                    ->groupBy( 'date' )
                    ->orderBy( 'date' )
                    ->get( [
                        DB::raw( 'DATE( created_at ) as date' ),
                        DB::raw( 'COUNT( * ) as "count"' )
                        ] )->pluck( 'count', 'date' );

                $courses = $dates->merge( $courses );
                $course = array();

                foreach ($courses as $key => $value) {
                    
                $course[Carbon::parse($key)->format('m-d')] = $value;
                }   
            
                $subjects = subject::where( 'created_at', '>=',Carbon::parse($startdate) )
                ->where( 'created_at', '<=',Carbon::parse($enddate) )
                ->where('university_id',$university)
                ->groupBy( 'date' )
                    ->orderBy( 'date' )
                    ->get( [
                        DB::raw( 'DATE( created_at ) as date' ),
                        DB::raw( 'COUNT( * ) as "count"' )
                        ] )->pluck( 'count', 'date' );

                $subjects = $dates->merge( $subjects );
                $subject = array();

                foreach ($subjects as $key => $value) {
                    
                $subject[Carbon::parse($key)->format('m-d')] = $value;
                }

                $uniname = University::find($university_id)->name;

        }//end of else condition

       // dd($leave);
            return view('layouts.activity_chart', [
                'title' => trans('general.activity'). $diff . 'روزه'. $uniname ,
                'allUniversities' => $allUniversities,
                'users' => $user,
                'teachers' => $teacher,
                'subjects' => $subject,
                'courses' => $course,
                'leaves' => $leave,
                'dropouts' => $dropout,
                'transfers' => $transfer,
                'groups' => $group,
                'dates' => $dates,
                'diff'=> $diff,
                'uniname' => $uniname,
                'university_id' => $university_id,
            ]);
    }
}
