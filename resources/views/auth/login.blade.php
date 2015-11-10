@extends('layouts.main')

@section('title')
Omusing! Log in
@stop

@section('description')
A website dedicated to helping you find ideas. Providing tools and games to help you explore your mind and see what you find.
@stop

@section('keywords')
ideas, self improvement, play, creative
@stop

@section('scripts')
@stop

@section('content')
<div class="primary">
    <form method="POST" action="/user/login">
        {!! csrf_field() !!}
        
        <div class="loginfield">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" value="{{ old('email') }}">
        </div>

        <div class="loginfield">
            <label for="password">Password</label>
            <input type="password" name="password" id="password">
        </div>

        <div class="rememberme">
            <input type="checkbox" name="remember" id="remember"><label for="remember">Remember Me</label>
        </div>

        <div>
            <button type="submit" class="button">Login</button>
        </div>
    </form>
</div>
@stop