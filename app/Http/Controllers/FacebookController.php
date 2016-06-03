<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Laravel\Socialite\Facades\Socialite;

class FacebookController extends Controller
{
    public function facebook()
	{
	    return Socialite::with('facebook')->redirect();
	}

	public function callback()
	{
	    $user = Socialite::with('facebook')->user();
	    return "<h2>" . $user->getName() . "</h2> <img src='" . $user->getAvatar() . "' /> <p>" . $user->token . "</p>";
	}
}
