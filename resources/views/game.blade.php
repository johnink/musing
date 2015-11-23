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
			var widgetMenuOpen=false;
			function newWidget(name, i){
				new {{{ucfirst($game->name)}}}(0);
			}

			function addWidgetToHomepage(){
				@if(Auth::check())
					if($('#max').val()>{{{Auth::user()->widgets->count()}}}){
						//subtract one from max to prevent adding too many widgets.
						$('#max').val(parseInt($('#max').val())-1);
						$.when( storeWidget('{{{$game->name}}}','{{{$game->full_name}}}','0',false) ).done(function(){
								var $widgetMenuOptionsUL=$('#widgetMenuOptionsUL');
								$widgetMenuOptionsUL.animate({opacity:0},200,'easeOutQuad',function(){
									$widgetMenuOptionsUL.html('<p>Successfully added to homepage.</p><p><a href="/">Go to homepage.</a></p>').animate({opacity:1},200,'easeInQuad');
								});


						});
					}else{
						var $widgetMenuOptionsUL=$('#widgetMenuOptionsUL');
							$widgetMenuOptionsUL.animate({opacity:0},200,'easeOutQuad',function(){
								$widgetMenuOptionsUL.html('<p>Too Many Widgets...</p><p><a href="/">Go to homepage.</a></p>').animate({opacity:1},200,'easeInQuad');
							});
					}
				@else
				var $widgetMenuOptionsUL=$('#widgetMenuOptionsUL');
				$widgetMenuOptionsUL.animate({opacity:0},200,'easeOutQuad',function(){
					$widgetMenuOptionsUL.html('<p>You need to register.</p><p><a href="/user/register">Register</a> | <a href="/user/login">Log in</a></p>').animate({opacity:1},200,'easeInQuad');
				});
				@endif

			}

			function openWidgetMenu(){
				if(widgetMenuOpen===false){
					widgetMenuOpen=true;
					var $widgetMenu = $('<div id="widgetMenu"class="addMenu"></div>');
					var $widgetMenuCloseButton = $('<span class= "addMenuCloseButton" onClick="closeWidgetMenu()">x</span>');
					var $widgetMenuOptionsUL=$('<div id="widgetMenuOptionsUL"><ul></ul></div>');
					$widgetMenuOptionsUL.append('<li onClick="addWidgetToHomepage()">Add Widget to Homepage</li>');
					$widgetMenuOptionsUL.append('<li><a href="/widgetonly/{{{$game->name}}}" target="_blank">Open Widget in a New Window</a></li>');
					$widgetMenu.append($widgetMenuCloseButton,$widgetMenuOptionsUL).hide();

					$('.widget_options').append($widgetMenu);
					$widgetMenu.slideDown(200,'easeOutBounce');
				}
			}

			function closeWidgetMenu(){
				$('#widgetMenu').slideUp(200,'easeOutBounce',function(){
					$('#widgetMenu').remove();
					widgetMenuOpen = false;
				});
			}

		</script>

		<script src="/jquery/widgetadder.js" ></script>
	@endif

@stop






@section('primary')
	<h1>{{{$game->full_name}}}</h1>

	@if($game->widget==1)

		<div id="widgets">
			<div class="{{{$game->name}}}" id="{{{$game->name}}}_0" ></div>
			<div class="widget_options" id="widget_options" onClick="openWidgetMenu()">Widget Actions</div>
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

@stop
