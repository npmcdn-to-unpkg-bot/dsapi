<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
	protected $table = 'categories';

	/* relation */
	public function posts() {
		return $this->hasMany('App\Models\Post', 'id', 'category_id');
	}
}
