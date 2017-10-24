
<!doctype html>
<html lang="en">
	<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="">
	<link rel="icon" href="../../../../favicon.ico">

	<title>Album example for Bootstrap</title>

	<!-- Bootstrap core CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">

	<!-- Custom styles for this template -->
	<link href="{{ url('css/blog.css') }}" rel="stylesheet">
	</head>

	<body>

	<header>
		@include ('partials.nav')
		<div class="blog-header">
			<div class="container">
				<h1 class="blog-title">The Bootstrap Blog</h1>
				<p class="lead blog-description">An example blog template built with Bootstrap.</p>
			</div>
		</div>
	</header>

	<main role="main">
		<div class="container">
			<div class="row">
				
				@yield ('content')
				
			</div>
		</div>
	</main>

	@include ('partials.footer')
	
	<script>
		Holder.addTheme('thumb', {
		bg: '#55595c',
		fg: '#eceeef',
		text: 'Thumbnail'
		});
	</script>
	</body>
</html>
