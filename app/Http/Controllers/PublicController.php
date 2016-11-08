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
use App\Contact;
use App\Lesson;
use App\LessonArticles;
use App\ArticleCategories;
use App\View;
use App\Reference;

class PublicController extends Controller
{

    public function index(Article $article)
    {
        $articles = $article->with(['comments' => function ($q) {
            $q->where('status', '=', 1);
        }])->whereDeleted(0)->whereStatus(1)->isNotLEsson()->orderBy('created_on', 'DESC')->paginate(10);
        
        $fullPage = 0;
        return view('home/index', compact('articles', 'fullPage'));
    }

    public function category(Category $cat, Article $article, ArticleCategories $artCats, $slug)
    {
        $category = $cat->whereSlug($slug)->first();
        $articles = $article->whereIn('id', $artCats->where('category_id', '=', $category->id)->lists('article_id'))->isNotLEsson()->orderBy('created_on', 'DESC')->paginate(10);
        $fullPage = 0;
        $page = 'category';

        return view('home/category', compact('articles', 'fullPage', 'page', 'category'));
    }

    public function show(Article $article, LessonArticles $lesson, View $view, Reference $ref, $slug)
    {
        $data = $article->whereSlug($slug)->with('comments')->first();
        $references = $ref->with('articles')->where('parent_id', '=', $data->id)->where('type', '=', 1)->get();
        $fullPage = 0;

        if( $data == null ){
            return view('errors.404', compact('fullPage'));
        }

        $isArticle = 1;

        $lesson = $lesson->where('lesson_id', '=', $data->lesson)->get();
        $lessonsList = $article->whereIn('id', $article->where('lesson', '=', $data->lesson)->lists('id') )->get();

        $view->insert(['ip' => $_SERVER['REMOTE_ADDR'], 'page' => $data->id, 'date' => \Carbon\Carbon::now()]);
        return view('articles/show', compact('data', 'fullPage', 'lesson', 'references', 'isArticle', 'lessonsList'));
    }

    public function postComment(Comment $comment, $article)
    {
        if( empty(Input::get('faker')) ){

            $rules = array(
                'my_name'   => 'honeypot',
                'my_time'   => 'required|honeytime:5'
            );

            if(Input::get('email') == 'dale.gariepy@yahoo.de'){
                die();
            }

            $validator = Validator::make(Input::get(), $rules);
            if ($validator->fails()){
                return Redirect::to(URL::previous() . "#comments");
            }

            $comment->create([
                'article_id' => $article,
                'parent' => Input::get('parent'),
                'name' => Input::get('name'),
                'email' => Input::get('email'),
                'website' => Input::get('website'),
                'content' => Input::get('content'),
            ]);

            //get all emails from this article comments
            $commEmails = Comment::where('article_id', '=', $article)->get();
            $article = Article::where('id', '=', $article)->first();
            //mail them that there is a new comment
            foreach($commEmails as $mail){
            	//send mail
	             Mail::send('emails.new_comment', ['user' => Input::get('name'), 'email' => Input::get('email'), 'article' => $article], function ($m) use ($mail) {
	                $m->from('mihai@invata-programare.ro', 'Comentariu Invata-Programare');
	                $m->to($mail->email, $mail->name)->subject('Comentariu Invata-Programare!');
	            });
            }

            \Session::flash('success','Mesajul tau a fost trimis!');
            return Redirect::to(URL::previous() . "#comments");
        }
    }

    public function getContact()
    {
        $page = 'contact';
        $fullPage = 0;
        return view('pages.contact', compact('page', 'fullPage'));
    }

    public function postContact(Request $request,Contact $contact)
    {

       $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'code' => 'required',
            'subject' => 'required',
            'message' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        if( Input::get('code') == '384'){
            $contact->create([
                'name' => Input::get('name'),
                'email' => Input::get('email'),
                'subject' => Input::get('subject'),
                'message' => Input::get('message')
            ]);

            //send to admin
            Mail::send('emails.contact_admin', ['name' => Input::get('name'), 'email' => Input::get('email'), 'msg' => Input::get('message')], function ($m) {
                $m->from(Input::get('email'), Input::get('subject'));

                $m->to('mihai@invata-programare.ro', 'Stefanescu Mihai')->subject(Input::get('subject'));
            });        
            //send to admin


            return redirect()->back()->with('success', 'Mesajul tau a fost trimis!');
        }
    }

    public function search(Article $article)
    {
        $q = Input::get('term');
        $fullPage = 0;
        $query = $article->where('name', 'LIKE', "%{$q}%")
             ->orWhere('content', 'LIKE', "%{$q}%");
        $results = $query->orderBy('created_on', 'DESC')->paginate(10);

        return view('articles.search', compact('results', 'fullPage', 'q'));
    }

}
