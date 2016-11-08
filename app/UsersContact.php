<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UsersContact extends Model
{
    protected $table = 'users_contact';
    protected $fillable = ['user_id', 'facebook', 'twitter', 'gplus', 'skype', 'linkedin'];
    public $timestamps = false;
}
