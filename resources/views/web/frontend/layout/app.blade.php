<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<link rel="stylesheet" href="{{ asset('css/app.css') }}">
	<title>@yield('title')</title>
</head>
<body>
@section('sidebar')
	This is the master sidebar.
@show

<div class="container">
	@include('web.frontend.layout.menu')




	@yield('content')
</div>

<script src="{{ asset('js/app.js') }}" defer></script>
</body>
</html>
