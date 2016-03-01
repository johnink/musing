

@foreach(array_chunk($articles->all(), 5) as $articleChunk)
	@foreach($articleChunk as $article)
		<article>
			@if(isset($article->full_category))
				<div class='articleCategory'><a href='/articles?category={{$article->category}}'>
					<img src="images/{{$article->category}}.svg" class="categoryIcon" alt="category icon" />
					{{$article->full_category}}
				</a></div>
			@endif
			<h2>
				<a href="/articles/{{$article->id}}/{{ isset(Auth::user()->name) && Auth::user()->name=='Admin' ? 'edit' : '' }}">
				{{ $article-> title}}
				</a>
				<br />
				<small>({{ $article -> published_at -> format('M j, Y') }})</small>


			</h2>


			<div class="excerpt">{!! $article -> excerpt !!}</div>
			<div class="continuereading">
				<a href="/articles/{{$article->id}}">continue reading...</a>
			</div>
		</article>
	@endforeach
	@include('articles._ad')
@endforeach
