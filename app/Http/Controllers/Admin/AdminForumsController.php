<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Input;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\forumCategories;
use App\forumThreads;
use App\forumTopics;
use App\forumPosts;

use Auth;
use Log;
use Input;


class AdminForumsController extends AdminBase
{

	public function categories(forumCategories $c)
	{
		$categories = $c->orderBy('order')->get();
		$page = 'forums';
		return view('admin.forums.categories', compact('categories', 'page'));
	}

	public function editCategory(forumCategories $c, $id)
	{
		$category = $c->where('id', '=', $id)->first();
		$page = 'forums';

		return view('admin.forums.edit_category', compact('category', 'page'));
	}

	public function postEditCategory(Request $request, forumCategories $c, $id)
	{
		//validation
	    $this->validate($request, [
	        'name' => 'required|max:255',
	        'description' => 'required',
	        'order' => 'required',
	    ]);
		//check icon and upload-it
		
		//update data
		$c->where('id', '=', $id)->update([
			'name' => Input::get('name'),
			'description' => Input::get('description'),
			'order' => Input::get('order'),
		]);
		//redirect
	}

	public function destroyCategory($id)
	{
		# code...
	}

	public function threads(forumThreads $f)
	{
		$threads = $f->get();
		$page = 'forums';
		return view('admin.forums.threads', compact('threads', 'page'));		
	}

	public function editThread($id)
	{
		# code...
	}

	public function topics()
	{
		# code...
	}

	public function editTopic($id)
	{
		# code...
	}

	public function posts()
	{
		# code...
	}

	public function editPost($id)
	{
		# code...
	}
}