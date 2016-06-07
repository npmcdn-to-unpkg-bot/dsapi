<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;
use App\Models\Attachment;

class PostController extends Controller
{
    /** 
    * get list usport post
    * $offset 	Integer
    * $limit 	Integer
    * $order 	String 	(columnname)
    * $by 		String (ASC|DESC)
    * return array object
    */
    public function getList($offset = 0, $limit = 0, $order='id', $by='ASC') {
    	$query = Post::orderBy($order, $by);
    	if ($limit > 0 && $limit > $offset) {
    		$posts = $query->offset($offset)->limit($limit)->get();
    	} else {
    		$posts = $query->get();
    	}
    	if (!$posts) {
    		echo json_encode(array('error'=>1001, 'data'=>'', 'message'=>'Cannot find any post'));
    	}
        $count = $query->count();
    	echo json_encode(array('error'=>0,'count'=>$count, 'data'=>$posts, 'message'=>''));
    }

    /** 
    * get postinfo by id 
    * $postId integer postId
    * return object postinfo
    */
    public function getPostById ($postId) {
    	$post = Post::find($postId);//->tags;
    	$post->category = Post::find($postId)->category;
    	$post->tags = Post::find($postId)->tags;
    	$post->attachments = Attachment::where('post_id', $postId)->select(array('src'))->get();

    	if (!$post) {
    		echo json_encode(array('error'=>1001, 'data'=>'', 'message'=>'Cannot find post'));
    	}
    	echo json_encode(array('error'=>0, 'data'=>$post, 'message'=>''));
    }

    /** 
    * get postinfo by slug 
    * $postSlug string
    * return object
    */
    public function getPostBySlug ($postSlug) {
    	$post = Post::where('slug', $postSlug)->first();
    	if (!$post) {
    		echo json_encode(array('error'=>1001, 'data'=>'', 'message'=>'Cannot find post'));
    	}
    	echo json_encode(array('error'=>0, 'data'=>$post, 'message'=>''));
    }

    /** 
    * get list post by category id
    * $categoryId integer
    * $offset 	Integer
    * $limit 	Integer
    * $order 	String 	(columnname)
    * $by 		String (ASC|DESC)
    * return array object
    */
    public function getPostsByCategoryId ($categoryId, $offset = 0, $limit = 0, $order='id', $by='ASC') {
    	$query = Post::where('category_id', $categoryId)->orderBy($order, $by);
    	if ($limit > 0 && $limit > $offset) {
    		$posts = $query->offset($offset)->limit($limit)->get();
    	} else {
    		$posts = $query->get();
    	}
    	if (!$posts) {
    		echo json_encode(array('error'=>1001, 'data'=>'', 'message'=>'Cannot find any post'));
    	} 
        $count = $query->count();
    	echo json_encode(array('error'=>0,'count'=>$count, 'data'=>$posts, 'message'=>''));
    }
}
