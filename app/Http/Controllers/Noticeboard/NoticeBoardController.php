<?php

namespace App\Http\Controllers\Noticeboard;

use Illuminate\Http\Request;
use App\Models\Announcement;
use App\Http\Controllers\Controller;


class NoticeBoardController extends Controller
{
    public function show()
    {   
        return view('announcements.noticeboard_list', [
            'title' => trans('general.noticeboard'),
            'announcements' => Announcement::latest('created_at')->paginate(5)
        ]);
    }
}
