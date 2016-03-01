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

<form method="POST" action="/password/reset">
    {!! csrf_field() !!}
    <input type="hidden" name="token" value="{{ $token }}">

    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" name="email" class="form-control" placeholder="Enter email" value="{{ old('email') }}">
    </div>

    <div class="form-group">
        <label for="password">New Password</label>
        <input type="password" name="password" class="form-control" placeholder="Password">
    </div>

    <div class="form-group">
        <label for="password_confirmation">Confirm Password</label>
        <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm Password">
    </div>

    <div>
        <button type="submit" class="button">
        <label for="email">Reset Password</label>
        </button>
    </div>
</form>


@stop