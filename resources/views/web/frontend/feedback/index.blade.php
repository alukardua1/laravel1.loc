@extends('web.frontend.layout.app')

@section('title', 'Обратная связь')
@section('description', "Форма обратной связи")

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
	<form action="{{route('sendFeedback')}}" method="POST">
		@csrf
		<label for="name">Заголовок</label>
		<input type="text" class="form-control" name="name" id="name">
		<label for="login">Ваше имя</label>
		@if (Auth::user())
			<input type="text" class="form-control" name="login" id="login" value="{{Auth::user()->login}}" disabled>
			<input type="hidden" class="form-control" name="login" id="login" value="{{Auth::user()->login}}">
			<input type="hidden" class="form-control" name="email" id="email" value="{{Auth::user()->email}}">
		@else
			<input type="text" class="form-control" name="login" id="login">
			<label for="email">Ваша почта</label>
			<input type="email" class="form-control" name="email" id="email">
		@endif
		<label for="message1">Ваше сообщение</label>
		<textarea name="message1" id="message1" cols="30" rows="10" class="form-control"></textarea>
		<div class="btn-group mt-3">
			<button type="submit" class="btn btn-success">Отправить</button>
			<button type="reset" class="btn btn-danger">Очистить</button>
		</div>
	</form>
@endsection
