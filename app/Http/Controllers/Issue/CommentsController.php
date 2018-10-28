<?php

namespace App\Http\Controllers\Issue;
use App\Events\IssueCommentEvent;
use App\Models\Issue;
use App\Models\IssueComment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\User;

class CommentsController extends Controller
{
    public function index()
    {
        $issues= Issue::latest('created_at')->paginate(10);
        return view('issues.comments.index', [
            'title' => trans('general.issue'),
            'description' => trans('general.issue_list'),
            ],   compact('issues')
        );
    }
    public function show($issue)
    { 

        return view('issues.comments.show', [
            'title' => trans('general.issue_description'),
            'description' => trans('general.issue_comments'),
            'issue' => $issue
        ]);
    }

    public function store(Request $request){
        $message= $request->message;
        $issue_id= $request->issue;
        $user = Auth::user()->id;
        $comment = IssueComment::create ([
            'comment' => $message,
            'issue_id' => $issue_id,
            'user_id' => $user,
        ]);
        if($comment){
            $comment = IssueComment::findOrFail($comment->id);
            $user = User::find($user);
            event(new IssueCommentEvent($comment, $user));
        }
    }

    public function destroy(Request $request){
        $id = $request->get('id');
        // only super admin user can do
        $ifDelete = IssueComment::where('id',$id)->delete();
    }
}
