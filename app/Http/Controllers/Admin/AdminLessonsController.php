<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Input;
use App\Lesson;

use Auth;
use Log;

class AdminLessonsController extends AdminBase
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Lesson $lesson)
    {
        $lessons = $lesson->notDeleted()->paginate(10);
        $page = 'lessons';
        return view('admin.lessons.index', compact('lessons', 'page'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $page = 'new_lesson';
        return view('admin.lessons.create', compact('page'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Lesson $lesson)
    {

        if (Input::hasFile('picture')) {
            $file = Input::file('picture');
            $file->move(public_path() . '/uploads/lessons/pictures', $file->getClientOriginalName());
            $fileToDb = $file->getClientOriginalName();
        }else{
            $fileToDb  = '';
        }

        $lesson->create([
            'name' => Input::get('nume'),
            'slug' => createSlug(Input::get('nume')),
            'description' => Input::get('content'),
            'picture' => $fileToDb
        ]);

        return redirect()->back();
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Lesson $l, $id)
    {
        $lesson = $l->whereId($id)->first();
        $page = 'lessons';
        return view('admin.lessons.edit', compact('page', 'lesson'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Lesson $lesson, $id)
    {

        if (Input::hasFile('picture')) {
            //delete previous file
            @unlink('/uploads/lessons/pictures/'.$lesson->whereId($id)->first()->picture);
            $file = Input::file('picture');
            $file->move(public_path() . '/uploads/lessons/pictures', $file->getClientOriginalName());
            $fileToDb = $file->getClientOriginalName();
        }else{
            $fileToDb  = '';
        }

        $lesson->whereId($id)->update([
            'name' => Input::get('nume'),
            'slug' => createSlug(Input::get('nume')),
            'description' => Input::get('content'),
            'picture' => $fileToDb
        ]);

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Lesson $lesson, $id)
    {
        $lesson->whereId($id)->update(['deleted' => 1]);
    }
}
