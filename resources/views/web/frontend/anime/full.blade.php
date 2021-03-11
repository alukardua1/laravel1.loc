@extends('web.frontend.layout.app')

@section('title', $showAnime->metatitle)
@section('description', $showAnime->metatitle)

@section('error')
	@if ($errors->any())
		<div class="alert alert-danger alert-dismissible fade show" role="alert">
			@foreach($errors->all() as $error)
				{{$error}}
			@endforeach
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
		</div>
	@endif
@endsection

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
				<i class="fas fa-file-alt"></i> {!! $showAnime->description_html !!}
			</div>
			@include('web.frontend.anime.component.fullstory-info')
		</div>
		<div class="">
			<h5>Смотреть онлайн</h5>
		</div>
		<div class="player">
			<ul class="nav nav-tabs" id="myTab" role="tablist">
				@if($showAnime->getTrailer->isNotEmpty())
					<li class="nav-item" role="presentation">
						<a class="nav-link active" id="trailer-tab" data-toggle="tab" href="#trailer" role="tab" aria-controls="trailer"
						   aria-selected="true">Трейлер</a>
					</li>
				@endif
				@if ($showAnime->getPlayer->isNotEmpty())
					<li class="nav-item" role="presentation">
						<a class="nav-link @if($showAnime->getTrailer->isEmpty()) active @endif" id="player-tab" data-toggle="tab" href="#player"
						   role="tab"
						   aria-controls="player" aria-selected="false">Плеер</a>
					</li>
				@endif
			</ul>
			<div class="tab-content" id="myTabContent">
				@if($showAnime->getTrailer->isNotEmpty())
					<div class="tab-pane fade show active" id="trailer" role="tabpanel" aria-labelledby="trailer-tab">
						<ul class="nav nav-tabs" id="myTab" role="tablist">
							<?php $i = 1 ?>
							@foreach($showAnime->getTrailer as $trailer)
								<li class="nav-item" role="presentation">
									<a class="nav-link active" id="trailer-tab" data-toggle="tab" href="#trailer" role="tab" aria-controls="trailer"
									   aria-selected="true">Трейлер {{ $i++ }}</a>
								</li>
								<div class="embed-responsive embed-responsive-16by9">
									<iframe class="embed-responsive-item" src="{{$trailer->trailer}}" allowfullscreen></iframe>
								</div>
							@endforeach
						</ul>
						@if(Auth::user())
							<div>
								{brokenLink}
							</div>
						@endif
					</div>
				@endif
				@if($showAnime->getPlayer->isNotEmpty())
					<div class="tab-pane fade @if($showAnime->getTrailer->isEmpty())show active @endif" id="player" role="tabpanel"
						 aria-labelledby="player-tab">
						<ul class="nav nav-tabs" id="myTab" role="tablist">
							@foreach($showAnime->getPlayer as $player)
								<li class="nav-item" role="presentation">
									<a class="nav-link active" id="trailer-tab" data-toggle="tab" href="#trailer" role="tab" aria-controls="trailer"
									   aria-selected="true">{{$player->name_player}}</a>
								</li>
								<div class="embed-responsive embed-responsive-16by9">
									<iframe class="embed-responsive-item" src="{{$player->url_player}}" frameborder="0" allowfullscreen
											allow="autoplay *; fullscreen *"></iframe>
								</div>
							@endforeach
						</ul>
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
		@if (Auth::user())
			@if ($showAnime->comment_at)
				<form action="{{route('addCommentAnime', $showAnime->id)}}" method="POST">
					@csrf
					<div id="comments" class="add-comment form-textarea mb-3">
						<label for="addComment">Добавить комментарий</label>
						<textarea class="form-control ckeditor" name="description_html" id="addComment" cols="30" rows="10"></textarea>
						<input name="anime_id" type="hidden" value="{{$showAnime->id}}">
						<input name="author_id" type="hidden" value="{{Auth::user()->id}}">
					</div>
					<div class="btn-group" role="group" aria-label="Basic example">
						<button type="submit" class="btn btn-success">Оставить комментарий</button>
						<button type="button" class="btn btn-danger" onclick='document.querySelector("textarea[name=description_html]").value=""'>Отменить</button>
					</div>
				</form>
			@else
				<div class="alert alert-danger" role="alert">
					Комментирование отключено
				</div>
			@endif
		@else
			<div class="alert alert-danger" role="alert">
				Для комментирования <a href="/login">войдите</a> или <a href="/register">зарегистрируйтесь</a> на сайте
			</div>
		@endif
		@if ($comments)
			<div class="">
				<h5>Комментарии</h5>
			</div>
			<div class="comment">
				@include('web.frontend.anime.comments.area', $comments)
			</div>
		@endif
	</article>
@endsection
<script>
	import Label from "@/Jetstream/Label";

	export default {
		components: {Label}
	}
</script>