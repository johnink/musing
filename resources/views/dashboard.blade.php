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

		if(Auth::user()){
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

		/*
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

		}*/ ?>
		

	<script src="jquery/widgetadder.js" ></script>

@stop


@section('primary')


	<?php


	//This will make the divs for Jquery to add the widgets
	if(Auth::check()&&count($widgets)<=0){
		echo "<a href='/gamelist/widgets'><div class='noWidgets'>You have no widgets. Click here to find one you like.</div></a>";
	}

	elseif(Auth::check()){
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
		echo "<div id='calltoaction'>" . 

			/*<img class='calltoactionimg' alt='need ideas?' src='/images/needideas.png'/>" 

			<div style='float:left;clear:left;height:1.30em;width:230px;margin-top:2.6em'></div>
			<div style='float:left;clear:left;height:1.35em;width:192px;'></div>
			<div style='float:left;clear:left;height:1.35em;width:105px;'></div>
			<div style='float:left;clear:left;height:1.35em;width:0;'></div>
			<div style='float:left;clear:left;height:1.35em;width:0'></div>*/

				"<p><span>ideas to find ideas...  </span>In this age of streaming content, it can be hard for a creator to keep up.  This site aims to help you come up with a steady stream of exciting ideas to make it a little bit easier.</p><a class='button' href='/getstarted'>Get Started</a></div>";
	}

	?>

	<div id="articles">
		<img src="/images/adventure.jpg" class='adventure' alt="Adventurer" />
			<div class="spacing">
				<div style='float:right;clear:right;height:2em;width:250px'></div>
				<div style='float:right;clear:right;height:2em;width:230px'></div>
				<div style='float:right;clear:right;height:2em;width:220px'></div>
				<div style='float:right;clear:right;height:2em;width:210px'></div>
				<div style='float:right;clear:right;height:2em;width:200px'></div>
				<div style='float:right;clear:right;height:2em;width:200px'></div>
				<div style='float:right;clear:right;height:1em;width:190px'></div>
			</div>
		@include('articles._articles')
	</div>
	<a class="nextPage button" href="/articles?page=2">More Articles</a>
	
@stop

@section('thirdary')

	@include('_sidebar')

@stop
