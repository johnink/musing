<!DOCTYPE html>
<html>

	<!--Omusing v1.2.0-->

	<!-- John Ink CC 2015 Creative Commons Attribution-NonCommercial-ShareAlike 4.0 International License www.johnink.com www.barelyanimated.com-->
	<head>
		<title>@yield('title')</title>
		<meta name="description" content="@yield('description')"/>
		<meta name="keywords" content="@yield('keywords')" />
		<meta name="author" content="John Ink" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		@yield('extrameta')
		<meta charset="UTF-8" />
		<!--<link rel="stylesheet" type="text/css" href="/style/normalize.css" /> -->
		<!-- Latest compiled and minified CSS for bootstrap-->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

		<!-- Optional theme 
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">-->

		<link rel="stylesheet" type="text/css" href="/style/base.css" />
		<link rel="stylesheet" type="text/css" href="/style/responsive.css" />
		@yield('extrastyle')
		<link href='http://fonts.googleapis.com/css?family=Nunito' rel='stylesheet' type='text/css'>
		<link href='http://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>

		<!--favicon stuff-->
		<link rel="apple-touch-icon" sizes="57x57" href="/apple-icon-57x57.png">
		<link rel="apple-touch-icon" sizes="60x60" href="/apple-icon-60x60.png">
		<link rel="apple-touch-icon" sizes="72x72" href="/apple-icon-72x72.png">
		<link rel="apple-touch-icon" sizes="76x76" href="/apple-icon-76x76.png">
		<link rel="apple-touch-icon" sizes="114x114" href="/apple-icon-114x114.png">
		<link rel="apple-touch-icon" sizes="120x120" href="/apple-icon-120x120.png">
		<link rel="apple-touch-icon" sizes="144x144" href="/apple-icon-144x144.png">
		<link rel="apple-touch-icon" sizes="152x152" href="/apple-icon-152x152.png">
		<link rel="apple-touch-icon" sizes="180x180" href="/apple-icon-180x180.png">
		<link rel="icon" type="image/png" sizes="192x192"  href="/android-icon-192x192.png">
		<link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
		<link rel="icon" type="image/png" sizes="96x96" href="/favicon-96x96.png">
		<link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
		<link rel="manifest" href="/manifest.json">
		<meta name="msapplication-TileColor" content="#ffffff">
		<meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
		<meta name="theme-color" content="#ffffff">



	</head>

	<body>
		<div id="ultraWrapper">
		
			<div id="menu">
				@include('_menu')

				<img id="menuBottomBorder" src="/images/headerBG-02.svg" alt="bottom arc" onerror="this.onerror=null; document.getElementById('header').style.borderBottom = '2em solid #565F65'; this.remove();"/>

			</div>



		<div id="header">
			<header>
				<a href="/"><img src="/images/LogoV3.svg" alt="Omusing Logo Ideas to find Ideas" onerror="this.onerror=null; this.src='/images/LogoV3.png'"/></a>
			</header>
			<div class="mobileMenuButton" onClick="openMenu()"><img class="menuButton" alt="Menu Button" src="/images/menuButton.svg" /></div>
				@if(Auth::check())
					<div id="userlogin" class="loggedin">
						<div class="avatar" id="registerAvatar" style="background-image:url('{{{ Avatar::getAvatarUrl()}}}');" onClick="showDiv('#usermenu');"><div class="avatarText"><img src="/images/gear.png" alt="gear" /></div></div>
						<div id="usermenu">
							<div class="upArrow"></div>
							<div class="welcomePhrase">Welcome, {{{Auth::user()->name}}} </div>
							<ul>
								<li><a href="/auth/edit">Edit User Info</a></li>
								<li><a href="/auth/logout">Log Out</a></li>
							</ul>
						</div>



					</div>
				@else
					<div id="userlogin">
						<a href="/auth/register" id="registerLink">register</a><a href="/auth/login" class="button">sign in</a>
					</div>
				@endif
				<input id="token" type="hidden" value="{{ csrf_token() }}">
				<input id="max" type="hidden" value="{{ Config::get('constants.MAX_WIDGETS') }}">
				<img id="headerBottomBorder" src="/images/headerBG-01.svg" alt="bottom arc" onerror="this.onerror=null; document.getElementById('header').style.borderBottom = '2em solid #565F65'; this.remove();"/>
			
		</div>

		<div id="jayz">

			<div class="secondary">
				<div id="sideMenu">
					@include('_menu')
					@include('_social')
				</div>

				@yield('secondary')

			</div>

			<div class="primary">

				@if(Session::has('success_message'))
					<div class="success message_wrapper" onscroll="killDiv('.message_wrapper', 0)"><span class="message">{{Session::get('success_message')}}</span></div>

				@endif
				@if(Session::has('failure_message'))
					<div class="failure message_wrapper"><span class="message">{{Session::get('failure_message')}}</span></div>

				@endif
				
				@if (count($errors) > 0)
				    <div class="failure message_wrapper">
				        <ul>
				            @foreach ($errors->all() as $error)
				                <li>{{ $error }}</li>
				            @endforeach
				        </ul>
				    </div>
				@endif

				@yield('primary')

			</div>

			<div class="thirdary">

				@yield('thirdary')

			</div>
			
		</div>

		<div id="footer"><a rel="license" href="http://creativecommons.org/licenses/by-nc-sa/4.0/"><img alt="Creative Commons License" style="border-width:0" src="https://i.creativecommons.org/l/by-nc-sa/4.0/80x15.png" /></a><br />Omusing content is licensed under a <a rel="license" href="http://creativecommons.org/licenses/by-nc-sa/4.0/">Creative Commons Attribution-NonCommercial-ShareAlike 4.0 International License</a>. Please also review our <a href="/terms">terms of service.</a></div>
	</div><!--end ultrawrapper-->

	</body>


	<footer>
		<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
		<script src="/jquery/jquery-ui.min.js"></script>
		<script src="/jquery/pluralize.js"></script>
		<script src="/jquery/common.js"></script>

		<!-- Latest compiled and minified JavaScript for bootstrap-->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>

		@yield('scripts')

	</footer>







</html>














