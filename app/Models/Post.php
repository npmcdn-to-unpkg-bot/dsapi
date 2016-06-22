<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Post extends Model
{
    use Sluggable;

    public $table = 'posts';
    protected $fillable = ['title', 'content', 'is_published'];

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

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
