@extends('layouts.main')

@section('title')
Omusing! {{{$game->full_name}}}!
@stop

@section('description')
{{{$game->short_desc}}}
@stop

@section('keywords')
ideas, self improvement, play, creative
@stop




@section('scripts')

	@if($game->widget==1)
		<script src="/games/{{{$game->name}}}/{{{$game->name}}}.js" ></script>
		
		<script type="text/javascript">
			function newWidget(name, i){
				new {{{ucfirst($game->name)}}}(0);
			}
			@if(Auth::user())
			function widgetButton(){
				if($('#max').val()>{{{Auth::user()->widgets->count()}}}){
					$.when( storeWidget('{{{$game->name}}}','{{{$game->full_name}}}','0') ).done(window.location.href = "/home");
				}else{
					$('#widget_button').animate({'opacity':.5}).html('Too many widgets...');
				}
			}
			@endif
		</script>

		<script src="/jquery/widgetadder.js" ></script>
	@endif

@stop






@section('content')
	<div class="primary">
	<h1>{{{$game->full_name}}}</h1>

	@if($game->widget==1)

		<div id="widgets">
			<div class="{{{$game->name}}}" id="{{{$game->name}}}_0" ></div>
			@if(Auth::user())
				<div id="widget_button" onClick="widgetButton()" class="button">Add Widget to Homepage</div>
			@else
				<a href="/user/register" class="button"><div id="widget_button">Register to Add Widget to Homepage</div></a>
			@endif
		</div>

	@endif

	@if($game->what_youll_need!=="")
		<div id="what_youll_need">
			<h2>What You'll Need:</h2>
			{!!$game->what_youll_need!!}
		</div>
	@endif

	@if($game->long_desc!=="")
		<div id="long_desc">
			<h2>Basic Rules</h2>
			{!!$game->long_desc!!}
		</div>
	@endif

	@if($game->variations!=="")
		<div id="variations">
			<h2>Variations</h2>
			{!!$game->variations!!}
		</div>
	@endif

	<h1>Keep Exploring...</h1>
	</div>

@stop
