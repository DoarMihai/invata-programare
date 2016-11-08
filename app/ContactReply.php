<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContactReply extends Model
{
    protected $table = 'contact_reply';
	protected $fillable = ['contact_id', 'author_id', 'message'];
	public $timestamps = false;
}
