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

@section('primary')
    <form method="POST" action="/auth/login" id="loginForm">
        {!! csrf_field() !!}
        
        <div class="form-group">
            <label for="user">Email or Username</label>
            <input type="name" name="name" class="form-control" id="name" placeholder="Username / Email" value="{{ old('user') }}">
        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" name="password" placeholder="Password" id="password">
        </div>

        <div class="clearfix">
            <div class="checkbox rememberme">
                <label for="remember">
                    <input type="checkbox" name="remember" id="remember">Remember Me
                </label>
            </div>
            <div class="forgotpassword">
                <a href="/password/email">Forgot Password?</a>
            </div>
        </div>

        <div>
            <button type="submit" class="button">Login</button>
        </div><br/><br/>
        <div>
            <a href="/auth/register" style="position:relative;bottom:0;padding-top:1em;">Need an account? Click here to register.</a>
        </div>

    </form>
@stop