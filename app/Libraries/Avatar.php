<?php

namespace App\Libraries;

use Auth;

class Avatar{
	/**
	 * Return url for user avatar
	 *
	 * @return AvatarURL
	 */
	    
	static function getAvatarUrl(){
		if(Auth::check()){
			if(Auth::user()->avatar===""){
				return '/images/avatars/1.jpg';
			}
			elseif(Auth::user()->avatar > 0 && Auth::user()->avatar < 5){
				return '/images/avatars/' . Auth::user()->avatar . '.jpg';
			}
			else{
				$hashedEmail = md5(Auth::user()->email);
				return 'http://www.gravatar.com/avatar/' . $hashedEmail . '?size=200';
			}
		}
	}
}