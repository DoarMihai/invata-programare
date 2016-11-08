<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Page;
use Auth;
use Log;

class AdminPagesController extends AdminBase
{

   
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Page $page)
    {
        $pages = $page->where('deleted', '=', 0)->paginate(10);
        $page = 'pages';
        return view('admin.pages.index', compact('pages', 'page'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $page = 'new_page';
        return view('admin.pages.create', compact('page'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Page $page)
    {
        $page->create([
            'name' => $request->input('name'),
            'slug' => createSlug($request->input('name')),
            'content' => $request->input('content')
        ]);

        return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Page $page, $id)
    {
        $pageData = $page->whereId($id)->first();
        $page = 'pages';
        return view('admin.pages.edit', compact('pageData', 'page'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Page $page, $id)
    {
        $page->where('id', '=', $id)->update([
            'name' => $request->input('name'),
            'slug' => createSlug($request->input('name')),
            'content' => $request->input('content')
        ]);

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Page $page, $id)
    {
        $page->whereId($id)->update(['deleted' => 1]);
    }
}
