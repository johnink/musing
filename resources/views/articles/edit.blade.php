@extends('layouts.main')

@section('title')
Omusing! Edit: {!! $article->title !!}
@stop

@section('description')
A website dedicated to helping you find ideas. Providing tools and games to help you explore your mind and see what you find.
@stop

@section('keywords')
ideas, self improvement, play, creative
@stop




@section('scripts')

<script src="/jquery/preview.js" ></script>

@stop




@section('primary')

<article>
	<h1> Edit: {!! $article->title !!} </h1>

	<hr />

	{!! Form::model($article, ['method' => 'PATCH','url' => '/articles/' . $article->id]) !!}

		@include('articles._form',['submitButtonText' => 'Save Article'])

	{!! Form::close() !!}

</article>


@stop
