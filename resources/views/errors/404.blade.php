@extends('web.frontend.layout.app')
@section('title', 'Упс что то пошло не так')

@section('error')
	@if ($errors->any())
		<div class="alert alert-danger alert-dismissible fade show" role="alert">
			@foreach($errors->all() as $error)
				{{$error}}
			@endforeach
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
		</div>
	@endif
@endsection

@section('content')
	<style>
		.title {
			font-family: impact, sans-serif;
			font-size: 36pt;
			color: #ff6600;
			background-color: transparent;
		}

		.textshadow {
			text-shadow: .1rem .1rem #000;
		}

		.card {
			border: 0;
		}
	</style>
	<h1 class="font-weight-bold title textshadow">404</h1>
	<h3 class="text-info text-uppercase textshadow"><strong>Страница не найдена</strong></h3>
	<p class="font-weight-bold">Скорее всего, вы попали сюда из-за очепятки в адресе страницы.</p>
	<div class="card-text mb-4">
		<div class="container row">
			<div class="col-lg-3">
				<img class="mb-3 rounded mx-auto d-block"
					 src="/images/404.png" alt="">
			</div>
			<div class="col-lg-9">
				<p>
					<span>Попробуйте вернутся на <a class="text-success font-weight-bold" href="" onclick="history.back();return false;">предыдущую страницу</a>
                        если не помогло, тогда попробуйте вернуться на <a class="text-primary font-weight-bold" href="{{route('home')}}">главную страницу</a>
                            или свяжитесь с администрацией сайта через форму<a class="text-info font-weight-bold" href="{{route('indexFeedback')}}">обратной связи</a>
						  указав адрес ошибки</span>
				</p>
			</div>
		</div>
	</div>
@endsection