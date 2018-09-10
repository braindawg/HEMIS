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
    public function index()
    {

        //this query returns some basic states such as total universities, departments, students count by status
        $allProvinces = Province::select('*')->get();
        $allUniversities = University::select('*')->get();
        $allDepartments = Department::select('*')->get();



        $totalStudentsByStatus = Student::select(\DB::raw('count(students.id) as students_count'),'status_id as status')
            ->groupBy('status_id')
            ->get();

        $provinces = Student::select('provinces.name as province', \DB::raw('count(students.id) as count'))
        ->leftJoin('provinces', 'provinces.id', '=', 'students.province')
        ->groupBy('provinces.name')
        ->orderBy('provinces.id', 'asc')
        ->withoutGlobalScopes()
        ->get();
        
        $universities = Student::leftJoin('universities', 'universities.id', '=', 'university_id')
            ->select('universities.name', \DB::raw('count(students.id) as count'))
            ->orderBy('universities.id', 'asc')
            ->groupBy('universities.name')
            ->with('university')
            ->withoutGlobalScopes()
            ->get();

        


        // to take the first city for province data manipulation
        $city = $allProvinces->first();

        // to take the first university for university data manipulation
        $university = $allUniversities->first();

        // this query is used to fetch the students of different cities of a specific university
        // $uniSpecStudents = \DB::select(\DB::raw("SELECT universities.name as name, count(students.id) as std_count from
        // students inner join universities on students.university_id = universities.id
        //         and students.province = (select id from provinces where name = '$city') group by universities.name"));

        // this query is used to fetch students of a specific city in all the universities

        $provinceStudentsInUnis = Student::leftJoin('universities', 'universities.id', '=', 'university_id')
            ->select('universities.name', \DB::raw('count(students.id) as std_count'))
            ->where('province', $city->id)
            ->orderBy('std_count', 'asc')
            ->groupBy('universities.name')
            ->withoutGlobalScopes()
            ->get();



        // this query is used to fetch the students of different cities of a specific university
        // $proSpecStudents = \DB::select(\DB::raw("SELECT provinces.name as name, count(students.id) std_count from students
        // inner join provinces on students.province = provinces.id and students.university_id = (select id from universities
        // where name = '$university') group by provinces.name"));

        //  This query is used to fetch data of a specific university grouped by provinces
        $uniStudentsFromProvinces = Student::leftJoin('provinces', 'provinces.id', '=', 'province')
            ->select('provinces.name', \DB::raw('count(students.id) as std_count'))
            ->where('university_id', $university->id)
            ->orderBy('std_count', 'asc')
            ->groupBy('provinces.name')
            ->withoutGlobalScopes()
            ->get();

            


        $statuses = \DB::table('student_statuses')->orderBy('id', 'desc')->get();
        $universityStatus = University::with('studentsByStatus')->get();

        //  for dumping purpose
        //  dd($university->id);

        return view('home', [
            'title' => trans('general.dashboard'),
            'statuses' => $statuses,
            'city' => $city->name,
            'provinces' => $provinces,
            'uniName' => $university->name,
            'universities' => $universities,
            'universityStatus' => $universityStatus,
            'uniSpecStudents' => $provinceStudentsInUnis,
            'proSpecStudents' => $uniStudentsFromProvinces,
            'allUniversities' => $allUniversities,
            'allDepartments' => $allDepartments,
            'allProvinces' => $allProvinces,
            'studentsByStatusCount' => $totalStudentsByStatus
        ]);
    }


    public function updateData(Request $request) {

        // Check if the request is made to fetch province specific data
        if($request->pro) {

        // this query is used to fetch students of a specific city in all the universities

            $provinceStudentsInUnis = Student::leftJoin('universities', 'universities.id', '=', 'university_id')
                ->select('universities.name', \DB::raw('count(students.id) as std_count'))
                ->where('province', $request->pro)
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