@extends('layouts.main')

@section('title')
Omusing! Register
@stop

@section('description')
A website dedicated to helping you find ideas. Register.
@stop

@section('keywords')
ideas, self improvement, play, creative
@stop

@section('scripts')
@stop

@section('content')

<form method="POST" action="/user/register">
    {!! csrf_field() !!}

    <h1>Register</h1>

    <div class="loginfield">
        <label for="name">User Name</label>
        <input type="text" name="name" id="name" value="{{ old('name') }}">
    </div>

    <div class="loginfield">
        <label for="email">Email</label>
        <input type="email" name="email" id="email" value="{{ old('email') }}">
    </div>

    <div class="loginfield">
        <label for="password">Password</label>
        <input type="password" name="password" id="password">
    </div>

    <div class="loginfield">
        <label for="password_confirmation">Confirm Password</label>
        <input type="password" name="password_confirmation" id="password_confirmation">
    </div>

    <div class="tags" >
        <div class="tag"><input type="checkbox" name="writing" id="writing"><label for="writing">Fiction Writing</label></div>
        <div class="tag"><input type="checkbox" name="blogging" id="blogging"><label for="blogging">Blogging</label></div>
        <div class="tag"><input type="checkbox" name="socialmedia" id="socialmedia"><label for="socialmedia">Posting on Twitter/Facebook</label></div>
        <div class="tag"><input type="checkbox" name="stageimprov" id="stageimprov"><label for="stageimprov">Stage Improv</label></div>
        <div class="tag"><input type="checkbox" name="drawing" id="drawing"><label for="drawing">Drawing</label></div>
        <div class="tag"><input type="checkbox" name="standup" id="standup"><label for="standup">Stand Up Comedy</label></div>
        <div class="tag"><input type="checkbox" name="music" id="music"><label for="Music">Music</label></div>

    </div>

    <div>
        <button type="submit" class="button">Register</button>
    </div>
</form>
@stop