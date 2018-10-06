<?php

namespace App\Http\Controllers;

use App\User;
use App\Models\NoticeBoard;
use App\Models\SystemFile;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Maklad\Permission\Models\Role;
use App\DataTables\NoticeBoardDataTable;
use Maklad\Permission\Models\Permission;
use Illuminate\Support\Facades\Storage;


class NoticeBoardController extends Controller
{
    public function __construct()
    {        
        //  $this->middleware('permission:view-teacher', ['only' => ['index', 'show']]);
        //  $this->middleware('permission:create-teacher', ['only' => ['create','store']]);
        //  $this->middleware('permission:edit-teacher', ['only' => ['edit','update']]);
        //  $this->middleware('permission:delete-teacher', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(NoticeBoardDataTable $dataTable)
    {        
        return $dataTable->render('noticeboards.index', [
            'title' => trans('general.noticeboard'),
            'description' => trans('general.noticeboard_list')
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('noticeboards.create', [
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

     public function show($noticeboard){
        return view('noticeboards.show', [
            'title' => trans('general.noticeboard_description'),],compact('noticeboard'));
     }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|unique:notice_boards|max:255',
            'body' => 'required|min:10',
        ]);
        Storage::makeDirectory('system_files');
                $files =$request->file('file');
                //inserting data to noticeboard table                
        $noticeboard = NoticeBoard::create([
            'title' => $request->title,
            'body' => $request->body,
        ]);
        $currentID=$noticeboard->id;
        $ModelName = "NoticeBoard";
        //cheacking where the input has files
        if ($request->hasFile('file'))
            { 
            //stroing all requested file
                foreach($files as $file)
                    {
                        // file store using SystemAttacheFile trait
                        $noticeboard->uploadFile($file,$currentID,$ModelName);
                    }
            }
        else
            {
            }

        return redirect(route('noticeboards.index'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($noticeboard)
    {
        return view('noticeboards.edit', [
            'title' => trans('general.noticeboard'),
            'description' => trans('general.edit_noticeboard'),
            'noticeboard' => $noticeboard,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $noticeboard)
    {
        Storage::makeDirectory('system_files');
                $filename=null;
                $filepath =null;
                $i1=1; 
                $files =$request->file('file');
                //inserting data to noticeboard table                
               $noticeboard->update([
                    'title' => $request->title,
                    'body' => $request->body,
                ]);
            $currentID=$noticeboard->id;
            $ModelName = "NoticeBoard";
            //cheacking where the input has files
            if ($request->hasFile('file'))
                { 
                //stroing all requested file
                    foreach($files as $file)
                        {
                            // file store using trait
                            $noticeboard->uploadFile($file,$currentID,$ModelName);
                        }
                }
            else
                {
                }

        return redirect(route('noticeboards.index'))->with('message', 'اطلاعات '.$noticeboard->name.' موفقانه آبدیت شد.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($noticeboard)
    {
        \DB::transaction(function () use ($noticeboard){
            $model_name ="NoticeBoard";
            $files =$noticeboard->getFile($noticeboard->id,$model_name);//getting all realated files from SystemAttacheFile Traits by passing Parrent Record Id and Model Name
            $noticeboard->delete();
            foreach ($files as $file)
            {
                // deleting all resourses of the object
                $noticeboard->deleteFile($file);
            }
        });
        return redirect(route('noticeboards.index'));
    }
}
