<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ArticleCategories extends Model
{
     protected $table = 'article_categories';
     protected $fillable = ['article_id', 'category_id'];
     public $timestamps = false;
}
