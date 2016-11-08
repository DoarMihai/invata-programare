<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Lesson;
use App\Article;
use App\LessonArticles;
use App\Reference;

class LessonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function show(Lesson $l, Article $art, LessonArticles $la, Reference $ref, $slug)
    {
        $lesson = $l->whereSlug($slug)->first();
        $fullPage = 0;
        $references = $ref->with('articles')->where('parent_id', '=', $lesson->id)->where('type', '=', 0)->get();

        if($lesson){
            $articles = $art->leftJoin('lesson_articles', 'articles.id', '=', 'lesson_articles.article_id')->where('lesson_articles.lesson_id', '=', $lesson->id)->orderBy('lesson_articles.order', 'ASC')->get();
        }else{
            abort(404);
        }

        return view('lessons.page', compact('fullPage', 'lesson', 'articles', 'references'));
    }

}
