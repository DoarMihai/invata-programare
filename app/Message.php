<?php 

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $table = 'messages';
	protected $fillable = ['subject', 'message', 'file', 'from', 'to', 'fromread', 'toread'];

}
