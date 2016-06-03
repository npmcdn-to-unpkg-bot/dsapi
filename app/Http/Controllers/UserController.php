<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Models\User;

class UserController extends Controller
{
    //
    public function getList($offset = 0, $limit = 0, $order='id', $by='ASC') {
    	$count = User::count();
    	$query = User::orderBy($order, $by);
    	if ($limit > 0 && $limit > $offset) {
    		$users = $query->offset($offset)->limit($limit)->get();
    	} else {
    		$users = $query->get();
    	}
    	return response()->json(array('error'=>0,'count'=>$count, 'data'=>$users, 'message'=>''));
    }

    public function getUserById ($userId) {
    	$user = User::find($userId);
    	if (!$user) {
    		$user = User::where('fb_id', $userId)->first();
    	}
    	return response()->json(array('error'=>0, 'data'=>$user, 'message'=>''));
    }
}
