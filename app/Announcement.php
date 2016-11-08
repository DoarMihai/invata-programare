<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
     protected $table = 'announcements';
     protected $fillable = ['name', 'content', 'start_date', 'end_date', 'deleted'];
     public $timestamps = false;

}
