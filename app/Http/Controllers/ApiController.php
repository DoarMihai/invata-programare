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

use App\Article;
use App\Category;
use App\Comment;

// NOT READY YET

class ApiController extends Controller
{

	public function index(Article $art) {
        echo "asd";
        return 1;
    }

}