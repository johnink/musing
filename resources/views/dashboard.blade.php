@extends('layouts.main')

@section('title')
Omusing! Ideas to find ideas
@stop

@section('description')
A website dedicated to helping you find ideas. Good for writing, drawing, blogging, social media, music composition and more. Providing tools and games to help you explore your mind and see what you find.
@stop

@section('keywords')
ideas, self improvement, play, creative, writing, drawing, blogging, social media, music composition
@stop




@section('scripts')


	<?php 


		//This will add only the javascripts for the users widgets
		//Temporarily disabled to fix a bug.

		if(false/*Auth::user()*/){
			$scripts=$widgets->unique("game_id");
			foreach($scripts as $script){
				$game=$script->game;
				if(file_exists("games/$game->name/$game->name.js")){

					?>

					<script src="games/{{{$game->name}}}/{{{$game->name}}}.js" ></script>

					<?php 
				}
			}//end scripts

			//Next, we'll make a function to add the appropriate objects in
			//widgetAdder. You can't make a new object out of a string in
			//javascript, so this is my attempted workaround.

			?>
			<script type="text/javascript">
				function newWidget(name, i){
					switch(name){

						<?php 
						foreach($scripts as $script){
							$game=$script->game;
							echo "case \"$game->name\":new " . ucfirst($game->name)  . "(i);break;\n";
						}
						?>


					}
				}
			</script>


		<?php }//end newWidget


		else{ 

			//if the user is not logged in use standard widgets. Also a
			// handy reference for what the above is outputting.
			?>
			<script src="games/prompter/prompter.js" ></script>
			<script src="games/channelSwitcher/channelSwitcher.js" ></script>
			<script type="text/javascript">
				function newWidget(name, i){
					switch(name){
						case "prompter":new Prompter(i);break;
						case "channelSwitcher":new ChannelSwitcher(i);break;
					}
				}
			</script>


		<?php 

		} ?>
		

	<script src="jquery/widgetadder.js" ></script>

@stop






@section('content')

	<div class="primary">

		<?php
		//This will make the divs for Jquery to add the widgets
		if(Auth::user()){
			echo '<div id="widgets">';
			$i=0;
			if(Auth::user()->widgets->count()>0){
				//echo"<h4>Widgets</h4>";
				foreach($widgets as $widget){
					$game=$widget->game; ?>
					<div class="{{{$game->name}}}" id="{{{$game->name}}}_{{{$i}}}" style="position:relative;">
					<h5><a href="/game/{{{$game->name}}}">{{{$game->full_name}}}</a></h5>
						<div class="widget_controls" id="widget_controls_{{{$i}}}">
					</div></div>
					<?php $i++;
				}
			}
			echo '</div>';
		}
		else{
			echo "<div id='calltoaction'><p>In this age of streaming content, it can be hard for a creator to keep up. Seach engines are now giving priority to those sites that update more frequently. So, while we can’t help with the creation of content, this site aims to help you to keep coming up with a steady stream of exciting ideas to make it a little bit easier. It’s a collection of improv games you can play by yourself to find ideas.</p><a class='button' href='/getstarted'>Get Started</a></div>";
		}

		?>
	</div><!--end primary -->


	<div class="thirdary">
	<div id="newGames">
		<h4>New Games</h4>
			@foreach($newGames as $newGame)
				<div class="newGame">
					<a href="/game/{{{$newGame->name}}}" >
					<img class="newGameIcon" src="/images/icons/iconspurple/icons_{{{$newGame->primary_tag}}}.svg" alt="{{{$newGame->name}}} icon" onerror="this.onerror=null; this.src='/images/icons/iconspurple/icons_{{{$newGame->primary_tag}}}.png'"></a>
					<div class="newGameText">
						<h5 class="newGameTitle"><a href="/game/{{{$newGame->name}}}" >{{{$newGame->full_name}}}</a></h5>
						<div class="newGameDesc">{{{$newGame->short_desc}}}</div>
					</div>
				</div>
			@endforeach


	</div>

	<!-- Google Ad -->
	<div class="googleAd">

		<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
		<!-- omusing -->
		<ins class="adsbygoogle"
		     style="display:block"
		     data-ad-client="ca-pub-2424963268946018"
		     data-ad-slot="7983075933"
		     data-ad-format="auto"></ins>
		<script>
		(adsbygoogle = window.adsbygoogle || []).push({});
		</script>

	</div>
	<!-- end Google Ad -->

	<div id="topGames">
		<h4>Top Games</h4>
			@foreach($topGames as $topGame)
				<div class="topGame">
					<a href="/game/{{{$topGame->name}}}" >
					<img class="topGameIcon" src="/images/icons/iconspurple/icons_{{{$topGame->primary_tag}}}.svg" alt="{{{$topGame->name}}} icon" onerror="this.onerror=null; this.src='/images/icons/iconspurple/icons_{{{$topGame->primary_tag}}}.png'"></a>
					<div class="topGameText">
						<h5 class="topGameTitle"><a href="/game/{{{$topGame->name}}}" >{{{$topGame->full_name}}}</a></h5>
						<div class="topGameDesc">{{{$topGame->short_desc}}}</div>
					</div>
				</div>
			@endforeach

	</div>
	</div><!--end thirdary -->
@stop
