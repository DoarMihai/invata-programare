<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LoginTrack extends Model
{
    protected $table = 'login_track';
	protected $fillable = ['user_id', 'browser', 'os', 'ip', 'json_data', 'acc_type'];
	public $timestamps = false;
}
