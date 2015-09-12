@extends('layouts.main')

@section('title')
Omusing! Game List
@stop

@section('description')
Find the games you can play to come up with new ideas.
@stop

@section('keywords')
ideas, self improvement, play, creative
@stop

@section('scripts')
	<script src="jquery/topgames.js" ></script>
@stop






@section('content')

<div class="gameList">
	<div class="gameListHeader">
		<h4>Top Games</h4>
		<select>
		  <option value="top">Top Games</option>
		  <option value="new">New Games</option>
		  <option value="recommended">Recommended for You</option>
		  @foreach(Config::get('constants.TAGS') as $tag)
		  	<option value="{{{$tag[0]}}}">{{{$tag[1]}}}</option>
		  @endforeach
		</select>

		<pre><?php print_r($games->get(['name'])->toArray()); ?></pre>



	</div>



</div>




@stop
