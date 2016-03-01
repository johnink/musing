@extends('layouts.main')

@section('title')
Omusing! Edit profile
@stop

@section('description')
A website dedicated to helping you find ideas.
@stop

@section('keywords')
ideas, self improvement, play, creative
@stop

@section('scripts')
<script src="/jquery/avatarselect.js" ></script>
<script src="/jquery/jquery.md5.js" ></script>
@stop

@section('primary')

@if($page=='main')
<div class="avatarChooserWrap">
    <span class="avatarChooser">
        <div class="avatarChoose"><img class="avatarImg" id="avatar1" onclick="closeAvatarSelect(1);" alt="choose compass avatar" src="/images/avatars/1.jpg"/></div>
        <div class="avatarChoose"><img class="avatarImg" id="avatar2" onclick="closeAvatarSelect(2);" alt="choose car avatar" src="/images/avatars/2.jpg"/></div>
        <div class="avatarChoose"><img class="avatarImg" id="avatar3" onclick="closeAvatarSelect(3);" alt="choose suitcase avatar" src="/images/avatars/3.jpg"/></div>
        <div class="avatarChoose"><img class="avatarImg" id="avatar4" onclick="closeAvatarSelect(4);" alt="choose suitcase avatar" src="/images/avatars/4.jpg"/></div><br />
        <div class="avatarChoose">or <span class="gravChoose" id="avatar5" onclick="closeAvatarSelect(5);"> Use Gravitar</span> [
                <span class="gravInfo"><a href="https://en.gravatar.com/support/what-is-gravatar/" target="_blank">?</a></span>
            ]</div>
    </span>
</div>
<form method="POST" action="/auth/edit" class="registerForm">
    {!! csrf_field() !!}

    <div id="registerPart1">
        <h1>Edit Info</h1>

        <input type="hidden" name="avatar" id="hidden_avatar" value="{{{ Auth::user()->avatar }}}">
        <div class="avatar avatarBigger" style="background-image:url('{{{ Avatar::getAvatarUrl()}}}');" onClick="openAvatarSelect();"><span class="avatarText">click to choose</span></div>
        <div id="loginfields">
            <div class="form-group editInfo">
                <label for="name" class="showLabel">User Name</label>
                <input type="text" name="name" class="form-control" id="name" value="{{{ Auth::user()->name }}}" />

                <label for="website" class="showLabel">Website</label>
                <input type="text" name="website" class="form-control" id="website" placeholder="Website" value="{{{ Auth::user()->website }}}">
            
                <input type="hidden" id="email" value="{{{ Auth::user()->email }}}" />
                <div class="form-group">

                <a href="/auth/pwedit"><div id="changePassword">Change Password</div></a><br />
                <a href="/auth/emedit"><div id="updateEmail">Update Email</div></a>
            </div>
        </div>
    </div>
    </div>

    <div id="registerPart2">
        <div class="tags" >
            <h1>Change Your Tags</h1>
            <!--$tag is an array where 0 is the tag and 1 is the readable version-->
            @foreach(Config::get('constants.TAGS') as $tag)

             <div class="tag"><input type="checkbox" name="{{{$tag[0]}}}" id="{{{$tag[0]}}}" @if(Auth::user()->tags()->where('name',$tag[0])->count()) checked @endif>
                <label for="{{{$tag[0]}}}">
                    <img class="registerIcons"src="/images/icons/icons_{{{$tag[0]}}}.svg" alt='$tag[1]'><div>{{{$tag[2]}}}</div>
                </label>
            </div>

            @endforeach

        </div>

        <div>
            <button type="submit" class="button">Save Changes</button>
        </div>
    </div>
</form>

@elseif($page=='pw')

<form method="POST" action="/auth/pwedit">
    {!! csrf_field() !!}

    <h1>Change Password</h1>

    <div class="form-group">
        <label for="password">New Password</label>
        <input type="password" name="password" class="form-control" placeholder="Password" id="password">
    </div>

    <div class="form-group">
        <label for="password_confirmation">Confirm Password</label>
        <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm Password" id="password_confirmation">
    </div>

    <div>
        <button type="submit" class="button">Save Changes</button>
    </div>
</form>



@elseif($page=='em')

<form method="POST" action="/auth/emedit">
    {!! csrf_field() !!}

    <h1>Change Email</h1>
    <p style="text-align:center;margin-top:-1em;margin-bottom:2em;">Remember, this is what you use to log on...</p>
    <div class="form-group">
        <label for="email">New Email</label>
        <input type="email" name="email" class="form-control" id="email" value="{{ old('email') }}">
    </div>
    <div class="form-group">
        <label for="confirmEmail">Confirm Email</label>
        <input type="email" name="confirmEmail" class="form-control" id="confirmEmail" value="{{ old('email') }}">
    </div>


    <div>
        <button type="submit" class="button">Save Changes</button>
    </div>
</form>

@endif


@stop