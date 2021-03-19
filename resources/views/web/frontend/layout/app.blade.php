<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<link rel="apple-touch-icon" sizes="180x180" href="{{ asset('images/apple-touch-icon.png') }}">
	<link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/favicon-32x32.png') }}">
	<link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/favicon-16x16.png') }}">
	<link rel="manifest" href="{{ asset('images/anime-free.webmanifest') }}">
	<link rel="mask-icon" href="{{ asset('images/safari-pinned-tab.svg') }}" color="#5bbad5">
	<meta name="msapplication-TileColor" content="#da532c">
	<meta name="theme-color" content="#ffffff">
	<link rel="stylesheet" href="{{ asset('css/app.css') }}">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I"
		  crossorigin="anonymous">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
	<link rel="stylesheet" href="{{ asset('css/owl.carousel.css') }}">
	<link rel="stylesheet" href="{{ asset('css/owl.theme.default.css') }}">
	<link rel="stylesheet" href="{{ asset('css/style.css') }}">
	<link rel="stylesheet" href="{{ asset('css/selectize.bootstrap4.css') }}">
	<title>@yield('title')</title>
	<meta name="description" content="@yield('description')">
	<meta name="keywords" content="@yield('keywords')">
</head>
<body>
<header>
	@include('web.frontend.layout.component.nav')
</header>

<main id="app" class="container">
	<div class="main-content">
		@not_available('showAnime')
		<div id="carousel" class="owl-carousel owl-theme">
			@include('web.frontend.anime.component.carousel')
		</div>
		@endnot_available
		@not_available('showAnime')
		<div class="search">
			<div class="form-group" id="q_search">
				<input class="form-control mr-2" type="search" placeholder="Поиск..." aria-label="Поиск..." id="search" name="search">
			</div>
			{{--			<form class="d-flex" id="q_search" method="post">--}}
			{{--				<input class="form-control mr-2" type="search" placeholder="Поиск..." aria-label="Поиск..." id="story" name="story">--}}
			{{--				<input type="hidden" name="do" value="search">--}}
			{{--				<input type="hidden" name="subaction" value="search">--}}
			{{--				--}}{{--				<button class="btn btn-outline-success" type="submit">Поиск</button>--}}
			{{--			</form>--}}
		</div>
		@endnot_available
		<div class="content">
			<div class="side">
				@include('web.frontend.layout.component.side')
			</div>
			<div class="el1">
				<div class="main">
					@section('category-title')
					@show
					@section('category-description')
					@show
					@section('error')
					@show
					@yield('content')
				</div>
				<div class="info-footer">
					@include('web.frontend.layout.component.info-footer')
				</div>
			</div>
		</div>
	</div>
</main>
<footer>

</footer>
<script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/owl.carousel.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
		integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js"
		integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/" crossorigin="anonymous"></script>
<script src="https://cdn.ckeditor.com/ckeditor5/26.0.0/classic/ckeditor.js"></script>
<script src="https://cdn.ckeditor.com/ckeditor5/26.0.0/classic/translations/ru.js"></script>
<script src="https://yastatic.net/es5-shims/0.0.2/es5-shims.min.js"></script>
<script src="https://yastatic.net/share2/share.js"></script>
<script type="text/javascript" src="{{ asset('js/selectize.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/my.js') }}"></script>
</body>
</html>
