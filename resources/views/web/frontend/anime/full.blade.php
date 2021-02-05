@extends('web.frontend.layout.app')

@section('title', $showAnime->name)

@section('content')
	<article class="fullstory">
		<div class="full-title">
			<h1>{{$showAnime->name}}</h1>
			<div class="favor">
				<span class="favor-add">[add-favorites][/add-favorites]</span>
				<span class="favor-del">[del-favorites][/del-favorites]</span>
			</div>
			<div id="edit">
				[edit]<i class="far fa-edit"></i>[/edit]
			</div>
		</div>
		<div class="inform">
			<div class="poster">
				<div class="view">
					<img itemprop="image" src="{{asset('storage/'.$showAnime->preview_img)}}" data-src="{{asset('storage/'.$showAnime->original_img)}}" class="card-img lazy" alt="{title}">
					<div class="rating-full">
						[rating-plus]
						<span>{likes}</span>
						[/rating-plus]
						[rating-minus]
						<span>{dislikes}</span>
						[/rating-minus]
					</div>
				</div>
				<div class="cos-but mt-3">
					<script src="https://yastatic.net/es5-shims/0.0.2/es5-shims.min.js"></script>
					<script src="https://yastatic.net/share2/share.js"></script>
					<div class="ya-share2 bottom" data-services="collections,vkontakte,facebook,odnoklassniki,moimir,twitter,whatsapp,skype,telegram" data-counter="ig"></div>
				</div>
			</div>
			<div class="full-description">
				<i class="fas fa-file-alt"></i> {{$showAnime->description}}
			</div>
			@include('web.frontend.anime.component.fullstory-info')
		</div>
		<div class="">
			<h5>Смотреть онлайн</h5>
		</div>
		<div class="player">
			<ul class="nav nav-tabs" id="myTab" role="tablist">
				@if($showAnime->trailer)
				<li class="nav-item" role="presentation">
					<a class="nav-link active" id="trailer-tab" data-toggle="tab" href="#trailer" role="tab" aria-controls="trailer" aria-selected="true">Трейлер</a>
				</li>
				@endif
				[xfgiven_kodik]
				[blockplayer]
				<li class="nav-item" role="presentation">
					<a class="nav-link @if(!$showAnime->trailer) active @endif" id="player-tab" data-toggle="tab" href="#player" role="tab" aria-controls="player" aria-selected="false">Плеер</a>
				</li>
				[/blockplayer]
				[/xfgiven_kodik]
			</ul>
			<div class="tab-content" id="myTabContent">
				@if($showAnime->trailer)
				<div class="tab-pane fade show active" id="trailer" role="tabpanel" aria-labelledby="trailer-tab">
					<div class="embed-responsive embed-responsive-16by9">
						<iframe class="embed-responsive-item" src="{{$showAnime->trailer}}" allowfullscreen></iframe>
					</div>
					@if(Auth::user())
					<div>
						{brokenLink}
					</div>
					@endif
				</div>
				@endif
				[xfgiven_kodik]
				[blockplayer]
				<div class="tab-pane fade [xfnotgiven_treyler]show active[/xfnotgiven_treyler]" id="player" role="tabpanel" aria-labelledby="player-tab">
					[catlist=20-21,23-25]
					[group=5]
					<div class="alert alert-danger" role="alert">
						<h4 class="alert-heading">Внимание! Обнаружена ошибка</h4>
						<p>Для просмотра видео войдите под своим логином или зарегистрируйтесь.</p>
					</div>
					[/group]
					[/catlist]
					[not-catlist=20-21,23-25]
					[group=5]
					<div class="embed-responsive embed-responsive-16by9">
						{blockplayer}
					</div>
					[/group]
					[/not-catlist]
					[catlist=20-25]
					[not-group=5]
					<div class="embed-responsive embed-responsive-16by9">
						{blockplayer}
					</div>
					[/not-group]
					[/catlist]
					[not-catlist=20-25]
					[not-group=5]
					<div class="embed-responsive embed-responsive-16by9">
						{blockplayer}
					</div>
					[/not-group]
					[/not-catlist]
				</div>
				[/blockplayer]
				[/xfgiven_kodik]
			</div>
		</div>
		<div class="">
			<h5>Смотрите так же</h5>
		</div>
		<div class="related">
			{related-news}
		</div>
		<div class="">
			<h5>Связанное</h5>
		</div>
		<div class="franch">
			<ul class="nav nav-tabs" id="myTab" role="tablist">
				<li class="nav-item" role="presentation">
					<a class="nav-link active" id="home-tab" data-toggle="tab" href="#franchise" role="tab" aria-controls="franchise" aria-selected="true">Франшиза</a>
				</li>
				<li class="nav-item" role="presentation">
					<a class="nav-link" id="profile-tab" data-toggle="tab" href="#chronology" role="tab" aria-controls="chronology" aria-selected="false">Хронология</a>
				</li>
			</ul>
			<div class="tab-content" id="myTabContent">
				<div class="tab-pane fade show active" id="franchise" role="tabpanel" aria-labelledby="franchise-tab">
					{franchise}
				</div>
				<div class="tab-pane fade" id="chronology" role="tabpanel" aria-labelledby="chronology-tab">
					{chronology}
				</div>
			</div>
		</div>
		<div class="">
			<h5>Добавить комментарий</h5>
		</div>
		<div class="add-comment">
			{addcomments}
		</div>
		[comments]
		<div class="">
			<h5>Комментарии</h5>
		</div>
		<div class="comment">
			{comments}
		</div>
		[/comments]
	</article>
@endsection