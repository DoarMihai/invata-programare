<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reference extends Model
{
     protected $table = 'references';
     protected $fillable = ['parent_id', 'reference_id', 'type'];
     public $timestamps = false;

     public function articles()
     {
     	return $this->hasMany('App\Article', 'id', 'reference_id');
     }
}
