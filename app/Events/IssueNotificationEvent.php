<?php

namespace App\Events;
use App\Model\Issue;
use App\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Carbon\Carbon;

class IssueNotificationEvent  implements ShouldBroadcast
{
    use  SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public $issue;
    public $user;
    public $date;
    public $url;
    public $title;
    public $message;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(\App\Models\Issue $issue, User $user, $message)
    {
        $this->issue = $issue;
        $this->user =$user;

        Carbon::setLocale('fa');
        $this->date = Carbon::parse(Carbon::now())->diffForHumans();

        $this->url = route('issues.show', $issue->id);
        $this->title = str_limit($issue->title, 30,'...'); 
        $this->message = $message;
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return new Channel('isssuecreated');
    }
}
