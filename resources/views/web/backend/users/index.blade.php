@extends('web.backend.layout.app')
@section('title', 'Все пользователи')

@section('content')
	<div>
		<a class="btn btn-outline-success" href="{{route('addUserAdmin')}}" type="button">Добавить</a>
	</div>
	<div class="input-group mb-3">
		<input type="text" id="name" class="form-control" placeholder="Поиск" aria-label="Поиск" aria-describedby="name">
		<a type="button" class="btn btn-outline-primary btn-sm" id="nameBtn" href="#">Поиск</a>
	</div>
	<div class="alert alert-success" role="alert" id='searchsuggestions' style="display: none"></div>
	<table class="table table-dark table-striped table-sm">
		<thead>
		<tr>
			<th scope="col">Логин</th>
			<th scope="col">Дата</th>
			<th scope="col">Количество</th>
			<th scope="col">Действия</th>
		</tr>
		</thead>
		<tbody>
		@foreach($allUser as $user)
			<tr>
				<td>
					<div class="row">
						<div class="col-4"><img src="{{$user->profile_photo_path}}" alt="{{$user->login}}"></div>
						<div class="col">
							<h6><a href="{{route('editUserAdmin', $user->login)}}">{{$user->login}}</a></h6>
							<span style="color: {{$user->getGroup->color}}">
							{{$user->getGroup->title}}
							</span>
						</div>
					</div>
				</td>
				<th scope="row" class="id_row">
					<ul class="list-group-flush">
						<li class="list-group-item">Регистрации: {{$user->register}}</li>
						<li class="list-group-item">Посещения: {{$user->last_login}}</li>
					</ul>
				</th>
				<td class="id_row">
					<ul class="list-group-flush">
						<li class="list-group-item">Новостей: 0</li>
						<li class="list-group-item">Комментариев: 0</li>
					</ul>
				</td>
				<td>
					<div class="btn-group">
						<a type="button" class="btn" href="{{route('editUserAdmin', $user->login)}}"><i class="far fa-edit"></i></a>
						<a type="button" class="btn" href="{{route('deleteUserAdmin',  $user->login)}}"><i class="far fa-trash-alt"></i></a>
					</div>
				</td>
			</tr>
		@endforeach
		</tbody>
	</table>
	<!--Pagination-->
	@if($allUser->total() > $allUser->count())
		{{ $allUser->links('web.frontend.vendor.pagination.bootstrap-4') }}
	@endif
	<!--Pagination-->
@endsection