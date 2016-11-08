<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Input;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Reference;
use App\Article;
use App\Lesson;

use Auth;
use Log;

class AdminReferencesController extends AdminBase
{
   
    public function create(Article $art, Lesson $lesson)
    {   
        $articles = $art->get();
        $lessons = $lesson->get();

        $page = 'ref';
        return view('admin.references.create', compact('page', 'articles', 'lessons'));
    }

    public function store(Reference $ref)
    {
        $ref->create([
            'parent_id' => Input::get('parent'),
            'reference_id' => Input::get('reference'),
            'type' => Input::get('type'),
        ]);

        return redirect()->back();
    }
}
