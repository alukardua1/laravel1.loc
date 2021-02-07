<ul class="tech-info">
	<li><span>Тип: </span> <span>[xfvalue_tip] ([xfvalue_serias-col] эп.) [xfvalue_dlitelnost] мин.</span></li>
	[xfgiven_translyaciya]
	<li><span>Трансляция: </span> <span>[xfvalue_translyaciya] на [xfvalue_kanal]</span></li>
	[/xfgiven_translyaciya]
	[xfgiven_studiya]
	<li><span>Студия: </span> <span>[xfvalue_studiya]</span></li>
	[/xfgiven_studiya]
	[xfgiven_sezon]
	<li><span>Сезон: </span> <span>{include file="engine/modules/sezons.php?year=[xfvalue_data-vypuska]"}</span></li>
	[/xfgiven_sezon]
	[xfgiven_proizvodstvo]
	<li><span>Страна: </span><span>[xfvalue_proizvodstvo]</span></li>
	[/xfgiven_proizvodstvo]
	<li><span>Жанр: </span><span>
			{!! $showAnime->category !!}
		</span></li>
	<li><span>Выпуск: </span><span>[xfgiven_data-okonchaniya]с[/xfgiven_data-okonchaniya] [xfvalue_data-vypuska][xfgiven_data-okonchaniya] по [xfvalue_data-okonchaniya][/xfgiven_data-okonchaniya]</span>
	</li>
	[xfgiven_rating]
	<li><span>Рейтинг MPAA: </span><span>[xfvalue_rating]</span></li>
	[/xfgiven_rating]
	[xfgiven_quality]
	<li><span>Качество видео: </span><span>[xfvalue_quality]</span></li>
	[/xfgiven_quality]
	[xfgiven_rezhisser]
	<li><span>Режиссер: </span><span>[xfvalue_rezhisser]</span></li>
	[/xfgiven_rezhisser]
	[xfgiven_actors]
	<li><span>Актеры: </span><span>[xfvalue_actors]</span></li>
	[/xfgiven_actors]
	[xfgiven_avtor-originala]
	<li><span>Автор оригинала: </span><span>[xfvalue_avtor-originala]</span></li>
	[/xfgiven_avtor-originala]
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
        [xfgiven_nazvanie-romadzi]<span itemprop="name">[xfvalue_nazvanie-romadzi]</span>[/xfgiven_nazvanie-romadzi]
        [xfgiven_po-yaponski]<span itemprop="name">[xfvalue_po-yaponski]</span>[/xfgiven_po-yaponski]
        [xfgiven_po-angliyski]<span itemprop="name">[xfvalue_po-angliyski]</span>[/xfgiven_po-angliyski]
    </span>
	</li>
	[xfgiven_lic_ru_title]
	<li><span>Название лицензии в России: </span><span>[xfvalue_lic_ru_title]</span></li>
	[/xfgiven_lic_ru_title]
</ul>