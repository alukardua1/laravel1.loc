<ul class="tech-info">
	<li><span>Тип: </span> <span>{{ $showAnime->getKind->name }} ({{$showAnime->episodes}} эп.) {{$showAnime->duration}} мин.</span></li>
	@if ($showAnime->broadcast)
		<li><span>Трансляция: </span>
			<span>{{$showAnime->broadcast}} {{$showAnime->broadcastTitle}} на {{$showAnime->getChannel->name}}</span>
		</li>
	@endif
	<li>
		<span>Студия: </span>
		@if (!$showAnime->getStudio)
			не указана
		@endif
		@foreach($showAnime->getStudio as $value)
			@if ($loop->last)
				<span>{{$value->name}}</span>
			@else
				<span>{{$value->name}}</span>,
			@endif
		@endforeach
	</li>
	<li><span>Сезон: </span> <span>{{$showAnime->seasonAired}}</span></li>
	[xfgiven_proizvodstvo]
	<li><span>Страна: </span><span>[xfvalue_proizvodstvo]</span></li>
	[/xfgiven_proizvodstvo]
	<li>
		<span>Жанр: </span><span>
			{!! $showAnime->category !!}
		</span>
	</li>
	<li>
		<span>Выпуск: </span>
		<span>
			@if ($showAnime->aired_on)
				c {{date('d.m.Y', strtotime($showAnime->aired_on))}}
			@endif
			@if ($showAnime->released_on)
				по {{date('d.m.Y', strtotime($showAnime->released_on))}}
			@endif
		</span>
	</li>
	<li><span>Рейтинг MPAA: </span><span>[xfvalue_rating]</span></li>
	<li><span>Качество видео: </span><span>[xfvalue_quality]</span></li>
	<li><span>Режиссер: </span><span>[xfvalue_rezhisser]</span></li>
	<li><span>Актеры: </span><span>[xfvalue_actors]</span></li>
	<li><span>Автор оригинала: </span><span>[xfvalue_avtor-originala]</span></li>
	<li><span>Озвучка: </span><span>[xfvalue_ozvuchka][xfnotgiven_ozvuchka] Не указана [/xfnotgiven_ozvuchka]</span></li>
	<li><span>На других сайтах: </span>
		<span class="other-title">
			@foreach($showAnime->getOtherLink as $value)
				<a itemprop="url" href="{{$value->url}}" target="_blank" rel="nofollow">{{$value->title}}</a>
			@endforeach
        </span>
	</li>
	<li><span>Другие названия: </span>
		<span class="other-name">
			<span itemprop="name">[xfvalue_nazvanie-romadzi]</span>
        <span itemprop="name">[xfvalue_po-yaponski]</span>
        <span itemprop="name">[xfvalue_po-angliyski]</span>
    </span>
	</li>
	<li><span>Название лицензии в России: </span><span>[xfvalue_lic_ru_title]</span></li>
</ul>