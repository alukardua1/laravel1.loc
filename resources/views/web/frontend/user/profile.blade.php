@extends('web.frontend.layout.app')

@section('title', $currentUser->login)

@section('content')
	<div class="user-prof">
		<div class="up-first">
			<h1 class="nowrap">Пользователь: {{$currentUser->login}}</h1>
			<div class="up-group">Группа: {{$currentUser->getGroup->title}}[time_limit]&nbsp;В группе до: {time_limit}[/time_limit]</div>
			<div class="up-img img-box avatar"><img src="{foto}" alt=""/></div>
			<div class="up-status">
				[online]<p class="online">В сети</p>[/online]
				[offline]<p class="offline">Не в сети</p>[/offline]
			</div>
		</div>
		<ul class="up-second fx-row">
			<li>{{$currentUser->get_anime_count}} <p>Публикаций</p></li>
			<li>{comm-num} <p>Комментариев</p></li>
			<li>{{$currentUser->email}}</li>
			[not-group=5]<li>{pm}</li>[/not-group]
		</ul>
		<ul class="up-third">
			<li>Регистрация: {registration}</li>
			<li>Заходил(а): {lastdate}</li>
			[news-num]<li>{news} [rss] RSS [/rss]</li>[/news-num]
			[comm-num]<li>{comments}</li>[/comm-num]
			[not-group=5]
			@if($currentUser->name)<li>Полное имя: {{$currentUser->name}}</li>@endif
			[land]<li>Место жительства: {land}</li>[/land]
			<li>О себе: {info}</li>
			[signature]<li>Подпись: {signature}</li>[/signature]
			[/not-group]
		</ul>
		@if(Auth::user())<div class="up-edit"> {edituser} </div>@endif
	</div>
	[not-logged]
	<div id="options" style="display:none; margin-bottom: 30px" class="form-wrap">
		<h1>Редактирование профиля:</h1>
		<div class="form-item clearfix">
			<label>Ваше Имя:</label>
			<input type="text" name="fullname" value="{fullname}" placeholder="Ваше Имя" />
		</div>
		<div class="form-item clearfix">
			<label>Ваш E-Mail:</label>
			<input type="text" name="email" value="{editmail}" placeholder="Ваш E-Mail: {editmail}" />
		</div>
		<div class="form-checks">
			{hidemail}
			<input style="margin-left: 50px" type="checkbox" id="subscribe" name="subscribe" value="1" />
			<label for="subscribe">Отписаться от подписанных новостей</label>
		</div>
		<div class="form-item clearfix">
			<label>Место жительства:</label>
			<input type="text" name="land" value="{land}" placeholder="Место жительства" />
		</div>
		<div class="form-textarea">
			<label>Список игнорируемых пользователей:</label>
			{ignore-list}
		</div>
		<div class="form-item clearfix">
			<label>Старый пароль:</label>
			<input type="password" name="altpass" placeholder="Старый пароль" />
		</div>
		<div class="form-item clearfix">
			<label>Новый пароль:</label>
			<input type="password" name="password1" placeholder="Новый пароль" />
		</div>
		<div class="form-item clearfix">
			<label>Повторите пароль:</label>
			<input type="password" name="password2" placeholder="Повторите Новый пароль" />
		</div>
		<div class="form-item clearfix">
			<label>Аватар:</label>
			<input type="file" name="image" size="28" />
		</div>
		<div class="form-item clearfix">
			<label>Сервис <a href="http://www.gravatar.com/" target="_blank">Gravatar</a>:</label>
			<input type="text" name="gravatar" value="{gravatar}" placeholder="Укажите E-Mail в этом сервисе" />
		</div>
		<div class="form-checks">
			<input type="checkbox" name="del_foto" id="del_foto" value="yes" />
			<label for="del_foto">Удалить аватар</label>
		</div>
		<div class="form-item clearfix">
			<label>Часовой пояс:</label>
			{timezones}
		</div>
		<div class="form-textarea">
			<label>О себе:</label>
			<textarea name="info" rows="5">{editinfo}</textarea>
		</div>
		<div class="form-textarea">
			<label>Подпись:</label>
			<textarea name="signature" rows="5">{editsignature}</textarea>
		</div>
		<div class="form-xfield">
			<table class="tableform">{xfields}</table>
		</div>

		<div class="form-checks">{news-subscribe}</div>
		<div class="form-checks">{comments-reply-subscribe}</div>
		<div class="form-checks">{unsubscribe}</div>

		<div class="form-submit">
			<button name="submit" class="btn btn-warning" type="submit">Отправить</button>
			<input name="submit" type="hidden" id="submit" value="submit" />
		</div>
	</div>[/not-logged]
@endsection