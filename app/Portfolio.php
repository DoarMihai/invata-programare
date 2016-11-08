<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Portfolio extends Model
{
    protected $table = 'portfolios';
	protected $fillable = ['user_id', 'order', 'name', 'description', 'skills', 'pic', 'link'];

    public function author(){
        return $this->hasOne('App\User', 'id', 'user_id');
    }
}
