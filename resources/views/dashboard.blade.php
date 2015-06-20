@extends('layouts.main')

@section('title')
OhMusing! Ideas on how to find ideas
@stop

@section('description')
A website dedicated to helping you find ideas. Providing tools and games to help you explore your mind and see what you find.
@stop

@section('keywords')
ideas, self improvement, play, creative
@stop

@section('scripts')
	<script src="games/prompter/prompter.js" ></script>
	<script src="games/channelSwitcher/channelSwitcher.js" ></script>
	<script src="jquery/widgetadder.js" ></script>
@stop

@section('content')
	<div id="widgets"></div>	
@stop
