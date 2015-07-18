@extends('layouts.main')

@section('title')
OhMusing! Register
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

    <div class="col-md-6">
        User Name
        <input type="text" name="name" value="{{ old('name') }}">
    </div>

    <div>
        Email
        <input type="email" name="email" value="{{ old('email') }}">
    </div>

    <div>
        Password
        <input type="password" name="password">
    </div>

    <div class="col-md-6">
        Confirm Password
        <input type="password" name="password_confirmation">
    </div>

    <div class="tags" >
        <input type="checkbox" name="writing" id="writing"><label for="writing">Fiction Writing</label>
        <input type="checkbox" name="blogging" id="blogging"><label for="blogging">Blogging</label>
        <input type="checkbox" name="socialmedia" id="socialmedia"><label for="socialmedia">Posting on Twitter/Facebook</label>
        <input type="checkbox" name="stageimprov" id="stageimprov"><label for="stageimprov">Stage Improv</label>
        <input type="checkbox" name="drawing" id="drawing"><label for="drawing">Drawing</label>
        <input type="checkbox" name="standup" id="standup"><label for="standup">Stand Up Comedy</label>
        <input type="checkbox" name="music" id="music"><label for="Music">Music</label>

    </div>

    <div>
        <button type="submit">Register</button>
    </div>
</form>
@stop