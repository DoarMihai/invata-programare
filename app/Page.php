<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $table = 'pages';
	protected $fillable = ['name', 'slug', 'content', 'deleted'];
	public $timestamps = false;
}
