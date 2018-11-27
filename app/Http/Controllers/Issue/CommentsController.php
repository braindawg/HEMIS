<?php

namespace App\Http\Controllers\Issue;
use App\Events\IssueNotificationEvent;
use App\Events\IssueCommentEvent;
use App\Models\Issue;
use App\Models\IssueComment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Notifications\IssueCreatedNotication;


class CommentsController extends Controller
{

    public function store(Request $request){


        \DB::transaction(function () use ($request) {

        $message= $request->message;
        $issue_id= $request->issue;
        $current_user = auth()->user()->id;

        $comment = IssueComment::create ([
            'comment' => $message,
            'issue_id' => $issue_id,
            'user_id' => $current_user,
        ]);

        if($comment){

            $current_user = User::find($current_user);
            event(new IssueCommentEvent($comment, $current_user));

            //notificaton will send to who create isssue
            $issue = Issue::findOrFail($issue_id);
            $user = $issue->user_id;
            $user = User::find($user);

            $user->notify(new IssueCreatedNotication($issue));

            $message = "به سوال شما جواب ....";
            event(new IssueNotificationEvent($issue, $current_user , $message));

        }
    });
    }

    public function destroy(Request $request){

        $id = $request->get('id');

        IssueComment::where('id',$id)->delete();

    }
}
