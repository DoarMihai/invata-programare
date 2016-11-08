<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    protected $table = 'lessons';
	protected $fillable = ['name', 'slug', 'description', 'picture', 'deleted'];
	public $timestamps = false;

	public function scopeNotDeleted($query)
	{
		return $query->where('deleted', '=', 0);
	}
}
