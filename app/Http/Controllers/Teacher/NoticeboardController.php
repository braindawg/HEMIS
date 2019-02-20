<?php

namespace App\Http\Controllers\Teacher;

use App\Models\Announcement;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NoticeboardController extends Controller
{
    public function index()
    {   
        return view('announcements.noticeboard_list', [
            'title' => trans('general.noticeboard'),
            'announcements' => Announcement::latest('created_at')->paginate(5)
        ]);
    }

    public function show(Announcement $announcement)
    {         
        if (! $announcement->visited()) {
            $announcement->visit();
        }
        
        return view('announcements.show', [
            'title' => trans('general.noticeboard_description'),
            'announcement' => $announcement
        ]);
    }
}
