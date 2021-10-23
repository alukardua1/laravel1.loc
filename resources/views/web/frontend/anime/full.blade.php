@extends('web.frontend.layout.app')

@section('title', $show->metatitle)
@section('description', $show->metatitle)
@section('keywords', $show->keywords)

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
			<h1>{{$show->russian}}</h1>
			@if (Auth::check())
				<favorite
						:post={{ $show->id }} :favorited={{ $show->favorited() ? 'true' : 'false' }}>
				</favorite>
			@endif
			@if(Auth::user())
				@if (Auth::user()->getGroup->is_dashboard)
					<a target="_blank" href="{{route('editAnimeAdmin', $show->id)}}" type="button" class="btn btn-danger editing"><i class="far fa-edit"></i></a>
				@endif
			@endif
		</div>
		<div class="inform">
			<div class="poster">
				<div class="view">
					<img itemprop="image" src="{{asset('storage/'.$show->preview_img)}}"
						 data-src="{{asset('storage/'.$show->original_img)}}" class="card-img lazy" alt="{title}">
					@if (Auth::check())
						<div class="rating-full">
							<div class="col-md-12">
								<votes :post={{ $show->id }} :votes={{ $show->votes() ? 'true' : 'false' }} :count_plus={{$plus}} :count_minus={{$minus}}></votes>
							</div>
						</div>
					@endif
				</div>
				<div class="cos-but mt-3">
					<div class="ya-share2 bottom" data-services="collections,vkontakte,facebook,odnoklassniki,moimir,twitter,whatsapp,skype,telegram"
						 data-counter="ig"></div>
				</div>
			</div>
			<div class="full-description">
				<i class="fas fa-file-alt"></i> {!! $show->description !!}
			</div>
			@include('web.frontend.anime.component.fullstory-info')
		</div>
		<div class="listing mt-3 mb-3">
			<label>Смотреть онлайн</label>
		</div>
		<div class="player">
			<ul class="nav nav-tabs" id="myTab" role="tablist">
				@if($show->getTrailer->isNotEmpty())
					<li class="nav-item" role="presentation">
						<a class="nav-link active" id="trailer-tab" data-toggle="tab" href="#trailer" role="tab" aria-controls="trailer"
						   aria-selected="true">Трейлер</a>
					</li>
				@endif
				@if ($show->getPlayer->isNotEmpty())
					<li class="nav-item" role="presentation">
						<a class="nav-link @if($show->getTrailer->isEmpty()) active @endif" id="player-tab" data-toggle="tab" href="#player"
						   role="tab"
						   aria-controls="player" aria-selected="false">Плеер</a>
					</li>
				@endif
			</ul>
			<div class="tab-content" id="myTabContent">
				@if($show->getTrailer->isNotEmpty())
					<div class="tab-pane fade show active" id="trailer" role="tabpanel" aria-labelledby="trailer-tab">
						<ul class="nav nav-tabs" id="myTab" role="tablist">
							<?php $i = 1 ?>
							@foreach($show->getTrailer as $trailer)
								<li class="nav-item" role="presentation">
									<a class="nav-link active" id="trailer-tab" data-toggle="tab" href="#trailer" role="tab" aria-controls="trailer"
									   aria-selected="true">Трейлер {{ $i++ }}</a>
								</li>
								<div class="embed-responsive embed-responsive-16by9">
									<iframe class="embed-responsive-item" src="{{$trailer->url_trailer}}" allowfullscreen></iframe>
								</div>
							@endforeach
						</ul>
					</div>
				@endif
				@if($show->getPlayer->isNotEmpty())
					<div class="tab-pane fade @if($show->getTrailer->isEmpty())show active @endif" id="player" role="tabpanel"
						 aria-labelledby="player-tab">
						<ul class="nav nav-tabs" id="myTab" role="tablist">
							@foreach($show->getPlayer as $player)
								<li class="nav-item" role="presentation">
									<a class="nav-link active" id="trailer-tab" data-toggle="tab" href="#trailer" role="tab" aria-controls="trailer"
									   aria-selected="true">{{$player->name_player}}</a>
								</li>
								<div class="embed-responsive embed-responsive-16by9">
									<iframe class="embed-responsive-item"
											src="{{$player->url_player}}@if ($regionBlockString and (strcasecmp($player->name_player, 'kodik') == 0))?geoblock={{$regionBlockString}}@endif"
											frameborder="0" allowfullscreen allow="autoplay *; fullscreen *"></iframe>
								</div>
							@endforeach
						</ul>
					</div>
				@endif
			</div>
		</div>
		<div class="listing mt-3 mb-3">
			<label>Смотрите так же</label>
		</div>
		<div class="related">
			@each('web.frontend.anime.component.related', $related, 'relates')
		</div>
		<div class="listing mt-3 mb-3">
			<label>Связанное</label>
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
		@if (Auth::user())
			@if ($show->comment_at)
				<form action="{{route('addCommentAnime', $show->id)}}" method="POST">
					@csrf
					<div id="comments" class="add-comment form-textarea mb-3">
						<label for="addComment">Добавить комментарий</label>
						<textarea class="form-control ckeditor" name="description_html" id="addComment" cols="30" rows="10"></textarea>
						<input name="anime_id" type="hidden" value="{{$show->id}}">
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
		@if ($comments && $show->comment_at)
			<div class="listing mt-3 mb-3">
				<label>{{$show->comments_count}} @declination($show->comments_count, 'комментарий|комментария|комментариев')</label>
			</div>
			<div class="comment">
				@include('web.frontend.anime.comments.area', $comments)
			</div>
		@endif
	</article>
	@include('web.frontend.anime.component.complaint')
@endsection