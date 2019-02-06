<?php

namespace App\Http\Controllers\Teacher;

use App\Models\Announcement;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function __invoke()
    {  
        return view('announcements.noticeboard_list', [
            'title' => trans('general.noticeboard'),
            'announcements' => Announcement::latest('created_at')->paginate(5)
        ]);
    }
}
