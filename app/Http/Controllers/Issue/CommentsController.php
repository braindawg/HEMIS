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

       IssueComment::where('id',$id)->delete();

    }
}
