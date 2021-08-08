@extends('web.backend.layout.app')
@section('title', 'Все пользователи')

@section('content')
	<div>
		<a class="btn btn-primary" href="{{route('addUserAdmin')}}" type="button">Добавить</a>
	</div>
	<div class="input-group mb-3">
		<input type="text" id="name" class="form-control" placeholder="Поиск" aria-label="Поиск" aria-describedby="name">
		<a type="button" class="btn btn-primary btn-sm" id="nameBtn" href="#">Поиск</a>
	</div>
	<div class="alert alert-success" role="alert" id='searchsuggestions' style="display: none"></div>
	<table class="table table-dark table-striped table-sm">
		<thead>
		<tr>
			<th scope="col">Логин</th>
			<th scope="col">Дата регистрации</th>
			<th scope="col">Дата посещения</th>
			<th scope="col">Количество новостей</th>
			<th scope="col">Количество просмотров</th>
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
				<th>
					{{$user->register}}
				</th>
				<td>
					{{$user->last_login}}
				</td>
				<td>
					0
				</td>
				<td>
					0
				</td>
				<td>
					<a href="{{route('editUserAdmin', $user->login)}}"><i class="far fa-edit"></i></a>
					<a href="{{route('deleteUserAdmin',  $user->login)}}"><i class="far fa-trash-alt"></i></a>
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