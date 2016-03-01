@extends('layouts.main')

@section('title')
Omusing! Create
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
	<h1> Write a New Article </h1>

	<hr />

	{!! Form::model($article = new \App\Article, ['url' => '/articles']) !!}

		@include('articles._form',['submitButtonText' => 'Create Article'])

	{!! Form::close() !!}

</article>


@stop
