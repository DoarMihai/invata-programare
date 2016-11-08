<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;
use Log;
// use App\Auth;
use App\Category;
use App\Article;
use App\ArticleCategories;
use Input;
use Carbon;
// use App\Auth;
use App\User;
use App\Comment;
use App\forumPosts;

class AdminController extends AdminBase
{

    public function index(User $user, Comment $comm, Article $article, forumPosts $fp)
    {
        $users = $user->get()->count();
    	$bannedUsers = $user->where('status', '<>', 1)->get()->count();
        $comments = $comm->get()->count();

    	$commentsList = $comm->orderBy('id', 'DESC')->take(5)->get();

    	$articles = $article->get()->count();
    	$fposts = $fp->get()->count();
        $latestForumPosts = $fp->orderBy('created_at', 'DESC')->take(5)->get();

    	$latestArticles = $article->orderBy('created_on', 'desc')->take(5)->get();

    	return view('admin.index', compact('users', 'bannedUsers', 'comments', 'articles', 'latestArticles', 'fposts', 'latestForumPosts', 'commentsList'));
    }

    public function logSuspects()
    {
        # code...
    }

}
