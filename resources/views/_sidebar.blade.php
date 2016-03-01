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