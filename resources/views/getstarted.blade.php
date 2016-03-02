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

<h3>Every good idea has <strong>NOT</strong> been done.</h3>

<p>It's become cliche to say that they have. But if you think of creativity as a place that you're simply exploring, it becomes obvious that these trends you see are simply trails that people tend to stick to because they're easier.</p>

<p>Everybody takes trails. You should follow them and see where they go and where they join up with other trails. But you can also take a step off to the left or right, and you're on a completely new trail.</p>

<p>It can, of course, be hard to try to find a place to step that no one has ever stepped before. But, don't forget:</p>

<svg style="float:right;width:5em;padding:0 0 1em 1em;"xmlns="http://www.w3.org/2000/svg" viewBox="322.4 0 314.5 560.6"><path d="M344.3 515.2c-6.5 16.5 1.8 35.4 18.9 41.9 4.1 1.8 7.7 2.4 11.8 2.4 13 0 25.4-7.7 30.1-20.7l34.8-89.1c-13-30.1-27.1-60.8-37.2-83.8L344.3 515.2z"/><path d="M465.8 130.4c36 0 65.5-28.9 65.5-65.5 0-36-29.5-64.9-65.5-64.9s-65.5 28.9-65.5 65.5C400.9 101.5 429.8 130.4 465.8 130.4z"/><path d="M390.9 282.1v-95.6c0-18.9-15.3-34.2-34.2-34.2s-34.2 15.3-34.2 34.2v95.6c0 18.9 15.3 34.2 34.2 34.2C376.1 316.3 390.9 300.9 390.9 282.1z"/><path d="M611 246.7h-1.2v-28.3c0-6.5-5.3-11.8-11.8-11.8s-11.8 5.3-11.8 11.8v28.3h-27.1L516 176.4c-9.4-15.3-29.5-27.7-56.1-26.6 -40.1 1.8-53.7 26-53.1 43.1v129.8l0 0 13.6 30.1 0 0c26.6 60.2 83.2 187.1 83.2 187.1 5.3 12.4 17.1 19.5 29.5 19.5 4.7 0 8.9-1.2 13-3 16.5-7.1 23.6-26.6 16.5-43.1l-59-132.2V257.3l26 41.9h56.6v249.6c0 6.5 5.3 11.8 11.8 11.8s11.8-5.3 11.8-11.8V299.2h1.2c14.2 0 26-11.8 26-26C637 258.5 625.2 246.7 611 246.7z"/></svg>

<h3>There's a whole everything out there.</h3>


<p>What about the depths of the sea, or the infinity of the sky?</p>

<p>To say that everything's been done is like saying humanity has been everywhere. Sure, it can seem that way, but we’ve really hardly seen much at all. So, without further ado,</p>

<h3>Let's go exploring...</h3>
<br /><br />
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
