<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
     protected $table = 'articles';
     protected $fillable = ['name', 'slug', 'picture', 'content', 'meta_keywords', 'meta_description', 'author', 'status', 'created_on', 'deleted', 'lesson'];
     public $timestamps = false;

     public function categories()
     {
     	return $this->belongsToMany('App\Category', 'article_categories', 'article_id', 'category_id');
     }
     public function creator()
     {
     	return $this->belongsTo('App\User', 'author', 'id');
     }
     public function comments()
     {
          return $this->hasMany('App\Comment', 'article_id', 'id');
     }
     public function scopeIsNotLesson($query)
     {
          return  $query->whereLesson(0);
     }
     public function scopeNotDeleted($query)
     {
          return $query->where('deleted', '=', 0);
     }
}
