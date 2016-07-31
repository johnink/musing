@extends('layouts.main')

@section('title')
Omusing! Register
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
<script src='https://www.google.com/recaptcha/api.js'></script>
@stop

@section('primary')

<div class="avatarChooserWrap">
    <span class="avatarChooser">
        <div class="avatarChoose"><img class="avatarImg selected" id="avatar1" onclick="closeAvatarSelect(1);" alt="choose compass avatar" src="/images/avatars/1.jpg"/></div>
        <div class="avatarChoose"><img class="avatarImg" id="avatar2" onclick="closeAvatarSelect(2);" alt="choose car avatar" src="/images/avatars/2.jpg"/></div>
        <div class="avatarChoose"><img class="avatarImg" id="avatar3" onclick="closeAvatarSelect(3);" alt="choose suitcase avatar" src="/images/avatars/3.jpg"/></div>
        <div class="avatarChoose"><img class="avatarImg" id="avatar4" onclick="closeAvatarSelect(4);" alt="choose suitcase avatar" src="/images/avatars/4.jpg"/></div><br />
        <div class="avatarChoose">or <span class="gravChoose" id="avatar5" onclick="closeAvatarSelect(5);"> Use Gravitar</span> [
                <span class="gravInfo"><a href="https://en.gravatar.com/support/what-is-gravatar/" target="_blank">?</a></span>
            ]</div>
    </span>
</div>

<form method="POST" action="/auth/register" class="registerForm">
    {!! csrf_field() !!}

    <div id="registerPart1" class="clearfix">
        <h1>Register</h1>

        <input type="hidden" name="avatar" id="hidden_avatar" value="{{ old('avatar') }}">

        <div class="avatar avatarBigger" id="registerAvatar" style="background-image:url('/images/avatars/1.jpg');" onClick="openAvatarSelect();"><span class="avatarText">click to choose</span></div>
        <div id="loginfields">
            <div class="form-group">
                <label for="name">User Name</label>
                <input type="text" name="name" class="form-control" id="name" placeholder="User Name" value="{{ old('name') }}">
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" class="form-control" id="email" placeholder="Email" value="{{ old('email') }}">
            </div>

            <div class="form-group">
                <label for="website">Website</label>
                <input type="url" name="website" class="form-control" id="website" placeholder="Website (Optional)" value="{{ old('website') }}">
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" class="form-control" placeholder="Password" id="password">
            </div>

            <div class="form-group">
                <label for="password_confirmation">Confirm Password</label>
                <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm Password" id="password_confirmation">
            </div>
            <div class="captcha">
                <div class="g-recaptcha" data-sitekey="6LemSiYTAAAAAGaWh_rmHauU3lHShlLZHsGDUqT1"></div>
            </div>
            <div class="terms"><input type="checkbox" name="terms" id="terms">
                <label for="terms" class="showLabel">
                    I agree to the <a href="/terms">terms of service.</a>
            </label></div>


        </div>
    </div>

    {{--
    <div id="registerPart2" class="clearfix">
        <div class="tags" >
            <h1>Check All that Apply to You (if any)</h1>
            <!--$tag is an array where 0 is the tag and 1 is the readable version-->
            @foreach(Config::get('constants.TAGS') as $tag)

             <div class="tag"><input type="checkbox" name="{{{$tag[0]}}}" id="{{{$tag[0]}}}">
                <label for="{{{$tag[0]}}}">
                    <img class="registerIcons" src="/images/icons/icons_{{{$tag[0]}}}.svg" alt='{{{$tag[1]}}} tag. Select if applies to you.'><div>{{{$tag[2]}}}</div>
                </label>
            </div>

            @endforeach

        </div>
    --}}

        <div>
            <button type="submit" class="button">Register</button>
        </div>
</form>

@stop