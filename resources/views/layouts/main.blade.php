<!DOCTYPE html>
<html>

	<!-- John Ink CC 2015 Creative Commons Attribution-NonCommercial-ShareAlike 4.0 International License www.johnink.com www.barelyanimated.com-->
	<head>
		<title>@yield('title')</title>
		<meta name="description" content="@yield('description')"/>
		<meta name="keywords" content="@yield('keywords')" />
		<meta name="author" content="John Ink" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta charset="UTF-8" />
		<link rel="stylesheet" type="style/css" href="/style/normalize.css" />
		<link rel="stylesheet" type="style/css" href="/style/base.css" />
		<link href='http://fonts.googleapis.com/css?family=Nunito' rel='stylesheet' type='text/css'>
		<link href='http://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>


	</head>

	<body>
		
		<div id="header">
			<header><img src="/images/LogoV1.svg" alt="Omusing Logo Ideas to find Ideas"/></header>
				@if(Auth::user())
					<div id="userlogin" class="loggedin">
						<span id="welcomephrase">Yo, {{{Auth::user()->name}}}, wassup. </span><a href="/user/logout">logout?</a>
					</div>
				@else
					<div id="userlogin">
						<a href="/user/login">login?</a><br /><a href="/user/register">register!</a>
					</div>
				@endif
				<input id="token" type="hidden" value="{{ csrf_token() }}">
				<input id="max" type="hidden" value="{{ Config::get('constants.MAX_WIDGETS') }}">
			
		</div>

		<div id="jayz">
			@yield('content')
		</div>

		<div id="footer"><a rel="license" href="http://creativecommons.org/licenses/by-nc-sa/4.0/"><img alt="Creative Commons License" style="border-width:0" src="https://i.creativecommons.org/l/by-nc-sa/4.0/80x15.png" /></a><br />Omusing content is licensed under a <a rel="license" href="http://creativecommons.org/licenses/by-nc-sa/4.0/">Creative Commons Attribution-NonCommercial-ShareAlike 4.0 International License</a>.</div>


	</body>


	<footer>
		<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
		<script src="/jquery/jquery-ui.min.js"></script>
		<script src="/jquery/common.js"></script>
		@yield('scripts')

	</footer>







</html>














