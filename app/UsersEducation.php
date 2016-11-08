<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UsersEducation extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users_education';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'started', 'ended', 'graduated', 'public', 'deleted', 'user'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    public $timestamps = false;
}
