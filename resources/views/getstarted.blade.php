@extends('layouts.main')

@section('title')
Omusing! Get Started
@stop

@section('description')
A website dedicated to helping you find ideas. Providing tools and games to help you explore your mind and see what you find.
@stop

@section('keywords')
ideas, self improvement, play, creative
@stop




@section('scripts')

@stop




@section('primary')

<div id="getstarted">

<h3>Good places to start</h3>

<p><a href="http://www.omusing.com/articles/4"><img src="/images/blog.svg" class="categoryIcon" alt="Article Icon" />Every good idea has NOT been done.</a> - First blog post.</p>

<p><a href="http://www.omusing.com/articles/7"><img src="/images/things.svg" class="categoryIcon" alt="Article Icon" />The Basics</a> - Some simple things you can do to get started.</p>

<h3>Using this site</h3>

<a href="/gamelist"><h4><img src="/images/game.svg" class="categoryIcon" alt="Games Icon" />Games</h4></a>

<p>To get the mind rolling, Omusing features single-player improv games you can play to come up with ideas.  For these games you often need a piece of paper and a prompt.</p>

<a href="/game/prompter"><h4><img src="/images/prompter.svg" class="categoryIcon" alt="Prompter Icon" />Prompts</h4></a>

<p>A prompt serves as a starting point for your game. You can get prompts from variety of different places. They can be random or apply to your topic. Omusing features an in-browser prompter. <a href="/game/prompter">Click here</a> for more information.</p>

<a href="/gamelist/widgets"><h4><img src="/images/widget.svg" class="categoryIcon" alt="Widget Icon" />Widgets</h4></a>

<p>Certain games have little helpers called widgets. These can be added to the home page or opened to their own separate tab by clicking the widget actions button underneath the widget.</p>

<img src="/images/widgetActionsDemo.png" alt="An example of where the widget actions button is." />

<h3>One more word</h3>

<p>Omusing is currently in it's infancy. New features and articles will be rolled out every week. If you notice something out-of-place, or want to tell us what you think, send inquiries to <a href="mailto:john@omusing.com">john@omusing.com.</a></p>

<p>Also, be sure to keep up with updates through your favorite social:</p>

@include('_social')



<h3>Keep Exploring...</h3>

<a class='button' href='/auth/register'>Register</a>

</div>

@stop

@section('thirdary')

	@include('_sidebar')

@stop
