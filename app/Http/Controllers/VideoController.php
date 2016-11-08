<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Validator;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;

Use Input;
Use Session;
Use Mail;
Use Auth;

use App\Video;
use App\VideoCategory;

class VideoController extends Controller
{

    public function index(VideoCategory $c)
    {
        $cats = $c->get();
        return view('videos/index', compact('cats', 'fullPage'));
    }

    public function create(VideoCategory $c)
    {
        $cats = $c->get();
        return view('videos/create', compact('cats', 'fullPage'));
    }

}
