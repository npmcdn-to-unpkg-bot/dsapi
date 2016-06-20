<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Redirect;
use Sentinel;
use App\Http\Requests;
use App\Services\SocialAccountService;

use Laravel\Socialite\Facades\Socialite;

class FacebookController extends Controller
{
    public function facebookLogin()
	{
	    return Socialite::with('facebook')->redirect();
	}

	public function facebookLoginCallback(SocialAccountService $service)
    {
        $user = $service->createOrGetUser(Socialite::driver('facebook')->user());

        auth()->login($user);
        
        return redirect()->to('/admin');
    }
}
