@if (Auth::user())
	<div class="mb-3 card-person">
		<div class="avatar">
			<img src="{{Auth::user()->profile_photo_url}}" alt="{{Auth::user()->login}}" data-toggle="tooltip" data-html="true" title='{group}: {{Auth::user()->login}}'>
		</div>
		<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
			@csrf
		</form>
		<a href="{{route('logout')}}" type="button" class="btn btn-outline-light logout"
		   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Выйти <i class="fas fa-sign-in ml-1"></i></a>
		<ul class="urls">
			@admin_link
			<li><a target="_blank" href="{{route('dashboard')}}">Админпанель</a></li>
			@endadmin_link
			<li><a href="{{route('currentUser', Auth::user()->login)}}">Мой профиль</a></li>
			<li><a href="{{route('favorite', Auth::user()->login)}}">Закладки<span>{{Auth::user()->favorites_count}}</span></a></li>
			<li><a href="{pm-link}">Сообщения<span>{new-pm} из {all-pm}</span></a></li>
		</ul>
	</div>
@else
	<div class="side-cat-slave" data-toggle="collapse" data-target="#login" role="button" aria-expanded="false" aria-controls="login">
		Авторизация
	</div>

	<div class="collapse" id="login">
		<form class="form-login mb-3" method="post" action="{{ route('login') }}">
			@csrf
			<div class="mb-3">
				<label for="{{Config::get('secondConfig.login_email')}}" class="form-label">
					@if (Config::get('secondConfig.login_email') == 'login')
						Логин
					@else
						E-mail
					@endif
				</label>
				<input id="{{Config::get('secondConfig.login_email')}}" type="text" class="form-control @error(Config::get('secondConfig.login_email')) is-invalid @enderror" name="{{Config::get('secondConfig.login_email')}}" value="{{ old(Config::get('secondConfig.login_email')) }}"
					   required autocomplete="{{Config::get('secondConfig.login_email')}}" autofocus>
				@error(Config::get('secondConfig.login_email'))
				<span class="invalid-feedback" role="alert">
					<strong>{{ $message }}</strong>
				</span>
				@enderror
			</div>
			<div class="mb-3">
				<label for="password" class="form-label">Пароль:</label>
				<input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required
					   autocomplete="current-password">
				@error('password')
				<span class="invalid-feedback" role="alert">
					<strong>{{ $message }}</strong>
				</span>
				@enderror
			</div>
			<div class="mb-3 form-check">
				<input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
				<label class="form-check-label" for="remember">Запомнить</label>
			</div>
			<div class="mb-3">
				<p>Забыли <a href="{lostpassword-link}" class="blue-text ml-1">пароль?</a></p>
				<p><a class="right" href="{{route('register')}}">Регистрация</a></p>
			</div>
			<div class="row">
				<div class="col-3">
					<button type="submit" class="btn btn-outline-light mb-3">Войти</button>
				</div>
				<div class="col cocial">
					[facebook]
					<a type="button" href="{facebook_url}" title="Вход через Facebook" class="btn btn-outline-light" data-toggle="tooltip"
					   data-placement="bottom">
						<i class="fab fa-facebook-f text-center"></i>
					</a>
					[/facebook][vk]
					<a type="button" href="{vk_url}" title="Вход через VK" class="btn btn-outline-light" data-toggle="tooltip"
					   data-placement="bottom">
						<i class="fab fa-vk"></i>
					</a>
					[/vk][odnoklassniki]
					<a type="button" href="{odnoklassniki_url}" title="Вход через Odnoklassniki" class="btn btn-outline-light" data-toggle="tooltip"
					   data-placement="bottom">
						<i class="fab fa-odnoklassniki"></i>
					</a>
					[/odnoklassniki][yandex]
					<a type="button" href="{yandex_url}" title="Вход через Yandex" class="btn btn-outline-light" data-toggle="tooltip"
					   data-placement="bottom">
						<i class="fab fa-yandex-international"></i>
					</a>
					[/yandex][google]
					<a type="button" href="{google_url}" title="Вход через Google" class="btn btn-outline-light" data-toggle="tooltip"
					   data-placement="bottom">
						<i class="fab fa-google"></i>
					</a>
					[/google][mailru]
					<a type="button" href="{mailru_url}" title="Вход через Mail.ru" class="btn btn-outline-light" data-toggle="tooltip"
					   data-placement="bottom">
						<i class="fas fa-at"></i>
					</a>
					[/mailru]
				</div>
			</div>
		</form>
	</div>
@endif