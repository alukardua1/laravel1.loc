<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<link rel="stylesheet" href="{{ asset('css/app.css') }}">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css"
		  integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
	<link rel="stylesheet" href="{{ asset('css/style.css') }}">
	<title>@yield('title')</title>
</head>
<body>
<header>
	<navigate>
		@include('web.frontend.layout.nav')
	</navigate>
	@section('sidebar')
		This is the master sidebar.
	@show
</header>

<main class="container">
	<div class="main-content">
		[not-available=showfull]
		<div id="carousel" class="owl-carousel owl-theme">
			{custom template="modules/carousel" xfields="ongoing" aviable="global" limit="100" from="0" cache="no"}
		</div>
		[/not-available]
		[not-available=showfull]
		<div class="search">
			<form class="d-flex" id="q_search" method="post">
				<input class="form-control mr-2" type="search" placeholder="Поиск..." aria-label="Поиск..." id="story" name="story">
				<div id="search"></div>
				<input type="hidden" name="do" value="search">
				<input type="hidden" name="subaction" value="search">
				{*<button class="btn btn-outline-success" type="submit">Поиск</button>*}
			</form>
		</div>
		[/not-available]
		<div class="content">
			<div class="side">
				@include('web.frontend.layout.menu')
				{include file="modules/side.tpl"}
			</div>
			<div class="el1">
				<div class="main">
					[available=cat]
					[category-title]
					<div class="category-title">
						<h1>{category-title}</h1>
					</div>
					[/category-title]
					[category-description]
					<div class="category-description">
						<p>{category-description}</p>
					</div>
					[/category-description]
					[/available]
					[not-available=cat]
					[page-title]
					<div class="category-title">
						<h1>{page-title}</h1>
					</div>
					[page-description]
					<div class="category-description">
						<p>{page-description}</p>
					</div>
					[/page-description]
					[/page-title]
					[/not-available]
					{info}
					@yield('content')
				</div>
				[not-available=showfull]
				<div class="info-footer">
					{include file="modules/info-footer.tpl"}
				</div>
				[/not-available]
			</div>
		</div>
	</div>
</main>
<footer>

</footer>
<script src="{{ asset('js/app.js') }}" defer></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
		integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js"
		integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/" crossorigin="anonymous"></script>
</body>
</html>
