@extends('web.frontend.layout.app')

@section('title', $showAnime->metatitle)

@section('content')
	<article class="fullstory">
		<div class="full-title">
			<h1>{{$showAnime->name}}</h1>
			@if (Auth::check())
				<favorite
						:post={{ $showAnime->id }} :favorited={{ $showAnime->favorited() ? 'true' : 'false' }}>
				</favorite>
			@endif
			<div id="edit">
				<i class="far fa-edit"></i>
			</div>
		</div>
		<div class="inform">
			<div class="poster">
				<div class="view">
					<img itemprop="image" src="{{asset('storage/'.$showAnime->preview_img)}}"
						 data-src="{{asset('storage/'.$showAnime->original_img)}}" class="card-img lazy" alt="{title}">
					@if (Auth::check())
						<div class="rating-full">
							<div class="col-md-12">
								<votes :post={{ $showAnime->id }} :votes={{ $showAnime->votes() ? 'true' : 'false' }} :count_plus={{$plus}} :count_minus={{$minus}}></votes>
							</div>
						</div>
					@endif
				</div>
				<div class="cos-but mt-3">
					<script src="https://yastatic.net/es5-shims/0.0.2/es5-shims.min.js"></script>
					<script src="https://yastatic.net/share2/share.js"></script>
					<div class="ya-share2 bottom" data-services="collections,vkontakte,facebook,odnoklassniki,moimir,twitter,whatsapp,skype,telegram"
						 data-counter="ig"></div>
				</div>
			</div>
			<div class="full-description">
				<i class="fas fa-file-alt"></i> {!! $showAnime->description !!}
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
						<a class="nav-link active" id="trailer-tab" data-toggle="tab" href="#trailer" role="tab" aria-controls="trailer"
						   aria-selected="true">Трейлер</a>
					</li>
				@endif
				@if ($showAnime->player)
					<li class="nav-item" role="presentation">
						<a class="nav-link @if(!$showAnime->trailer) active @endif" id="player-tab" data-toggle="tab" href="#player" role="tab"
						   aria-controls="player" aria-selected="false">Плеер</a>
					</li>
				@endif
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
				@if($showAnime->player)
					<div class="tab-pane fade @if(!$showAnime->trailer)show active @endif" id="player" role="tabpanel"
						 aria-labelledby="player-tab">
						<div class="embed-responsive embed-responsive-16by9">
							<iframe class="embed-responsive-item" src="{{$showAnime->player}}" frameborder="0" allowfullscreen
									allow="autoplay *; fullscreen *"></iframe>
						</div>
					</div>
				@endif
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
					<a class="nav-link active" id="home-tab" data-toggle="tab" href="#franchise" role="tab" aria-controls="franchise"
					   aria-selected="true">Франшиза</a>
				</li>
				<li class="nav-item" role="presentation">
					<a class="nav-link" id="profile-tab" data-toggle="tab" href="#chronology" role="tab" aria-controls="chronology"
					   aria-selected="false">Хронология</a>
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