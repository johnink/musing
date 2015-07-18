<!DOCTYPE html>
<html>

	<!-- John Ink © 2015 www.johnink.com www.barelyanimated.com-->
	<head>
		<title>@yield('title')</title>
		<meta name="description" content="@yield('description')"/>
		<meta name="keywords" content="@yield('keywords')" />
		<meta name="author" content="John Ink" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta charset="UTF-8" />
		<link rel="stylesheet" type="style/css" href="style/normalize.css" />
		<link rel="stylesheet" type="style/css" href="style/base.css" />


	</head>

	<body>
		<header>OhMusing!</header>
			<div id="jayz">
				@yield('content')
			</div>


	</body>

	<footer>
		<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
		<script src="jquery/common.js"></script>
		@yield('scripts')

	</footer>







</html>














