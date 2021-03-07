@extends('web.frontend.layout.app')

@section('title', $currentUser->login)

@section('content')
	<div class="user-prof">
		<div class="up-first">
			<h1 class="nowrap">Пользователь: {{$currentUser->login}}</h1>
			<div class="up-group">Группа: {{$currentUser->getGroup->title}}</div>
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
			<li>{{$currentUser->get_anime_count}} <p>Публикаций</p></li>
			<li>{comm-num} <p>Комментариев</p></li>
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
					<li>Подпись: {{$currentUser->signature}}</li>[/signature]
				@endif
			@endif
		</ul>
		@if((Auth::id() == $currentUser->id)or($currentUser->getGroup->id == 1))
			<div class="up-edit">
				<a href="#" id="editBtn">редактировать профиль</a>
			</div>
		@endif
	</div>
	@if((Auth::id() == $currentUser->id)or($currentUser->getGroup->id == 1))
		<form action="{{route('currentUserUpdate', $currentUser->login)}}" enctype="multipart/form-data" method="POST">
			@csrf
			<div id="options" style="display:none; margin-bottom: 30px" class="form-wrap">
				<h1>Редактирование профиля:</h1>
				<div class="form-item clearfix">
					<label>Ваше Имя:</label>
					<input type="text" name="fullname" value="{{$currentUser->name}}" placeholder="Ваше Имя"/>
				</div>
				<div class="form-checks">
					{hidemail}
					<input style="margin-left: 50px" type="checkbox" id="subscribe" name="subscribe" value="1"/>
					<label for="subscribe">Отписаться от подписанных новостей</label>
				</div>
				<div class="form-item clearfix">
					<label>Страна:</label>
					<select name="land" class="js-selectize" aria-label="Место жительства">
						@foreach($menu as $item)
							<option @if($currentUser->getCountry->id == $item->id) selected @endif value="{{$item->id}}">{{$item->name}}</option>
						@endforeach
					</select>
				</div>
				<div class="form-item clearfix">
					<label>Город:</label>
					<input type="text" name="city" value="{{$currentUser->city}}" placeholder="Город"/>
				</div>
				<div class="form-textarea">
					<label>Список игнорируемых пользователей:</label>
					<select id="ignore" name="ignore[]" class="js-selectize" aria-label="Список игнорируемых пользователей" multiple>
						@foreach(\App\Models\User::all() as $item)
							<option {{--@if($currentUser->getCountry->id == $item->id) selected @endif--}} value="{{$item->id}}">{{$item->name}}</option>
						@endforeach
					</select>
				</div>
				<div class="form-item clearfix">
					<label>Старый пароль:</label>
					<input type="password" name="altpass" placeholder="Старый пароль"/>
				</div>
				<div class="form-item clearfix">
					<label>Новый пароль:</label>
					<input type="password" name="password1" placeholder="Новый пароль"/>
				</div>
				<div class="form-item clearfix">
					<label>Повторите пароль:</label>
					<input type="password" name="password2" placeholder="Повторите Новый пароль"/>
				</div>
				<div class="form-item clearfix">
					<label>Аватар:</label>
					<input type="file" name="image" size="28"/>
				</div>
				<div class="form-item clearfix">
					<label>Сервис <a href="http://www.gravatar.com/" target="_blank">Gravatar</a>:</label>
					<input type="text" name="gravatar" value="{gravatar}" placeholder="Укажите E-Mail в этом сервисе"/>
				</div>
				<div class="form-checks">
					<input type="checkbox" name="del_foto" id="del_foto" value="yes"/>
					<label for="del_foto">Удалить аватар</label>
				</div>
				<div class="form-textarea">
					<label>О себе:</label>
					<textarea name="info" rows="5">{{$currentUser->description}}</textarea>
				</div>
				<div class="form-textarea">
					<label>Подпись:</label>
					<textarea name="signature" rows="5">{{$currentUser->signature}}</textarea>
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
@endsection