<ul class="tech-info">
	<li>
		<span>Тип: </span>
		<span>
			<a href="{{route('showKind', $show->getKind->url)}}">{{$show->getKind->name}}</a> ({{$show->episodes}} эп.) {{$show->duration}} мин.
		</span>
	</li>
	@if ($show->broadcast)
		<li><span>Трансляция: </span>
			<span>{{$show->broadcast}} {{$show->broadcastTitle}}
				@if(!empty($show->getChannel))
					на <a href="{{route('showChannel', $show->getChannel->url)}}">{{$show->getChannel->title}}</a>
				@endif
			</span>
		</li>
	@endif
	@if ($show->getStudio)
		<li>
			<span>Студия: </span>
			<span>
			@foreach($show->getStudio as $value)
					@if ($loop->last)
						<a href="{{route('showStudio', $value->url)}}">{{$value->title}}</a>
					@else
						<a href="{{route('showStudio', $value->url)}}">{{$value->title}}</a>,
					@endif
				@endforeach
		</span>
		</li>
	@endif
	<li><span>Сезон: </span> <span>{{$show->seasonAired}}</span></li>
	@if ($show->getCountry)
		<li><span>Страна: </span>
			<span>
			@foreach($show->getCountry as $value)
					@if($loop->last)
						<a href="{{route('showCountry', $value->url)}}">{{$value->title}}</a>
					@else
						<a href="{{route('showCountry', $value->url)}}">{{$value->title}}</a>,
					@endif
				@endforeach
		</span>
		</li>
	@endif
	<li>
		<span>Жанр: </span><span>
			{!! $show->category !!}
		</span>
	</li>
	<li>
		<span>Выпуск: </span>
		<span>
			@if ($show->aired)
				c {{$show->aired}}
			@endif
			@if ($show->released)
				по {{$show->released}}
			@endif
		</span>
	</li>
	@if ($show->getRating)
		<li>
			<span>Рейтинг MPAA: </span>
			<span>
				<a href="{{route('showRating', $show->getRating->url)}}" data-bs-toggle="tooltip" data-bs-placement="top" title="{{$show->getRating->description}}">
					{{$show->getRating->name}}
				</a>
			</span>
		</li>
	@endif
	<li><span>Качество видео: </span>
		<span>
			@foreach($show->getQuality as $value)
				@if ($loop->last)
					<a href="{{route('showQuality', $value->url)}}">{{$value->title}}</a>
				@else
					<a href="{{route('showQuality', $value->url)}}">{{$value->title}}</a>,
				@endif
			@endforeach
		</span>
	</li>
	<li><span>Режиссер: </span><span>[xfvalue_rezhisser]</span></li>
	<li><span>Актеры: </span><span>[xfvalue_actors]</span></li>
	<li><span>Автор оригинала: </span><span>[xfvalue_avtor-originala]</span></li>
	<li><span>Озвучка: </span>
		<span>
			@foreach($show->getTranslate as $value)
				@if ($loop->last)
					<a href="{{route('showTranslate', $value->url)}}">{{$value->title}}</a>
				@else
					<a href="{{route('showTranslate', $value->url)}}">{{$value->title}}</a>,
				@endif
			@endforeach
		</span></li>
	<li><span>На других сайтах: </span>
		<span class="other-title">
			@foreach($show->getOtherLink as $value)
				<a itemprop="url" href="{{$value->url}}" target="_blank" rel="nofollow">{{$value->title}}</a>
			@endforeach
        </span>
	</li>
	@if ($show->japanese)
		<li>
			<span>По-японски: </span>
			<span class="other-name">
			<span itemprop="name">{{$show->japanese}}</span>
    	</span>
		</li>
	@endif
	@if($show->english)
		<li>
			<span>По-английски: </span>
			<span class="other-name">
			<span itemprop="name">{{$show->english}}</span>
    	</span>
		</li>
	@endif
	@if($show->synonyms)
		<li>
			<span>Другие названия: </span>
			<span class="other-name">
				@foreach(explode('|', $show->synonyms) as $value)
					<span>{{$value}}</span><br/>
				@endforeach
    	</span>
		</li>
	@endif
	@if ($show->license_name_ru)
		<li><span>Название лицензии в России: </span><span>{{$show->license_name_ru}}</span></li>
	@endif
</ul>