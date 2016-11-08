<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class View extends Model
{
     protected $table = 'views';
     protected $fillable = ['ip', 'page', 'date'];
     public $timestamps = false;
}
