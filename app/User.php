<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract,
                                    AuthorizableContract,
                                    CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'email', 'password', 'class', 'points', 'rank', 'status', 'created_on', 'remember_token'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    public $timestamps = false;

    public function education()
    {
        return $this->hasMany('App\UsersEducation', 'user', 'id');
    }

    public function posts()
    {
        return $this->hasMany('App\forumPosts', 'posted_by', 'id');
    }

    public function comments()
    {
        return $this->hasMany('App\Comment', 'email', 'email');
    }

    public function portfolios()
    {
        return $this->hasMany('App\Portfolio', 'user_id', 'id');
    }

    public function contact()
    {
        return $this->hasMany('App\UsersContact', 'user_id', 'id');
    }

}
