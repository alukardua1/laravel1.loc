<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
	<div class="container">
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<a class="navbar-brand brand-font" href="/">
			<img src="/images/logo2.png" alt="AnimeFree" class="icon" itemprop="logo">
			ANIME<strong>free</strong>
		</a>
		<div class="collapse navbar-collapse" id="navbarTogglerDemo03">
			<ul class="navbar-nav mr-auto mb-2 mb-lg-0">
				<li class="nav-item">
					<a class="nav-link" aria-current="page" href="/xfsearch/ongoing/">Онгоинги</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="/pravoobladatelyam.html">© Правообладателям</a>
				</li>
{{--				<li class="nav-item">--}}
{{--					<a class="nav-link" href="/xfsearch/ongoing/">Онгоинги</a>--}}
{{--				</li>--}}
				<li class="nav-item dropdown d-block d-xl-none">
					<a class="dropdown-toggle nav-link" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-expanded="false">
						По жанрам
					</a>
					<ul class="genre genre-dropdown-menu dropdown-menu" aria-labelledby="dropdownMenuLink">
						@include('web.frontend.layout.menu')
					</ul>
				</li>
				<li class="nav-item">
					<a class="nav-link" target="_blank" href="https://vk.com/animefree_ru" title="Мы в вконтакте"><i class="fab fa-vk"></i></a>
				</li>
				<li class="nav-item">
					<a class="nav-link" target="_blank" href="https://www.facebook.com/Animefreeru" title="Мы в facebook"><i class="fab fa-facebook-square"></i></a>
				</li>
				<li class="nav-item">
					<a class="nav-link" target="_blank" href="https://discord.gg/cnJZGTxgXd" title="Мы в discord"><i class="fab fa-discord"></i></a>
				</li>
				<li class="nav-item">
					<a class="nav-link" target="_blank" href="https://ok.ru/group/57305631031318" title="Мы в Одноклассниках"><i class="fab fa-odnoklassniki-square"></i></a>
				</li>
				<li class="nav-item d-block d-xl-none">
					<div class="dropdown">
						<a class="dropdown-toggle nav-link" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-expanded="false">
							Авторизация
						</a>
						<ul class="login login-dropdown-menu dropdown-menu" aria-labelledby="dropdownMenuLink">
							{login}
						</ul>
					</div>
				</li>
			</ul>
		</div>
	</div>
</nav>