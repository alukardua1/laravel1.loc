@extends('web.frontend.layout.app')

@section('title', $title)

@section('error')
	@error('profile_photo_path')
	<div class="alert alert-danger alert-dismissible fade show" role="alert">
		@foreach($errors->all() as $error)
			{{$error}}
		@endforeach
		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		</button>
	</div>
	@enderror
@endsection

@section('content')
	@foreach($allComments as $comment)
		<div class="container comments-tree-item" id="{{$comment->id}}">
			<div class="media d-block d-md-flex mt-4">
				<div class="avatar">
					<img src="{{$currentUser->profile_photo_url}}" alt="{{$currentUser->login}}"/>
				</div>
				<div class="media-body text-center text-md-left ml-md-3 ml-0 comments">
					<div class="mt-0 font-weight-bold author h5 clearfix">
						<div class="comments-title">
							К аниме {{$comment->getAnime->name}} от
							<span itemprop="creator" itemscope itemtype="http://schema.org/Comment" id="comment_author"
								  @if ($currentUser->is_online) class="online" @endif>{{$currentUser->login}}</span>
							<span>{{$comment->created}}</span>
						</div>
						<div class="rating-comments">
							<a href="#">
								<span></span>
							</a>
							<span id="comments-ratig-layer-{{$comment->id}}" class="ignore-select">
								<span class="ratingtypeplusminus ignore-select ratingzero">{{$comment->rating}}</span>
							</span>
							<a href="#">
								<span></span>
							</a>
						</div>
					</div>
					<div class="user-comments mb-3 mt-3" itemprop="commentCount" itemscope itemtype="http://schema.org/Comment">
						<span>{{$currentUser->comments_count}} {{Lang::choice('комментарий|комментария|комментариев', $currentUser->comments_count, [], 'ru')}}</span>
						<span>{{$currentUser->comments_reply_count}} {{Lang::choice('ответ|ответа|ответов', $currentUser->comments_reply_count, [], 'ru')}}</span>
					</div>
					<div class="comm">
						@if ($comment->getParrentComment)
							<blockquote class="quote-block">
								<div class="title_quote">
									К коментарию <span>{{$comment->getParrentComment->getUser->login}}</span> от {{$comment->getParrentComment->created}}
								</div>
								<div class="quote">
									{!! $comment->getParrentComment->description_html !!}
								</div>
							</blockquote>
						@endif
						{!! $comment->description_html !!}
					</div>
					@if ($currentUser->signature)
						<p class="signature mb-10">
							Подпись: {{$currentUser->signature}}
						</p>
					@endif
					<div class="comment-instrument">
						@if (Auth::user())
							@if (Auth::user()->id <> $comment->getAuthorComment->id)
								<a href="#">Цитировать</a>
								<a href="#">Ответить</a>
								<a href="#">Жалоба</a>
							@endif
							@if ((Auth::user()->id == $comment->getAuthorComment->id)or(in_array(Auth::user()->getGroup->id, [1,2])))
								<a href="#">Редактировать</a>
							@endif
							@if (in_array(Auth::user()->getGroup->id, [1,2]))
								<a href="#">Спамер</a>
								<a href="{{route('softDelComments', [$comment->getAnime->id, $comment->id])}}">Удалить</a>
							@endif
						@endif
					</div>
				</div>
			</div>
		</div>
	@endforeach
@endsection