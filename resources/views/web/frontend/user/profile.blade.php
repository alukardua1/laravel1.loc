@extends('web.frontend.layout.app')

@section('title', 'Профиль пользователя '.$currentUser->login)

@section('error')
	@if ($errors->any())
		<div class="alert alert-danger alert-dismissible fade show" role="alert">
			@foreach($errors->all() as $error)
				<p>{{$error}}</p>
			@endforeach
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
		</div>
	@endif
@endsection

@section('content')
	<div id="userinfo" class="user-prof">
		<div class="up-first">
			<h1 class="nowrap">Пользователь: <span>{{$currentUser->login}}</span></h1>
			<div class="up-group">Группа: <span style="color: {{$currentUser->getGroup->color}} !important;">{{$currentUser->getGroup->title}}</span></div>
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
			<li>
				<div>{{$currentUser->comments_count}} <span>@declination($currentUser->comments_count, 'комментарий|комментария|комментариев')</span></div>
				<div>{{$currentUser->comments_reply_count}} <span>@declination($currentUser->comments_reply_count, 'ответ|ответа|ответов')</span></div>
			</li>
			<li>
				@if (Auth::user())
					@if ((!$currentUser->hide_email)and(Auth::user()->id <> $currentUser->id))
						<a href="mailto:{{$currentUser->email}}">{{$currentUser->email}}</a>
					@endif
				@endif
			</li>
			<li>
				@if ((Auth::user())and(Auth::user()->id <> $currentUser->id))
					<a target="_blank" href="#">написать ПС</a>
				@endif
			</li>
		</ul>
		<ul class="up-third">
			@if ((!$currentUser->hide_email) and (Auth::user()))
				<li>E-mail: {{$currentUser->email}}</li>
			@endif
			<li>Регистрация: {{$currentUser->created}}</li>
			<li>Заходил(а): {{$currentUser->last_logins}}</li>
			<li>
				<ul class="post-comments fx-row">
					@if (Auth::user())
						<li><a target="_blank" href="{{route('showUserAnime', $currentUser->login)}}">Просмотреть все публикации</a></li>
					@endif
					<li><a target="_blank" href="{{route('showUserRss', $currentUser->login)}}" title="RSS {{$currentUser->login}}">RSS {{$currentUser->login}}</a></li>
					@if (Auth::user())
						<li><a target="_blank" href="{{route('showUserComments', $currentUser->login)}}">Последние комментарии</a></li>
					@endif
				</ul>
			</li>
			@if (Auth::user())
				@if($currentUser->name)
					<li>Полное имя: {{$currentUser->name}}</li>
				@endif
				<li>
					Место жительства:
					<span>{{$currentUser->getCountry->title}}</span>,
					<span>{{$currentUser->city}}</span>
				</li>
				<li>
					Дата рождения:
					<span>{{$currentUser->birthdayShow}}</span>
				</li>
				<li>О себе: {{$currentUser->description}}</li>
				@if ($currentUser->signature)
					<li>Подпись: {{$currentUser->signature}}</li>
				@endif
			@endif
		</ul>
		@if (Auth::user())
			@if((Auth::id() == $currentUser->id) or (Auth::user()->getGroup->id == 1))
				<div class="up-edit">
					<a href="#" id="editBtn">редактировать профиль</a>
				</div>
			@endif
		@endif
	</div>
	@if (Auth::user())
		@if((Auth::id() == $currentUser->id) or (Auth::user()->getGroup->id == 1))
			<form id="userinfo" action="{{route('updateUser', $currentUser->login)}}" enctype="multipart/form-data" method="POST">
				@csrf
				<div id="options" style="display:none; margin-bottom: 30px" class="form-wrap">
					<h1>Редактирование профиля:</h1>
					<div class="form-item clearfix">
						<label for="login">Ваше логин (для смены обратитесь к администрации):</label>
						<input class="form-control form-control-sm" id="login" type="text" name="login" value="{{$currentUser->login}}" placeholder="Ваше логин" disabled/>
					</div>
					<div class="form-item clearfix">
						<label for="email">Ваше E-mail (для смены обратитесь к администрации):</label>
						<input class="form-control form-control-sm" id="email" type="email" name="email" value="{{$currentUser->email}}" placeholder="Ваше email" disabled/>
					</div>
					<div class="form-check form-switch">
						<input class="form-check-input" type="checkbox" name="hide_email" id="hide_email" value="1" {{$currentUser->hide_email ? 'checked' : ''}}>
						<label for="hide_email">Скрыть ваш e-mail</label>
					</div>
					<div class="form-item clearfix">
						<label for="name">Ваше Имя:</label>
						<input class="form-control form-control-sm" id="name" type="text" name="name" value="{{$currentUser->name}}" placeholder="Ваше Имя"/>
					</div>
					<div class="form-item clearfix">
						<label for="land">Страна:</label>
						<select id="land" name="land" class="js-selectize" aria-label="Место жительства">
							@foreach($country as $item)
								<option @if($currentUser->getCountry->id == $item->id) selected @endif value="{{$item->id}}">{{$item->title}}</option>
							@endforeach
						</select>
					</div>
					<div class="form-item clearfix">
						<label for="city">Город:</label>
						<input class="form-control form-control-sm" id="city" type="text" name="city" value="{{$currentUser->city}}" placeholder="Город"/>
					</div>
					<div class="form-item clearfix">
						<label for="birthday">Дата рождения (нужна для показа контента 18+):</label>
						<input class="form-control form-control-sm" id="birthday" type="date" name="birthday" value="{{$currentUser->birthday}}"
							   placeholder="Дата рождения (нужна для показа контента 18+)"/>
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
							</label>
						</div>

						<div class="form-check form-switch">
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
					<div class="form-check form-switch">
						<input class="form-check-input" type="checkbox" name="allow_mail" id="allow_mail" value="1" {{$currentUser->allow_mail ? 'checked' : ''}}>
						<label for="allow_mail">Не получать письма от других и с сайта</label>
					</div>
					<div class="form-check form-switch">
						<input class="form-check-input" type="checkbox" name="comments_reply_subscribe" id="comments_reply_subscribe"
							   value="1" {{$currentUser->comments_reply_subscribe ? 'checked' : ''}}>
						<label for="comments_reply_subscribe">Получать уведомления на e-mail при ответах на мои комментарии</label>
					</div>
					<div class="form-check form-switch">
						<input class="form-check-input" type="checkbox" name="anime_subscribe" id="anime_subscribe" value="1" {{$currentUser->anime_subscribe ? 'checked' : ''}}>
						<label for="anime_subscribe">Получать уведомления на e-mail при обновлении/выходе аниме</label>
					</div>

					<div class="form-submit">
						<button name="submit" class="btn btn-warning" type="submit">@lang('main.success')</button>
					</div>
				</div>
			</form>
		@endif
	@endif
@endsection