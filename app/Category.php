<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
     protected $table = 'categories';
     protected $fillable = ['name', 'slug', 'picture', 'content', 'parent', 'deleted'];
     public $timestamps = false;


     public function childs()
     {
     	return $this->hasMany('App\Category', 'parent', 'id');
     }

     public function posts()
     {
     	return $this->belongsToMany('App\Article', 'article_categories', 'category_id', 'article_id');
     }
}
