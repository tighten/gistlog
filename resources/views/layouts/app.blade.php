<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>{{ isset($pageTitle) ? $pageTitle . ' | ' : '' }}Gistlog</title>

	@yield ('meta')

	<link href="/css/app.css" rel="stylesheet">
	@if (isset($gistlog) && $gistlog->isSecret())
	<meta name="robots" content="noindex, nofollow">
	@endif

	<!-- Fonts -->
	<link rel="stylesheet" href="//brick.a.ssl.fastly.net/Roboto:300,400,700/Linux+Libertine:400,400i,700,700i">
	<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/highlight.js/8.4/styles/github.min.css">

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>
<body>
	<nav class="navbar navbar-default">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#primary-nav-collapse">
					<span class="u-sr-only">Toggle Navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="/"><img src="/img/gistlog-logo.png" class="logo" alt="Gistlog"></a>
			</div>

			<div class="collapse navbar-collapse" id="primary-nav-collapse">
				<ul class="nav navbar-nav">
					<li><a href="/">Create a New Gistlog</a></li>
				</ul>
			</div>
		</div>
	</nav>

	@include ('partials.flash-messages')

	@yield('content')

	<!-- Scripts -->
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/highlight.js/8.4/highlight.min.js"></script>

	@if (env('APP_ENV') == 'production')
	<script>
		(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
			(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
			m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
			})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

		ga('create', 'UA-40114814-7', 'auto');
		ga('send', 'pageview');

	</script>
	@endif

	@yield('scripts')
</body>
</html>
