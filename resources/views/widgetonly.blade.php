@extends('layouts.barebones')

@section('title')
Omusing! {{{$game->full_name}}} Widget!
@stop

@section('description')
{{{$game->short_desc}}}
@stop

@section('keywords')
ideas, self improvement, play, creative, drawing, writing, improv, comedy
@stop




@section('scripts')

	@if($game->widget==1)
		<script src="/games/{{{$game->name}}}/{{{$game->name}}}.js" ></script>
		
		<script type="text/javascript">
			var widgetMenuOpen=false;
			function newWidget(name, i){
				new {{{ucfirst($game->name)}}}(0);
			}

		</script>

		<script src="/jquery/widgetadder.js" ></script>
	@endif

@stop






@section('content')
	<h1>{{{$game->full_name}}}</h1>

	@if($game->widget==1)

		<div id="widgets">
			<div class="{{{$game->name}}}" id="{{{$game->name}}}_0" ></div>
		</div>

	@endif


@stop
