<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LessonArticles extends Model
{
    protected $table = 'lesson_articles';
	protected $fillable = ['lesson_id', 'article_id', 'order', 'section'];
	public $timestamps = false;
}
