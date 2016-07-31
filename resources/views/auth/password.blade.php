@extends('layouts.main')

@section('title')
Omusing!
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
    <div style="margin-bottom:3em"><strong style="font-style:italic">*note: This will send a password reset to the email address specified. Be sure to check your spam folder</strong></div>

    <form method="POST" action="/password/email">
        {!! csrf_field() !!}

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" class="form-control" placeholder="Enter email" value="{{ old('email') }}">
        </div>

        <div>
            <button type="submit" class="button">
                Send Password Reset Link
            </button>
        </div>
    </form>

@stop