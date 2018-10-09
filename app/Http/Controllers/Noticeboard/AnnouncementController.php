<?php

namespace App\Http\Controllers\Noticeboard;

use App\User;
use App\Models\Announcement;
use App\Models\Attachment;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Maklad\Permission\Models\Role;
use App\Http\Controllers\Controller;
use App\DataTables\NoticeBoardDataTable;
use Maklad\Permission\Models\Permission;
use Illuminate\Support\Facades\Storage;


class AnnouncementController extends Controller
{
    public function __construct()
    {        
         $this->middleware('permission:create-announcement', ['only' => ['create','store']]);
         $this->middleware('permission:edit-announcement', ['only' => ['edit','update']]);
         $this->middleware('permission:delete-announcement', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(NoticeBoardDataTable $dataTable)
    {        
        return $dataTable->render('announcements.index', [
            'title' => trans('general.noticeboard'),
            'description' => trans('general.announcements_list')
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('announcements.create', [
            'title' => trans('general.noticeboard'),
            'description' => trans('general.create_noticeboard'),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

     public function show($announcement){
        return view('announcements.show', [
            'title' => trans('general.noticeboard_description'),],compact('announcement'));
     }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|unique:announcements|max:255',
            'body' => 'required|min:10',
        ]);
        $files =$request->file('file');
        //inserting data to Announcements table                
        $announcement = Announcement::create([
            'title' => $request->title,
            'body' => $request->body,
        ]);
        $currentID=$announcement->id;
        $ModelName = "Announcement";
        //cheacking where the input has files
        if ($request->hasFile('file'))
            { 
            //stroing all requested file
                foreach($files as $file)
                    {
                        // file store using SystemAttacheFile trait
                        $announcement->uploadFile($file,$currentID,$ModelName);
                    }
            }
        else{
            }

        return redirect(route('announcements.index'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($announcement)
    {
        return view('announcements.edit', [
            'title' => trans('general.noticeboard'),
            'description' => trans('general.edit_noticeboard'),
            'announcement' => $announcement,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $announcement)
    {
        Storage::makeDirectory('system_files');
                $filename=null;
                $filepath =null;
                $i1=1; 
                $files =$request->file('file');
                //inserting data to noticeboard table                
               $announcement->update([
                    'title' => $request->title,
                    'body' => $request->body,
                ]);
            $currentID=$announcement->id;
            $ModelName = "Announcement";
            //cheacking where the input has files
            if ($request->hasFile('file'))
                { 
                //stroing all requested file
                    foreach($files as $file)
                        {
                            // file store using trait
                            $announcement->uploadFile($file,$currentID,$ModelName);
                        }
                }
            else
                {
                }

        return redirect(route('announcements.index'))->with('message', 'اطلاعات '.$announcement->name.' موفقانه آبدیت شد.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($announcement)
    {
        \DB::transaction(function () use ($announcement){
            $model_name ="Announcement";
            $files =$announcement->getFile($announcement->id,$model_name);//getting all realated files from SystemAttacheFile Traits by passing Parrent Record Id and Model Name
            $announcement->delete();
            foreach ($files as $file)
            {
                // deleting all resourses of the object
                $announcement->deleteFile($file);
            }
        });
        return redirect(route('announcements.index'));
    }
}
