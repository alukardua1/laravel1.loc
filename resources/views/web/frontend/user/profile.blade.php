@extends('web.frontend.layout.app')

@section('title', 'Профиль пользователя '.$currentUser->login)

@section('error')
	@error('profile_photo_path')
	<div class="alert alert-danger alert-dismissible fade show" role="alert">
		@foreach($errors->all() as $error)
			{{$error}}
		@endforeach
		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		</button>
	</div>
	@enderror
@endsection

@section('content')
	<div id="userinfo" class="user-prof">
		<div class="up-first">
			<h1 class="nowrap">Пользователь: <span>{{$currentUser->login}}</span></h1>
			<div class="up-group">Группа: <span class="{{$currentUser->getGroup->color}}">{{$currentUser->getGroup->title}}</span></div>
			<div class="up-img img-box avatar"><img src="{{$currentUser->profile_photo_url}}" alt="{{$currentUser->login}}"/></div>
			<div class="up-status">
				@if ($currentUser->is_online)
					<p class="online">В сети</p>
				@else
					<p class="offline">Не в сети</p>
				@endif
			</div>
		</div>
		<ul class="up-second fx-row">
			<li>{{$currentUser->anime_count}} <p>Публикаций</p></li>
			<li>{{$currentUser->comments_count}} <p>Комментариев</p></li>
			<li>{{$currentUser->email}}</li>
			@if (Auth::user())
				<li>{pm}</li>@endif
		</ul>
		<ul class="up-third">
			<li>Регистрация: {{$currentUser->created_at}}</li>
			<li>Заходил(а): {{$currentUser->last_login}}</li>
			<li>
				<a href="{{route('currentUserAnime', $currentUser->login)}}">Просмотреть все публикации</a>
			</li>
			<li>
				<a href="{{route('currentUserRss', $currentUser->login)}}" title="Отслеживание всех статей пользователя по RSS">
					Отслеживание всех статей пользователя по RSS
				</a>
			</li>
			<li>
				<a href="#">Последние комментарии</a>
			</li>
			@if (Auth::user())
				@if($currentUser->name)
					<li>Полное имя: {{$currentUser->name}}</li>
				@endif
				<li>
					Место жительства:
					<ul class="up-third">
						<li>Страна: {{$currentUser->getCountry->name}}</li>
						<li>Город: {{$currentUser->city}}</li>
					</ul>
				</li>
				<li>О себе: {{$currentUser->description}}</li>
				@if ($currentUser->signature)
					<li>Подпись: {{$currentUser->signature}}</li>
				@endif
			@endif
		</ul>
		@if (Auth::user())
			@if((Auth::id() == $currentUser->id)or(Auth::user()->getGroup->id == 1))
				<div class="up-edit">
					<a href="#" id="editBtn">редактировать профиль</a>
				</div>
			@endif
		@endif
	</div>
	@if (Auth::user())
		@if((Auth::id() == $currentUser->id)or($currentUser->getGroup->id == 1))
			<form id="userinfo" action="{{route('currentUserUpdate', $currentUser->login)}}" enctype="multipart/form-data" method="POST">
				@csrf
				<div id="options" style="display:none; margin-bottom: 30px" class="form-wrap">
					<h1>Редактирование профиля:</h1>
					<div class="form-item clearfix">
						<label for="name">Ваше Имя:</label>
						<input class="form-control form-control-sm" id="name" type="text" name="name" value="{{$currentUser->name}}" placeholder="Ваше Имя"/>
					</div>
					<div class="form-item clearfix">
						<label for="land">Страна:</label>
						<select id="land" name="land" class="js-selectize" aria-label="Место жительства" placeholder="Выберите страну...">
							@foreach($menu as $item)
								<option @if($currentUser->getCountry->id == $item->id) selected @endif value="{{$item->id}}">{{$item->name}}</option>
							@endforeach
						</select>
					</div>
					<div class="form-item clearfix">
						<label for="city">Город:</label>
						<input class="form-control form-control-sm" id="city" type="text" name="city" value="{{$currentUser->city}}" placeholder="Город"/>
					</div>
					<div class="form-item clearfix">
						<label for="altpass">Старый пароль:</label>
						<input id="altpass" class="form-control form-control-sm" type="password" name="altpass" placeholder="Старый пароль"/>
					</div>
					<div class="form-item clearfix">
						<label for="password1">Новый пароль:</label>
						<input class="form-control form-control-sm" id="password1" type="password" name="password1" placeholder="Новый пароль"/>
					</div>
					<div class="form-item clearfix">
						<label for="password2">Повторите пароль:</label>
						<input class="form-control form-control-sm" id="password2" type="password" name="password2" placeholder="Повторите Новый пароль"/>
					</div>
					<div class="form-item clearfix">
						<label for="profile_photo_path">Аватар:</label>
						<div class="form-file">
							<input type="file" class="form-file-input" name="profile_photo_path" id="profile_photo_path">
							<label class="form-file-label" for="profile_photo_path">
								<span class="form-file-text">Загрузите автар...</span>
								<span class="form-file-button">Выбрать</span>
							</label>
						</div>

						<div class="form-checks">
							<input class="form-check-input" type="checkbox" name="del_foto" id="del_foto" value="yes"/>
							<label for="del_foto">Удалить аватар</label>
						</div>
					</div>
					<div class="form-textarea">
						<label for="description">О себе:</label>
						<textarea class="form-control" id="description" name="description" rows="5">{{$currentUser->description}}</textarea>
					</div>
					<div class="form-textarea">
						<label for="signature">Подпись:</label>
						<textarea class="form-control" id="signature" name="signature" rows="5">{{$currentUser->signature}}</textarea>
					</div>

					<div class="form-checks">{news-subscribe}</div>
					<div class="form-checks">{comments-reply-subscribe}</div>
					<div class="form-checks">{unsubscribe}</div>

					<div class="form-submit">
						<button name="submit" class="btn btn-warning" type="submit">Отправить</button>
					</div>
				</div>
			</form>
		@endif
	@endif
@endsection