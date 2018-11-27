<?php

namespace App\Http\Controllers\Issue;
use App\Events\IssueNotificationEvent;
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
        $user = auth()->user()->id;

        $comment = IssueComment::create ([
            'comment' => $message,
            'issue_id' => $issue_id,
            'user_id' => $user,
        ]);

        if($comment){

            //notificaton will send to who create isssue

            $issue = Issue::findOrFail($issue_id);
            $user = User::find($user);

            $user->notify(new IssueCreatedNotication($issue));

            $message = "به سوال شما جواب ....";
            event(new IssueNotificationEvent($issue, $user , $message));

        }
    });
    }

    public function destroy(Request $request){

        $id = $request->get('id');

        IssueComment::where('id',$id)->delete();

    }
}
