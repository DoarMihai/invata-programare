<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class forumPosts extends Model {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'forum_posts';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['content', 'deleted', 'posted_by', 'topic_id'];

    public function author(){
        return $this->hasOne('App\User', 'id', 'posted_by');
    }

    public function topics()
    {
        return $this->belongsTo('App\forumTopics', 'topic_id', 'id');
    }

    public function scopeLastActivity($query, $thread){
        return $query->select('users.first_name as fname', 'users.last_name as lname', 'users.id as uid')
            ->join('forum_topics', 'forum_posts.topic_id', '=', 'forum_topics.id')
            ->join('forum_threads', 'forum_topics.thread_id', '=', 'forum_threads.id')
            ->join('users', 'forum_topics.posted_by', '=', 'users.id')
            ->where('forum_threads.id', '=', $thread);
   }

    public function scopeDisplayTopic($query, $id){
        return $query->select('users.avatar as avatar', 'users.name as uname', 'forum_posts.*', 'forum_topics.name as topic_name')
                            ->join('users', 'forum_posts.posted_by', '=', 'users.id')
                            ->join('forum_topics', 'forum_posts.topic_id', '=', 'forum_topics.id')
                            ->where('topic_id', '=', $id);
    }

    public function getContentAttribute($value){
        // BBcode array
		$find = [
		    '~\[b\](.*?)\[/b\]~s',
		    '~\[i\](.*?)\[/i\]~s',
		    '~\[u\](.*?)\[/u\]~s',
		    '~\[quote\](.*?)\[/quote\]~s',
		    '~\[size=(.*?)\](.*?)\[/size\]~s',
		    '~\[color=(.*?)\](.*?)\[/color\]~s',
		    '~\[url\]((?:ftp|https?)://.*?)\[/url\]~s',
		    '~\[img\](https?://.*?\.(?:jpg|jpeg|gif|png|bmp))\[/img\]~s'
        ];
		// HTML tags to replace BBcode
		$replace = [
    		'<strong>$1</strong>',
    		'<em>$1</em>',
    		'<span style="text-decoration:underline;">$1</span>',
    		'<pre>$1</'.'pre>',
    		'<span style="font-size:$1px;">$2</span>',
    		'<span style="color:$1;">$2</span>',
    		'<a href="$1">$1</a>',
    		'<img src="$1" alt="" />'
        ];
		// Replacing the BBcodes with corresponding HTML tags
		return preg_replace($find,$replace, $value);
        // return ['created_at'];
    }
}