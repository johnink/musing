@extends('layouts.main')

@section('title')
Omusing! {{{$category ? $category : "Articles"}}}
@stop

@section('description')
Lessons, blog posts, or Recommendations to help you find ideas, or just things to consider when learning to be a creative thinker.
@stop

@section('keywords')
ideas, self improvement, play, creative
@stop




@section('scripts')

@stop




@section('primary')

	@include('articles._articles')

	{{ $articles -> appends(Request::only('category')) -> links() }}



@stop

@section('thirdary')

	@include('_sidebar')

@stop