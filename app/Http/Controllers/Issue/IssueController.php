<?php

namespace App\Http\Controllers\Issue;

use App\User;
use App\Models\Issue;
use App\Events\IssueNotificationEvent;
use App\Models\Attachment;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Maklad\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Maklad\Permission\Models\Permission;
use App\Notifications\IssueCreatedNotication;

class IssueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('issues.index', [
            'title' => trans('general.issue'),
            'description' => trans('general.issue_list'),
            'issues' => Issue::latest('created_at')->paginate(10)
        ]);
    }


    public function create()
    {
        return view('issues.create', [
            'title' => trans('general.issue'),
            'description' => trans('general.create_issue'),
        ]);
    }


    public function show($issue)
    {
        return view('issues.show', [
            'title' => trans('general.issue_description'),
            'issue' => $issue
        ]);
    }


    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'body' => 'required|min:10',
            'file.*' => 'mimes:jpeg,png,bmp,jpg:max:10000',
        ]);


        \DB::transaction(function () use ($request) {
            
        $files = $request->file('file');
        $user_id = auth()->user()->id;

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

        //notificaton will send to Admin users

        $users = User::where('university_id', -1)->get();

        foreach($users as $user){

            $user->notify(new IssueCreatedNotication($issue));
        }

        // issue will fire through an event

        $user = User::find(auth()->user()->id);

        $message = "سوال جدید را اضافه...";
        event(new IssueNotificationEvent($issue, $user, $message));

    });


        return redirect(route('issues.index'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($issue){

        if(auth()->user()->id == $issue->user_id) {

            return view('issues.edit', [
                'title' => trans('general.issue'),
                'description' => trans('general.edit_issue'),
                'issue' => $issue,
            ]);

        }else {

            \App::abort(503);
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
        $user_id = auth()->user()->id;

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
