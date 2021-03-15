<!doctype html>
<html lang="ru" prefix="og: http://ogp.me/ns#">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="robots" content="index, follow">
	<meta name="docsearch:language" content="ru">
	<meta name="docsearch:version" content="5.0">
	<title>@yield('title')</title>
	<link rel="stylesheet" href="{{ asset('css/app.css') }}">
<!--	<link rel="stylesheet" href="{{ asset('css/bootstrap/bootstrap.css') }}">
	<link rel="stylesheet" href="{{ asset('css/bootstrap/mdb.css') }}">-->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">

	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
	<!--Import Google Icon Font-->
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link rel="stylesheet" href="{{ asset('css/admin.css') }}">
	<link rel="stylesheet" href="{{ asset('css/selectize.bootstrap4.css') }}">
</head>
<body>
<nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
	<a class="navbar-brand col-md-3 col-lg-2 mr-0 px-3" href="#">Название компании</a>
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
<script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
<!--<script type="text/javascript" src="{{ asset('js/bootstrap/bootstrap.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/bootstrap/mdb.js') }}"></script>-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.24.1/feather.min.js" integrity="sha384-EbSscX4STvYAC/DxHse8z5gEDaNiKAIGW+EpfzYTfQrgIlHywXXrM9SUIZ0BlyfF"
		crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.0.0-beta.13/chart.js" integrity="sha512-JS/WtaFglOYbXbMt9s52TO0QEzWljfCG2dFTC6aW9bJdP40kC37uoV+EzI06/LgpfX65oTnS1jUXxscH2xlG1Q==" crossorigin="anonymous"></script>
<script src="https://cdn.ckeditor.com/ckeditor5/26.0.0/classic/ckeditor.js"></script>
<script src="https://cdn.ckeditor.com/ckeditor5/26.0.0/classic/translations/ru.js"></script>
<script type="text/javascript" src="{{ asset('js/selectize.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/admin.js') }}"></script>
</body>
</html>