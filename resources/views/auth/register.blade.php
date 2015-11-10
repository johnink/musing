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

<div class="primary">
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
        <h1>check all that apply to you</h1>
        <!--$tag is an array where 0 is the tag and 1 is the readable version-->
        @foreach(Config::get('constants.TAGS') as $tag)

         <div class="tag"><input type="checkbox" name="{{{$tag[0]}}}" id="{{{$tag[0]}}}">
            <label for="{{{$tag[0]}}}">
                <img class="registerIcons"src="/images/icons/icons_{{{$tag[0]}}}.svg" alt='$tag[1]'>{{{$tag[1]}}}
            </label>
        </div>

        @endforeach

    </div>

    <div>
        <button type="submit" class="button">Register</button>
    </div>
</form>
</div>
@stop