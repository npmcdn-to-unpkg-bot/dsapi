<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Models\User;

class UserController extends Controller
{
    /** 
    * get list usport user
    * $offset
    * $limit
    * $order
    * $by
    * return array object
    */
    public function getList($offset = 0, $limit = 0, $order='id', $by='ASC') {
    	$count = User::count();
    	$query = User::orderBy($order, $by);
    	if ($limit > 0 && $limit > $offset) {
    		$users = $query->offset($offset)->limit($limit)->get();
    	} else {
    		$users = $query->get();
    	}
    	echo json_encode(array('error'=>0,'count'=>$count, 'data'=>$users, 'message'=>''));
    }

    /** 
    * get userinfo by id 
    * $userId integer usportId or facebookId
    * return userinfo
    */
    public function getUserById ($userId) {
    	$user = User::find($userId);
    	if (!$user) {
    		$user = User::where('fb_id', $userId)->first();
    	}
    	echo json_encode(array('error'=>0, 'data'=>$user, 'message'=>''));
    }
}
