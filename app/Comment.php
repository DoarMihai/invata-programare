<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = 'comments';
	protected $fillable = ['article_id', 'parent', 'name', 'email', 'website', 'content', 'status'];
	public $timestamps = false;

	public function article()
	{
		return $this->belongsTo('App\Article', 'article_id', 'id');
	}
}
