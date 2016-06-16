<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;
use App\Models\Attachment;
use App\Models\User;

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
    public function getList($offset = 0, $limit = 0, $order='id', $by='DESC') {
        $query = Post::orderBy($order, $by);
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
        foreach ($posts as $p) {
            /*attachment*/
            if ($p->type != 'text') {
                $attachments = Attachment::where('post_id', $p->id)->get();
                $p->attachments = $attachments;
            }
            /*user*/
            if ($p->user_id == 0) {
                $p->display_name = "Anonymous";
                $p->avatar = '/app/images/avatar.png';
            } else {
                $user = User::find($p->user_id);
                $p->display_name = $user['display_name'];
                $p->avatar = $user['avatar'];
            }
            /*category*/
            $category = Category::find($p->category_id);
            $p->category_name = $category['name'];
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
        } elseif ($limit > 0 && $limit > $offset) {
            $posts = $query->offset($offset)->limit($limit)->get();
        } else {
            $posts = $query->get();
        }
        if (!$posts) {
            return response()->json(array('error'=>1002, 'data'=>'', 'message'=>'Cannot find any post'));
        }
        foreach ($posts as $p) {
            /*attachments*/
            if ($p->type != 'text') {
                $attachments = Attachment::where('post_id', $p->id)->get();
                $p->attachments = $attachments;
            }
            /*user*/
            if ($p->user_id == 0) {
                $p->display_name = "Anonymous";
                $p->avatar = '/app/images/avatar.png';
            } else {
                $user = User::find($p->user_id);
                $p->display_name = $user['display_name'];
                $p->avatar = $user['avatar'];
            }
            /*category*/
            $category = Category::find($p->category_id);
            $p->category_name = $category['name'];
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
    public function getHotPostsbyCategoryId($categoryId, $offset = 0, $limit = 4) {
        $query = Post::where('category_id', $categoryId)->orderBy('viewed', 'DESC');
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
        foreach ($posts as $p) {
            /*attachments*/
            if ($p->type != 'text') {
                $attachments = Attachment::where('post_id', $p->id)->get();
                $p->attachments = $attachments;
            }
            /*user*/
            if ($p->user_id == 0) {
                $p->display_name = "Anonymous";
                $p->avatar = '/app/images/avatar.png';
            } else {
                $user = User::find($p->user_id);
                $p->display_name = $user['display_name'];
                $p->avatar = $user['avatar'];
            }
            /*category*/
            $category = Category::find($p->category_id);
            $p->category_name = $category['name'];
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
    	// $post->attachments = Attachment::where('post_id', $postId)->select(array('src'))->get();
        if ($post->type != 'text') {
            $attachments = Attachment::where('post_id', $postId)->get();
            $post->attachments = $attachments;
        }
        /*user*/
        if ($post->user_id == 0) {
            $post->display_name = "Anonymous";
            $post->avatar = '/app/images/avatar.png';
        } else {
            $user = User::find($post->user_id);
            $post->display_name = $user['display_name'];
            $post->avatar = $user['avatar'];
        }
        /*category*/
        $category = Category::find($post->category_id);
        $post->category_name = $category['name']; 

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
        /*attachment*/
        if ($post->type != 'text') {
            $attachments = Attachment::where('post_id', $postId)->get();
            $post->attachments = $attachments;
        }
        /*user*/
        if ($post->user_id == 0) {
            $post->display_name = "Anonymous";
            $post->avatar = '/app/images/avatar.png';
        } else {
            $user = User::find($post->user_id);
            $post->display_name = $user['display_name'];
            $post->avatar = $user['avatar'];
        }
        /*category*/
        $category = Category::find($post->category_id);
        $post->category_name = $category['name']; 

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
        foreach ($posts as $p) {
            /*attachments*/
            if ($p->type != 'text') {
                $attachments = Attachment::where('post_id', $p->id)->get();
                $p->attachments = $attachments;
            }
            /*user*/
            if ($p->user_id == 0) {
                $p->display_name = "Anonymous";
                $p->avatar = '/app/images/avatar.png';
            } else {
                $user = User::find($p->user_id);
                $p->display_name = $user['display_name'];
            }
            /*category*/
            $category = Category::find($p->category_id);
            $p->category_name = $category['name'];
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
        $post = new Post;
        $isAnonymous = $request->get('is_anonymous', 0);
        $userId = $request->get('user_id', $isAnonymous);
        $type = $request->get('type', 'text');

        $content = $request->get('content', '');
        $categoryId = $request->get('category_id', 1);
        $attachments = $request->get('attachments', []);
        $thumb = $request->get('thumb', '');

        if ($type == 'text') {
            if ($content == '') {
                return response()->json(array('error'=>1001, 'data'=>'', 'message'=>'content cannot empty'));
            }
            $post->user_id = $userId;
            $post->content = $content;
            $post->category_id = $categoryId;
            // $post->created = date('Y-m-d h:i:s');
            // $post->updated = $post->created;
            if ($post->save()) {
                return $response->json(array('error'=>0, 'data'=>array('insert_id'=>$post->id), 'message'=>''));
            } else {
                return $response->json(array('error'=>1, 'data'=>'', 'message'=>'error insert post'));
            }

        } /*elseif ($type == 'image') {
            # code...
        } elseif ($type == 'video') {
            # code...
        }*/ else {
            return response()->json(array('error'=>1001, 'data'=>'', 'message'=>'invalid param', 'param'=>$type));
        }

        /*if ($type!='text' && $type!='image' && $type!='video' || $content=='') {
            return response()->json(array('error'=>1001, 'data'=>'', 'message'=>'invalid param', 'param'=>$type . ',' . $content));
        }
        if ($type!='text' && ($url=='' || $thumb=='')) {
            return response()->json(array('error'=>1001, 'data'=>'', 'message'=>'invalid param', 'param'=>$type . '|' . $url . '|' . $thumb));
        }*/

        
        /*insert attachment*/

        /*insert post*/

        // return $response->json(array('error'=>0, 'data'=>array('insert_id'=>4), 'message'=>''));
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
