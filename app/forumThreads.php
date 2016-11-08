<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class forumThreads extends Model {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'forum_threads';


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = ['name', 'icon', 'description', 'order', 'category', 'access_group', 'slug'];


    public function categories()
    {
        return $this->belongsTo('App\forumCategories', 'category', 'id');
    }

    public function topics()
    {
        return $this->hasMany('App\forumTopics', 'thread_id', 'id')->orderBy('sticky', 'DESC')->orderBy('created_at', 'DESC');
    }

}

