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
use App\forumCategories;
use App\forumThreads;
use App\forumTopics;
use App\forumPosts;

class ForumController extends Controller
{

	public function categories(forumCategories $category) {
        $categories = $category->with('threads', 'threads.topics.posts')->orderBy('order')->get();
        $page = 'forum';

        return view('forum.index', compact('categories', 'page'));
    }

    public function showThread(forumThreads $threads, $slug){
        $thread = $threads->whereSlug($slug)->with('topics')->first();
        $page = 'forum';

        return view('forum.thread', compact('thread', 'page'));
    }

    public function showTopic(forumTopics $topics, forumPosts $post, $slug)
    {
        $topic = $topics->with('posts')->whereSlug($slug)->first();
        $posts = $topic->posts()->where('deleted', '=', 0)->orderBy('created_at', 'asc')->paginate(10);
        $page = 'forum';

        $replyTo = $post->whereId(Input::get('post'))->first();

        return view('forum.topic', compact('topic', 'page', 'posts', 'replyTo'));
    }

    public function postReply(forumTopics $topics, forumPosts $posts, $slug)
    {
    	$topic = $topics->whereSlug($slug)->first();

        $clean = preg_replace('#script(.*?)/script#is', '', htmlentities(Input::get('content'), ENT_QUOTES | ENT_HTML5, 'UTF-8'));

        $posts->whereTopicId($topic->id)->insert([
            // 'content' => htmlentities(Input::get('content'), ENT_QUOTES | ENT_HTML5, 'UTF-8'),
            'content' => $clean,
            'posted_by' => Auth::user()->id,
            'topic_id' => $topic->id
        ]);

        givePoints(Auth::user()->id, 1, 'Forum reply: '.route('forum.topic.index', $slug));

    	return redirect()->route('forum.topic.index', $slug);
    }

    public function getCreateTopic($thread = null)
    {
    	return view('forum.new_topic', compact('thread'));
    }

    public function postCreateTopic(forumTopics $topics, forumPosts $posts, $thread)
    {

        $cleanName = preg_replace('#script(.*?)/script#is', '', htmlentities(Input::get('name'), ENT_QUOTES | ENT_HTML5, 'UTF-8'));
        $cleanDesc = preg_replace('#script(.*?)/script#is', '', htmlentities(Input::get('description'), ENT_QUOTES | ENT_HTML5, 'UTF-8'));
        $cleanPost = preg_replace('#script(.*?)/script#is', '', htmlentities(Input::get('content'), ENT_QUOTES | ENT_HTML5, 'UTF-8'));

    	# create topic
        $t = $topics->create([
            // 'name' => Input::get('name'),
            // 'description' => Input::get('description'),
            'name' => $cleanName,
            'slug' => createSlug($cleanName),
            'description' => $cleanDesc,
            'posted_by' => Auth::user()->id,
            'thread_id' => $thread
        ]);
    	# create post
        $posts->insert([
            // 'content' => Input::get('content'),
            'content' => $cleanPost,
            'posted_by' => Auth::user()->id,
            'topic_id' => $t->id
        ]);

        givePoints(Auth::user()->id, 1, 'Forum topic created: '.route('forum.topic.index', createSlug(Input::get('name'))));

        return redirect()->route('forum.topic.index', createSlug(Input::get('name')));
    }

    public function getCreateThread($cat = null)
    {
        return view('forum.new_thread', compact('cat'));
    }

    public function postCreateThread(forumThreads $thread, $cat)
    {
        //upload icon
        if (Input::hasFile('icon')) {
            $fileToDb = uploadFile(Input::hasFile('icon'), '/uploads/forums/threads');
        }else{
            $fileToDb = '';
        }

        $thread->create([
            'name' => $this->cleanData(Input::get('name')),
            'slug' => createSlug($this->cleanData(Input::get('name'))),
            'icon' => $fileToDb,
            'description' => $this->cleanData(Input::get('description')),
            // 'order' => $order,
            'category'=> $cat,
            'posted_by' => Auth::user()->id
        ]);

        givePoints(Auth::user()->id, 1, 'Forum thread created: '.route('forum.thread.index', createSlug(Input::get('name'))));

        return redirect()->route('forum.thread.index', createSlug(Input::get('name')));

    }

    public function topicStatus(forumTopics $t, $id)
    {
        if(Auth::user()->class > 8){
            $topic = $t->where('id', $id)->first();
            if($topic->closed){
                //open it
                $t->where('id', $id)->update(['closed' => 0]);
            }else{
                //close it
                $t->where('id', $id)->update(['closed' => 1]);
            }
            return redirect()->back();
        }
    }

    public function deletePost(forumPosts $p, $id)
    {
        if(Auth::user()->class > 3){
            $p->where('id', $id)->update(['deleted' => 1]);
            return redirect()->back();
        }
    }

    public function getEditPost($slug, $id)
    {
        $data = forumPosts::where('id', '=', $id)->first();
        return view('forum.edit_post', compact('data', 'slug'));
    }

    public function postEditPost(forumPosts $p, $slug, $id)
    {
        $p->where('id', '=', $id)->update(['content' => Input::get('content')]);
        return redirect()->route('forum.topic.index', $slug);
    }

    private function cleanData($data)
    {
        // $clean = preg_replace('#script(.*?)/script#is', '', htmlentities($data, ENT_QUOTES | ENT_HTML5, 'UTF-8'));


        return  preg_replace('#script(.*?)/script#is', '', htmlentities($data, ENT_QUOTES | ENT_HTML5, 'UTF-8'));
    }

}