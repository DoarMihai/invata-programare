<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class PointsLog extends Model {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'points_log';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id', 'points', 'reason'];

}