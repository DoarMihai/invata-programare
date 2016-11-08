<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class forumCategories extends Model {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'forum_categories';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'icon', 'description', 'order', 'slug'];

    public function threads()
    {
        return $this->hasMany('App\forumThreads', 'category', 'id');
    }

}

