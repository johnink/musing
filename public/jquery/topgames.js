/* + * x * + * x * + * x * + * x * + * x * + * x

The javascript to change the list of
games on the games.blade.php page.

x * + * x * + * x * + * x * + * x * + * x * + */
var token = $('#token').val();
$('#gameListChanger').on('change',function(){

	$.ajax({
		url: '/gamelist',
		type: 'post',
		data: {_method: 'post' , _token :token, modifier:$('#gameListChanger').val()},
		success: function(games){
				var $games=$('<div id="games"></div>');
				for (var i=0 ; i<games.length ; i++){
					var $game=$('<div class="game"></div>');
					var $gameName=$('<div class="gameName"><h5><a href="/game/'+ games[i]['name'] +'">' + games[i]['full_name'] + ' - </a></h5></div>');
					var $gameListIcons=$('<div class="gameListIcons"></div>');
					for(var n=0 ; n<games[i]['gametags'].length ; n++ ){
						$gameListIcons.append('<img class="gameListIcon" src="/images/icons/icons_' + games[i]['gametags'][n] + '.svg" alt="' + games[i]['gametags'][n] + ' icon" title="' + games[i]['gametags'][n] + ' icon" onerror="this.onerror=null; this.src=\'/images/icons/icons_' + games[i]['gametags'][n] + '.png\'">');
					}
					$gameName.append($gameListIcons);
					$game.append($gameName);
					$gameDesc=$('<div class="gameDesc">' + games[i]['short_desc'] + '</div>');
					$game.append($gameDesc);
					$games.append($game);
				}
				console.log(games);
				$('#gameListTitle').replaceWith('<h4 id="gameListTitle">' + games[0]['title'] + '</h4>');
				$('#games').replaceWith($games);


			}
		}).fail(function(){
			console.log("AJAX fail")
	    });







});