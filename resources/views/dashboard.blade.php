@extends('layouts.main')

@section('title')
OhMusing! Ideas on how to find ideas
@stop

@section('description')
A website dedicated to helping you find ideas. Providing tools and games to help you explore your mind and see what you find.
@stop

@section('keywords')
ideas, self improvement, play, creative
@stop

@section('scripts')
	<?php 


		//This will add only the javascripts for the users widgets


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


		else{

			//if the user is not logged in use standard widgets. Also a
			// handy reference for what the above is outputting. ?>

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


		<?php } ?>
		

	<script src="jquery/widgetadder.js" ></script>

@stop

@section('content')
	<div id="widgets" style="position:relative;">
		<input id="token" type="hidden" value="{{ csrf_token() }}">

		<?php
		//This will make the divs for Jquery to add the widgets
		if(Auth::user()){
			$i=0;
			foreach($widgets as $widget){
				$game=$widget->game; ?>
				<div class="{{{$game->name}}}" id="{{{$game->name}}}_{{{$i}}}" style="position:relative;">
				<h5>{{{$game->full_name}}}</h5>
					<div class="widget_controls" id="widget_controls_{{{$i}}}">
				</div></div>
				<?php $i++;
			}
		}
		else{
			echo '<div class="channelSwitcher" id="channelSwitcher_0"><h5>Channel Switcher</h5></div>';
			echo '<div class="prompter" id="prompter_1"><h5>Prompter</h5></div>';
		}

		?>

	</div>	
@stop
