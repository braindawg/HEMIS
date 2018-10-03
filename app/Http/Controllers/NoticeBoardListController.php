<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Noticeboard;

class NoticeBoardListController extends Controller
{
    public function show()
    {
        $noticeboards=NoticeBoard::latest('created_at')->paginate(5);
        return view('noticeboards.noticeboard_list', [
            'title' => trans('general.noticeboard_list'),
        ],compact('noticeboards'));
    }
}
