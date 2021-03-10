<li class="comment">
	<div class="container comments-tree-item" id="{{$comment->id}}">
		<div class="media d-block d-md-flex mt-4">
			<div class="avatar">
				<img src="{{$comment->getAuthorComment->profile_photo_url}}" alt="{{$comment->getAuthorComment->login}}"/>
			</div>
			<div class="media-body text-center text-md-left ml-md-3 ml-0 comments">
				<div class="mt-0 font-weight-bold author h5 clearfix">
					<div class="comments-title">
						<span itemprop="creator" itemscope itemtype="http://schema.org/Comment" id="comment_author"
							  @if ($comment->getAuthorComment->is_online) class="online" @endif>{{$comment->getAuthorComment->login}}</span>
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
					<span>{{$comment->getAuthorComment->comments_count}} {{Lang::choice('комментарий|комментария|комментариев', $comment->getAuthorComment->comments_count, [], 'ru')}}</span>
					<span>{{$comment->getAuthorComment->comments_reply_count}} {{Lang::choice('ответ|ответа|ответов', $comment->getAuthorComment->comments_reply_count, [], 'ru')}}</span>
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
				@if ($comment->getAuthorComment->signature)
					<p class="signature mb-10">
						Подпись: {{$comment->getAuthorComment->signature}}
					</p>
				@endif
				<div class="comment-instrument">
					@if (Auth::user())
						@if (Auth::user()->id <> $comment->getAuthorComment->id)
							<a href="#">Цитировать</a>
							<a href="#">Ответить</a>
							<a href="#">Жалоба</a>
						@endif
						@if ((Auth::user()->id = $comment->getAuthorComment->id)or(in_array(Auth::user()->getGroup->id, [1,2])))
							<a href="#">Редактировать</a>
						@endif
						@if (in_array(Auth::user()->getGroup->id, [1,2]))
							<a href="#">Спамер</a>
							<a href="#">Удалить</a>
						@endif
					@endif
				</div>
			</div>
		</div>
	</div>
	<!-- Рекурсивное подключение шаблона дочерних комментариев. -->
	<ul class="comments_list__children">
		@each('web.frontend.comments.show', $comment->children, 'comment')
	</ul>
</li>