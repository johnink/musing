@extends('layouts.main')

@section('title')
Omusing! {{$article -> title}}
@stop

@section('description')
{{{$article -> description}}}
@stop

@section('keywords')
ideas, self improvement, play, creative
@stop

@section('extrameta')
	<meta property="og:url"           content="http://www.omusing.com/articles/{{$article->id}}" />
	<meta property="og:type"          content="website" />
	<meta property="og:title"         content="{{$article->title}} - Omusing" />
	<meta property="og:description"   content="{{{$article -> description}}}" />
	<meta property="og:image"         content="http://www.omusing.com/android-icon-192x192.png" />
@stop


@section('scripts')

	<!--google plus-->
	<!-- Place this tag in your head or just before your close body tag. -->
	<script src="https://apis.google.com/js/platform.js" async defer></script>

@stop




@section('primary')

	<!--facebook-->
	<div id="fb-root"></div>
	<script>(function(d, s, id) {
	  var js, fjs = d.getElementsByTagName(s)[0];
	  if (d.getElementById(id)) return;
	  js = d.createElement(s); js.id = id;
	  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.5";
	  fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));</script>

<article>

	<h2>{{ $article-> title}}</h2>

	<div class="body">{!! $article -> body !!}</div>

	<div class="articleSocials">
		<div class="articleFacebook">
			<div class="fb-share-button" data-layout="button_count"></div>
		</div>
		<div class="articleTwitter">
			<a href="https://twitter.com/share" class="twitter-share-button" data-via="Omusingcom">Tweet</a>
			<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
		</div>
		<div class="articleGoogle">
			<div class="g-plusone" data-size="medium"></div>
		</div>

	</div>

	<h4 class="articleTags">Tags:</h4>
	<ul>

		@foreach ($article->tags as $tag)
			<li> {{ $tag->name }}</li>
		@endforeach

	</ul>

</article>


@stop

@section('thirdary')

	@include('_sidebar')

@stop
