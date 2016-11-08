<?php 

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserBan extends Model
{

	protected $table = 'user_ban';
	protected $fillable = ['user_id', 'email', 'user_ip'];

}


?>