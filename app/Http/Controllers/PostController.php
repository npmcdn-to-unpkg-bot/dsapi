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
    * $offset   Integer
    * $limit    Integer
    * $order    String  (columnname)
    * $by       String (ASC|DESC)
    * return array object
    */
    public function getList($offset = 0, $limit = 0, $order='id', $by='ASC') {
        $query = Post::orderBy($order, $by);
        if ($limit < $offset) {
            return response()->json(array('error'=>1001, 'data'=>'', 'message'=>'Param invalid'));
        } elseif ($limit > 0) {
            $posts = $query->offset($offset)->limit($limit)->get();
        } else {
            $posts = $query->get();
        }
        if (!$posts) {
            return response()->json(array('error'=>1002, 'data'=>'', 'message'=>'Cannot find any post'));
        }
        foreach ($posts as $p) {
            $attachments = Attachment::where('post_id', $p->id)->get();
            $p->attachments = $attachments;
        }
        $count = $query->count();
        return response()->json(array('error'=>0,'count'=>$count, 'data'=>$posts, 'message'=>''));
    }
    /** 
    * get list usport post
    * $offset   Integer
    * $limit    Integer
    * $order    String  (columnname)
    * $by       String (ASC|DESC)
    * return array object
    */
    public function getHotPosts($offset = 0, $limit = 4) {
        $query = Post::orderBy('viewed', 'DESC');
        if ($limit < $offset) {
            return response()->json(array('error'=>1001, 'data'=>'', 'message'=>'Param invalid'));
        } elseif ($limit > 0) {
            $posts = $query->offset($offset)->limit($limit)->get();
        } else {
            $posts = $query->get();
        }
        if (!$posts) {
            return response()->json(array('error'=>1002, 'data'=>'', 'message'=>'Cannot find any post'));
        }
        foreach ($posts as $p) {
            $attachments = Attachment::where('post_id', $p->id)->get();
            $p->attachments = $attachments;
        }
        $count = $query->count();
        return response()->json(array('error'=>0,'count'=>$count, 'data'=>$posts, 'message'=>''));
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
    		return response()->json(array('error'=>1002, 'data'=>'', 'message'=>'Cannot find post'));
    	}
    	return response()->json(array('error'=>0, 'data'=>$post, 'message'=>''));
    }

    /** 
    * get postinfo by slug 
    * $postSlug string
    * return object
    */
    public function getPostBySlug ($postSlug) {
    	$post = Post::where('slug', $postSlug)->first();
    	if (!$post) {
    		return response()->json(array('error'=>1002, 'data'=>'', 'message'=>'Cannot find post'));
    	}
    	return response()->json(array('error'=>0, 'data'=>$post, 'message'=>''));
    }

    /** 
    * get list post by category id
    * $categoryId integer
    * $offset   Integer
    * $limit    Integer
    * $order    String  (columnname)
    * $by       String (ASC|DESC)
    * return array object
    */
    public function getPostsByCategoryId ($categoryId, $offset = 0, $limit = 0, $order='id', $by='ASC') {
        $query = Post::where('category_id', $categoryId)->orderBy($order, $by);
        if ($limit < $offset) {
            return response()->json(array('error'=>1001, 'data'=>'', 'message'=>'Param invalid'));
        } elseif ($limit > 0 && $limit > $offset) {
            $posts = $query->offset($offset)->limit($limit)->get();
        } else {
            $posts = $query->get();
        }
        if (!$posts) {
            return response()->json(array('error'=>1002, 'data'=>'', 'message'=>'Cannot find any post'));
        } 
        $count = $query->count();
        return response()->json(array('error'=>0,'count'=>$count, 'data'=>$posts, 'message'=>''));
    }

    /** 
    * get list post by category id
    * $categoryId integer
    * $offset   Integer
    * $limit    Integer
    * $order    String (columnname)
    * $by       String (ASC|DESC)
    * return array object
    */
    public function getPostsByCategorySlug ($categorySlug, $offset = 0, $limit = 0, $order='id', $by='ASC') {
        $category = Category::where('slug', $categorySlug)->first();
        return $this->getPostsByCategoryId ($category->id, $offset, $limit, $order, $by);
    }

    /* POST API */

    /**
     * @param  string
     * @param  string
     * @param  string
     * @param  string
     * @return json
     */
    public function createPost(Request $request) {
        /*if ($type!='text' || $type!='image' || $type!='video' || $content=='') {
            return response()->json(array('error'=>1001, 'data'=>'', 'message'=>' invalid param'));
        }

        if ($type!='text' && ($url=='' || $thumb=='')) {
            return response()->json(array('error'=>1001, 'data'=>'', 'message'=>' invalid param'));
        }*/
        return $request->all();

        return $response->json(array('error'=>0, 'data'=>array('insert_id'=>4), 'message'=>''));
    }

    /**
     * @param  integer $userId
     * @param  integer $postId
     * @return json
     */
    public function liked($userId, $postId) {
        /*update record table post_liked*/

        /*update number liked in table post*/

    }
}
