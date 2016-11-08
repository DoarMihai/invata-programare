<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class forumTopics extends Model {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'forum_topics';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'slug', 'description', 'posted_by', 'thread_id', 'deleted', 'sticky'];

    public function thread()
    {
        return $this->belongsTo('App\forumThreads', 'topic_id', 'id');
    }

    public function posts()
    {
        return $this->hasMany('App\forumPosts', 'topic_id', 'id');
    }

    public function getOptionsPaginatedAttribute()
    {
        return $this->posts()->paginate(10);
    }    
}

