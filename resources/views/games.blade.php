@extends('layouts.main')

@section('title')
Omusing! {{{$title}}}
@stop

@section('description')
Find the games you can play to come up with new ideas.
@stop

@section('keywords')
ideas, self improvement, play, creative
@stop

@section('extrastyle')
	<link rel="stylesheet" type="text/css" href="/style/gamelist.css" />
@stop

@section('scripts')
	<script src="/jquery/topgames.js" ></script>
@stop






@section('primary')



<div class="gameList">
	<div class="gameListHeader">
		<h4 id="gameListTitle">{{{$title}}}</h4>
		<select id="gameListChanger">
		  <option value="top" @if($modifier=='top')selected @endif>Top Games</option>
		  <option value="new" @if($modifier=='new')selected @endif>New Games</option>
		  <option value="widgets"@if($modifier=='widgets')selected @endif>Games with Widgets</option>
		  <?php if(Auth::check()){ ?>
		  		<option value="recommended" @if($modifier=='recommened')selected @endif>Recommended for You</option>
		  		<option value="recommendednew" @if($modifier=='recommendednew')selected @endif>New for You</option>
		  <?php } ?>
		  @foreach(Config::get('constants.TAGS') as $tag)
		  	<option value="{{{$tag[0]}}}" @if($modifier==$tag[0])selected @endif>{{{$tag[1]}}}</option>
		  @endforeach
		</select>
		<div id="games">
			@foreach($games->get() as $game)
			<div class="game">
				<div class="gameName">
					<h5><a href="/game/{{{$game['name']}}}">{{{$game['full_name']}}} - 
						<div class="gameListIcons">
						@foreach($game->tags()->get() as $tag)
							<img class="gameListIcon" src="/images/icons/icons_{{{$tag->name}}}.svg" alt="{{{$tag->name}}} icon" title="{{{$tag->name}}} icon" onerror="this.onerror=null; this.src='/images/icons/icons_{{{$tag->name}}}.png'">
						@endforeach
					</div>
					</a></h5>
				</div>
				<div class="gameDesc">
					{{{$game['short_desc']}}}
				</div>
			</div>
			@endforeach
		</div>
	</div>


	<div class="newGameBoxes">
		@foreach($newGames as $newGame)
			<div class="newGameBox">
				<h5 class="newGameBoxName"><a href="/game/{{{$newGame['name']}}}">{{{$newGame['full_name']}}}</a></h5>
				{{{$newGame['short_desc']}}}
			</div>
		@endforeach
	</div>

</div>



@stop
