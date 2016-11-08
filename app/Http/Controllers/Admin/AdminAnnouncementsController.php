<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Input;
use Auth;
use Log;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Announcement;


class AdminAnnouncementsController extends AdminBase
{

    public function index(Announcement $ann)
    {
        $anouncements = $ann->where('deleted', 0)->get();
        $page = 'announcements';
        return view('admin.announcements.index', compact('anouncements', 'page'));
    }

    public function getEdit(Announcement $ann, $id)
    {
        $data = $ann->whereId($id)->first();
        $page = 'announcements';
        return view('admin.announcements.edit', compact('data', 'page'));
    }

    public function postEdit(Announcement $ann, $id)
    {
        $ann->whereId($id)->update([
            'name' => Input::get('name'),
            'content' => Input::get('content'),
            'start_date' => Input::get('startDate'),
            'start_date' => Input::get('endDate')
        ]);

        return redirect()->route('admin.announcements');
    }

    public function delete(Announcement $ann, $id)
    {
        $ann->whereId($id)->update(['deleted' => 1]);
        return redirect()->back();
    }

    public function create()
    {
        $page = 'announcements';
        return view('admin.announcements.create', compact('page'));
    }

    public function store(Announcement $ann)
    {
        $ann->create([
            'name' => Input::get('name'),
            'content' => Input::get('content'),
            'start_date' => Input::get('startDate'),
            'start_date' => Input::get('endDate')
        ]);

        return redirect()->route('admin.announcements');
    }
}
