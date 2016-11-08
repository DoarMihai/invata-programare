<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Comment;
use Input;

use Auth;
use Log;

class AdminCommentsController extends AdminBase
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Comment $com)
    {
        $comments = $com->orderBy('posted_on', 'DESC')->paginate(15);
        $page = 'comments';
        return view('admin.comments.index', compact('comments', 'page'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Comment $com, $id)
    {
        $comment = $com->whereId($id)->first();
        $page = 'comments';
        return view('admin.comments.edit', compact('comment', 'page'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Comment $com, $id)
    {
        $com->whereId($id)->update([
            'name' => Input::get('nume'),
            'email' => Input::get('email'),
            'website' => Input::get('website'),
            'content' => Input::get('content'),
        ]);
        return rediretc()->back();
    }

    public function markSpam(Comment $com, $id)
    {
        $data = $com->whereId($id)->first();

        if( $data->status == 1 ){
            //is not spam
            $com->whereId($id)->update([
                'status' => 0
            ]);
        }else{
            //is spam
            $com->whereId($id)->update([
                'status' => 1
            ]);
        }
    }

    public function destroy($id)
    {
        
    }
}
