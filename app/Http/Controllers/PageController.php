<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Page;

class PageController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Page $p, $slug)
    {
        $pageData = $p->where('slug', '=', $slug)->first();
        $fullPage = 0;
        return view('pages.page', compact('pageData', 'fullPage'));
    }

}
