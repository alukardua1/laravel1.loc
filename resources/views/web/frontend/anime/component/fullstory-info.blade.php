<ul class="tech-info">
	<li>
		<span>Тип: </span>
		<span>
			<a href="{{route('kind', $showAnime->getKind->url)}}">{{$showAnime->getKind->name}}</a> ({{$showAnime->episodes}} эп.) {{$showAnime->duration}} мин.
		</span>
	</li>
	@if ($showAnime->broadcast)
		<li><span>Трансляция: </span>
			<span>{{$showAnime->broadcast}} {{$showAnime->broadcastTitle}}
				@if(!empty($showAnime->getChannel))
					на <a href="{{route('channel', $showAnime->getChannel->url)}}">{{$showAnime->getChannel->name}}</a>
				@endif
			</span>
		</li>
	@endif
	@if ($showAnime->getStudio)
		<li>
			<span>Студия: </span>
			<span>
			@foreach($showAnime->getStudio as $value)
					@if ($loop->last)
						<a href="{{route('studio', $value->url)}}">{{$value->name}}</a>
					@else
						<a href="{{route('studio', $value->url)}}">{{$value->name}}</a>,
					@endif
				@endforeach
		</span>
		</li>
	@endif
	<li><span>Сезон: </span> <span>{{$showAnime->seasonAired}}</span></li>
	@if ($showAnime->getCountry)
		<li><span>Страна: </span>
			<span>
			@foreach($showAnime->getCountry as $value)
					@if($loop->last)
						<a href="{{route('country', $value->url)}}">{{$value->name}}</a>
					@else
						<a href="{{route('country', $value->url)}}">{{$value->name}}</a>,
					@endif
				@endforeach
		</span>
		</li>
	@endif
	<li>
		<span>Жанр: </span><span>
			{!! $showAnime->category !!}
		</span>
	</li>
	<li>
		<span>Выпуск: </span>
		<span>
			@if ($showAnime->aired)
				c {{$showAnime->aired}}
			@endif
			@if ($showAnime->released)
				по {{$showAnime->released}}
			@endif
		</span>
	</li>
	@if ($showAnime->getRating)
		<li>
			<span>Рейтинг MPAA: </span>
			<span>
				<a href="{{route('rating', $showAnime->getRating->url)}}" data-bs-toggle="tooltip" data-bs-placement="top" title="{{$showAnime->getRating->description}}">
					{{$showAnime->getRating->name}}
				</a>
			</span>
		</li>
	@endif
	<li><span>Качество видео: </span>
		<span>
			@foreach($showAnime->getQuality as $value)
				@if ($loop->last)
					<a href="{{route('quality', $value->url)}}">{{$value->name}}</a>
				@else
					<a href="{{route('quality', $value->url)}}">{{$value->name}}</a>,
				@endif
			@endforeach
		</span>
	</li>
	<li><span>Режиссер: </span><span>[xfvalue_rezhisser]</span></li>
	<li><span>Актеры: </span><span>[xfvalue_actors]</span></li>
	<li><span>Автор оригинала: </span><span>[xfvalue_avtor-originala]</span></li>
	<li><span>Озвучка: </span>
		<span>
			@foreach($showAnime->getTranslate as $value)
				@if ($loop->last)
					<a href="{{route('translate', $value->url)}}">{{$value->name}}</a>
				@else
					<a href="{{route('translate', $value->url)}}">{{$value->name}}</a>,
				@endif
			@endforeach
		</span></li>
	<li><span>На других сайтах: </span>
		<span class="other-title">
			@foreach($showAnime->getOtherLink as $value)
				<a itemprop="url" href="{{$value->url}}" target="_blank" rel="nofollow">{{$value->title}}</a>
			@endforeach
        </span>
	</li>
	<li>
		<span>Другие названия: </span>
		<span class="other-name">
			<span itemprop="name">{{$showAnime->synonyms}}</span>
        	<span itemprop="name">{{$showAnime->japanese}}</span>
        	<span itemprop="name">{{$showAnime->english}}</span>
    	</span>
	</li>
	@if ($showAnime->license_name_ru)
		<li><span>Название лицензии в России: </span><span>{{$showAnime->license_name_ru}}</span></li>
	@endif
</ul>