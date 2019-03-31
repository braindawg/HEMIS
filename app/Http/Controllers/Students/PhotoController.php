<?php

namespace App\Http\Controllers\Students;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager as Image;

class PhotoController extends Controller
{
    public function __construct()
    {        
         $this->middleware('permission:update-student-photo', ['only' => ['index', 'store']]);                 
    }

    public function index($student)
    {
        return view('students.photo', [
            'student' => $student,
            'title' => trans('general.photo')
        ]);
    }

    public function store(Request $request, $student)
    {
        $this->validate($request, [
            'photo' => 'required|image|max:512',
        ]);

        $file = $request->photo;
                
        $path = 'pictures/'.$student->form_no.'.jpg';
        
        $disk = Storage::disk('public');
            
        if ($student->photo_url) {
            Storage::delete(str_replace("/storage/","public/", $student->photo_url));
        }
   
        //default size was 300
        $disk->put(
            $path, (string) (new Image)->make($file->path())->fit(354, 472)->encode()
        );

        $student->update([
            'photo_url' => 'storage/'.$path
        ]);

        return redirect()->back()->with('success', trans('general.x_has_been_updated', ['x' => trans('general.photo')]));        
    }
}
