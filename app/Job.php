<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Job extends Model {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'jobs';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'description', 'skills', 'picture', 'company_id', 'locality', 'type', 'user_id', 'career_level'];

}