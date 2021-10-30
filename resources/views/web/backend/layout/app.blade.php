<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" prefix="og: http://ogp.me/ns#">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta name="robots" content="index, follow">
	<meta name="docsearch:language" content="ru">
	<meta name="docsearch:version" content="5.0">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<title>Панель управления - @yield('title')</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3"
		  crossorigin="anonymous">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
	<!--Import Google Icon Font-->
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link rel="stylesheet" href="{{ asset('css/admin.css') }}">
	<link rel="stylesheet" href="{{ asset('css/selectize.bootstrap4.css') }}">
</head>
<body>
<nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
	<a class="navbar-brand col-md-3 col-lg-2 mr-0 px-3" target="_blank" href="{{route('home')}}">
		<span data-feather="rewind"></span>
		Вернутся на сайт
	</a>
	<button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-toggle="collapse" data-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false"
			aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
	</button>
</nav>
<div class="container-fluid" id="app">
	<div class="row">
		@include('web.backend.layout.components.side_admin')
		<main class="ml-sm-auto col-lg-10 px-md-4">
			<div class="card bg-dark mt-5">
				<div class="card-body">
					@yield('content')
				</div>
			</div>
		</main>
	</div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://unpkg.com/feather-icons"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
		crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.0.0-beta.13/chart.js" integrity="sha512-JS/WtaFglOYbXbMt9s52TO0QEzWljfCG2dFTC6aW9bJdP40kC37uoV+EzI06/LgpfX65oTnS1jUXxscH2xlG1Q=="
		crossorigin="anonymous"></script>
<script src="https://cdn.ckeditor.com/ckeditor5/26.0.0/classic/ckeditor.js"></script>
<script src="https://cdn.ckeditor.com/ckeditor5/26.0.0/classic/translations/ru.js"></script>
<script type="text/javascript" src="{{ asset('js/selectize.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/admin.js') }}"></script>
</body>
</html>