<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
	/* relation */
    public function tags() {
        return $this->belongsToMany('App\Models\Tag', 'post_tags')->select(array('name'));
    }

    public function category() {
        return $this->hasMany('App\Models\Category', 'id', 'category_id');
    }

    public function attachments() {
    	return $this->hasMany('App\Models\Attachment', 'post_id', 'id');
    }

}
