<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Category;
use App\Article;
use App\ArticleCategories;
use Input;
// use App\Auth;
use App\Lesson;
use App\LessonArticles;
use Carbon;

use Auth;
use Log;

class AdminArticlesController extends AdminBase
{

    public function index(Article $article, Category $cat)
    {
    	$page = 'articles';   	
    	$categories = $cat->get();
    	$art = $article->notDeleted();
    	
    	if( Input::get('status') !== null ){
    		$art->where('status', '=', Input::get('status'));
    	}

    	if( Input::get('category') !== null ){
    		$c = Input::get('category');
    		$art->whereHas('categories', function($q) use ($c){
    			$q->where('id', $c);
    		});
    	}

    	if( Input::get('lesson') !== null && Input::get('lesson') ){
    		if( Input::get('lesson') == 1){
    			//is lesson
    			$art->where('lesson', '<>', 0);
    		}else{
    			$art->where('lesson', '=', 0);
    			//not lesosn
    		}
    	}

    	$articles = $art->with('categories')->orderBy('created_on', 'DESC')->paginate(15);

    	return view('admin.articles.index', compact('articles', 'page', 'categories'));
    	
    }

    public function createArticle(Category $cat, Lesson $lesson)
    {
    	$page = 'new_article';
    	$categories = $cat->get();
    	$lessons = $lesson->get();
    	return view('admin.articles.create', compact('categories', 'page', 'lessons'));
    }

    public function postArticle(Article $article, LessonArticles $lessonArticles)
    {
		if (Input::hasFile('thumbnail')) {
			$file = Input::file('thumbnail');
			$file->move(public_path() . '/uploads/thumbnails', $file->getClientOriginalName());
			$fileToDb = $file->getClientOriginalName();
		}else{
			$fileToDb  = '';
		}		

		$data = $article->create([
			'name' => Input::get('title'),
			'slug' => createSlug(Input::get('slug')),
			'meta_keywords' => Input::get('meta_keywords'),
			'meta_description' => Input::get('meta_description'),
			'picture' => $fileToDb,
			'content' => Input::get('content'),
			// 'author' => Auth::user()->id,
			'status' => Input::get('status'),
			'lesson' => Input::get('lesson') !== null ? Input::get('lesson') : 0,
			'created_on' => !empty(Input::get('datepicker')) ? Carbon::createFromFormat('m/d/Y', Input::get('datepicker')) : Carbon::now()
		]);

		if( Input::get('lesson') !== null ){
			$lessonArticles->create([
				'lesson_id' => Input::get('lesson'),
				'article_id' => $data->id,
				'order' => Input::get('order'),
				'section' => Input::get('section')
			]);
		}

		//Input::get('category') is an array, so make an foreach and insert them one by one
		foreach(Input::get('category') as $cat){
			ArticleCategories::create([
				'category_id' => $cat,
				'article_id' => $data->id
			]);
		}	
		//redirect to edit
		return redirect()->route('admin.edit.article', $data->id);
    }

	public function editArticle(Category $cat, Article $article, ArticleCategories $artCat, $id)
	{
		$page = 'edit_article';
		$data = $article->find($id);
		$categories = $cat->get();
		$selectedCat = $artCat->where('article_id', '=', $id)->first();

		return view('admin.articles.edit', compact('data', 'categories', 'page', 'selectedCat'));
	}

	public function postEditArticle(Article $article, $id)
	{
		$data = $article->find($id);

		if (Input::hasFile('thumbnail')) {
			@unlink('/uploads/thumbnails'.$data->picture);
			//delete old thumb
			$file = Input::file('thumbnail');
			$file->move(public_path() . '/uploads/thumbnails', $file->getClientOriginalName());
			$fileToDb = $file->getClientOriginalName();
		}else{
			$fileToDb  = $data->picture;
		}

		$data = $article->where('id', '=', $id)->update([
			'name' => Input::get('title'),
			'slug' => createSlug(Input::get('title')),
			'meta_keywords' => Input::get('meta_keywords'),
			'meta_description' => Input::get('meta_description'),
			'picture' => $fileToDb,
			'content' => Input::get('content'),
			// 'author' => Auth::user()->id,
			'status' => Input::get('status')
			// 'created_on' => Input::get('datepicker') !== null ? strtotime(Input::get('datepicker')) : time()
		]);

		//delete all categories for this article

		ArticleCategories::where('article_id', '=', $id)->delete();

		foreach(Input::get('category') as $cat){
			ArticleCategories::create([
				'category_id' => $cat,
				'article_id' => $id
			]);
		}			
		return redirect()->route('admin.edit.article', $id);
	}

	public function delete(Article $article, $id)
	{
		$article->where('id', '=', $id)->update(['deleted' => 1]);
	}

	public function upload()
	{
			$file = Input::file('thumbnail');
			$file->move(public_path() . '/uploads/thumbnails', $file->getClientOriginalName());
			$fileToDb = $file->getClientOriginalName();
	}

	public function uploadImage(Request $request)
	{

		$file = Input::file('upload');
		$file->move(public_path() . '/uploads/posts', $file->getClientOriginalName());

	}	

	public function categories(Category $cats)
	{
		$categories = $cats->with('childs')->where('parent', 0)->where('deleted', 0)->get();
		// dd($categories->toArray());
		return view('admin.articles.categories', compact('categories'));
	}

	public function postCategory(Category $cats)
	{

		if (Input::hasFile('icon')) {
			$file = Input::file('icon');
			$file->move(public_path() . '/uploads/categories', $file->getClientOriginalName());
			$fileToDb = $file->getClientOriginalName();
		}else{
			$fileToDb  = '';
		}	

		$cats->create([
			'name' => Input::get('name'),
			'slug' => createSlug(Input::get('slug')),
			'content' => Input::get('description'),
			'picture' => $fileToDb,
			'parent' => Input::get('parent')
		]);
		return redirect()->back();
	}

	public function deleteCategory(Category $cat, $id)
	{
		$cat->whereId($id)->update(['deleted' => 1]);
		return redirect()->back();

	}

}
