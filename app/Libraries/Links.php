<?php

namespace App\Libraries;

use App\Game;
use App\Article;

class Links{
	   
	//make a title of an article for a link 
	static function prettyLink($link){
		$link = str_replace('-','_',$link);
		$link = str_replace(' ','-',$link);
		$link = str_replace('?','&ques',$link);
		return $link;
	}

	//change it back
	static function unprettyLink($link){
		$link = str_replace('-',' ',$link);
		$link = str_replace('_','-',$link);
		$link = str_replace('&ques','?',$link);
		return $link;
	}

	//pull a random link
	static function randomLink(){
		$rand=rand(1,100);
		//if it's low return a game
		if($rand>0 && $rand<20){
			$link = Game::orderByRaw("RAND()")->pluck("name")->first();
			$link = "/game/" . $link;
			return $link;
		}else{
			//otherwise return an article
			$link = Article::orderByRaw("RAND()")->pluck("title")->first();
			$link = Links::prettyLink($link);
			$link = "/articles/" . $link;
			return $link;
		}

	}

}