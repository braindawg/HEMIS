<?php

namespace App\Http\Controllers\Issue;

use App\User;
use App\Models\Issue;
use App\Models\Attachment;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Maklad\Permission\Models\Role;
use App\Http\Controllers\Controller;
use App\DataTables\IssueDataTable;
use Maklad\Permission\Models\Permission;
use Illuminate\Support\Facades\Storage;
use Auth;
use App;


class IssueController extends Controller
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
    public function index(IssueDataTable $dataTable)
    {
        $issues = Issue::latest('created_at')->paginate(10);
        return $dataTable->render('issues.index', [
            'title' => trans('general.issue'),
            'description' => trans('general.issue_list'),
            ], compact('issues'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('issues.create', [
            'title' => trans('general.issue'),
            'description' => trans('general.create_issue'),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

     public function show($issue){
        return view('issues.show', [
            'title' => trans('general.issue_description'),],compact('issue'));
     }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'body' => 'required|min:10',
            'file.*' => 'mimes:jpeg,png,bmp,jpg:max:10000',
        ]);

        $files = $request->file('file');
        $user_id = Auth::user()->id;

        $issue = Issue::create([
            'title' => $request->title,
            'body' => $request->body,
            'user_id' => $user_id,
        ]);

        if ($request->hasFile('file')) {

            foreach($files as $file) {
                $issue->uploadFile($file);
            }
        }

        return redirect(route('issues.index'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($issue){

        if(Auth::user()->id == $issue->user_id) {

            return view('issues.edit', [
                'title' => trans('general.issue'),
                'description' => trans('general.edit_issue'),
                'issue' => $issue,
            ]);

        }else {
            App::abort(503);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $issue)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'body' => 'required|min:10',
            'file.*' => 'mimes:jpeg,png,bmp,jpg:max:10000',
        ]);

        $files = $request->file('file');
        $user_id = Auth::user()->id;

        $issue->update([
            'title' => $request->title,
            'body' => $request->body,
            'user_id' => $user_id,
        ]);

            if ($request->hasFile('file')) {

                foreach($files as $file) {
                    $issue->uploadFile($file);
                }
            }

        return redirect(route('issues.index'))->with('message', 'اطلاعات '.$issue->name.' موفقانه آبدیت شد.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($issue)
    {
        \DB::transaction(function () use ($issue){

            $files =$issue->attachments();

            $issue->delete();

            foreach ($files as $file)
            {
                $issue->deleteFile($file);
            }
        });

        return redirect(route('issues.index'));
    }
}
