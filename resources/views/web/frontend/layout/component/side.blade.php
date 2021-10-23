<div class="side-nav">
	<div>
		@include('web.frontend.auth.login')
	</div>
	<div class="money">
		[banner_yandex-money]
		{banner_yandex-money}
		[/banner_yandex-money]
	</div>
	<div class="genre-all">
		<div class="side-cat">
			Категории
		</div>
		<div class="cat-item">
			<div class="cat-slave">
				<div class="side-cat-slave">
					По жанрам
				</div>
				<ul class="genre">
					@each('web.frontend.layout.component.category', $category, 'value')
				</ul>
			</div>
			<div class="cat-slave">
				<div class="side-cat-slave" data-toggle="collapse" data-target="#tip" role="button" aria-expanded="false" aria-controls="tip">
					По типам
				</div>
				<ul class="collapse genre" id="tip">
					@each('web.frontend.layout.component.kind', $kind, 'value')
				</ul>
			</div>
			<div class="cat-slave">
				<div class="side-cat-slave" data-toggle="collapse" data-target="#rating" role="button" aria-expanded="false" aria-controls="tip">
					По рейтингу
				</div>
				<ul class="collapse genre" id="rating">
					@each('web.frontend.layout.component.mpaa', $mpaa, 'value')
				</ul>
			</div>
			<div class="cat-slave">
				<div class="side-cat-slave" data-toggle="collapse" data-target="#scoring" role="button" aria-expanded="false" aria-controls="scoring">
					По озвучкам
				</div>
				<ul class="collapse genre" id="scoring">
					@each('web.frontend.layout.component.translate', $translate, 'value')
				</ul>
			</div>
			<div class="cat-slave">
				<div class="side-cat-slave" data-toggle="collapse" data-target="#season" role="button" aria-expanded="false" aria-controls="season">
					По годам
				</div>
				<ul class="collapse genre season" id="season">
					@each('web.frontend.layout.component.year', $year, 'value')
				</ul>
			</div>
			<div class="cat-slave">
				<div class="side-cat-slave" data-toggle="collapse" data-target="#country" role="button" aria-expanded="false" aria-controls="country">
					По странам
				</div>
				<ul class="collapse genre" id="country">
					@each('web.frontend.layout.component.country', $country, 'value')
				</ul>
			</div>
			<div class="cat-slave">
				<div class="side-cat-slave" data-toggle="collapse" data-target="#quality" role="button" aria-expanded="false" aria-controls="quality">
					По качеству
				</div>
				<ul class="collapse genre" id="quality">
					@each('web.frontend.layout.component.quality', $quality, 'value')
				</ul>
			</div>
		</div>
		<div class="side-cat">
			<div class="side-cat-slave">
				Популярное
			</div>
			<div class="soon">
				@each('web.frontend.layout.component.popular', $popular, 'value')
			</div>
		</div>
		<div class="side-cat">
			<div class="side-cat-slave">
				Скоро на AF
			</div>
			<div class="soon">
				@each('web.frontend.layout.component.anons', $anons, 'value')
			</div>
		</div>
		<div class="side-cat">
			<div class="side-cat-slave">
				Мы в социальных сетях
			</div>
			<div class="social">
				<ul class="list-group list-group-flush">
					<li class="list-group-item"><a class="nav-link-social" target="_blank" href="https://vk.com/animefree_ru" title="Мы в вконтакте"><i class="fab fa-vk"></i> Мы в ВКонтакте</a></li>
					<li class="list-group-item"><a class="nav-link-social" target="_blank" href="https://www.facebook.com/Animefreeru" title="Мы в facebook"><i class="fab fa-facebook-square"></i> Мы в Facebook</a></li>
					<li class="list-group-item"><a class="nav-link-social" target="_blank" href="https://discord.gg/cnJZGTxgXd" title="Мы в discord"><i class="fab fa-discord"></i> Мы в Discord</a></li>
					<li class="list-group-item"><a class="nav-link-social" target="_blank" href="https://ok.ru/group/57305631031318" title="Мы в Одноклассниках"><i class="fab fa-odnoklassniki-square"></i> Мы в Одноклассниках</a></li>
				</ul>
			</div>
		</div>
		<div class="side-cat">
			<div class="side-cat-slave">
				Статистика
			</div>
			<div class="statistik">
				{include file="engine/modules/lightstat.php?theme_light=active"}
			</div>
		</div>
	</div>
</div>