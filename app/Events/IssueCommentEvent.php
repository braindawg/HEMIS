<?php

namespace App\Events;
use App\Model\IssueComment;
use App\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class IssueCommentEvent  implements ShouldBroadcast
{
    use  SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public $comment;

    public $user;
    public $date;
    public $url;
    public $adminUser = 0;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(\App\Models\IssueComment $comment, User $user)
    {
        $this->comment = $comment;
        $this->user =$user;
        $this->date = $comment->date();
        $this->url ="/getAttachment/user.png";
        if($user->hasRole('super-admin')){
        $this->adminUser = 1;
        }
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return new Channel('isssuecomment');
    }
}
