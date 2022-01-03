<li class="comment">
	<div class="container comments-tree-item" id="{{$comment->id}}">
		<div class="media d-block d-md-flex">
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
					<span>{{$comment->getAuthorComment->comments_count}} @declination($comment->getAuthorComment->comments_count, 'комментарий|комментария|комментариев')</span>
					<span>{{$comment->getAuthorComment->comments_reply_count}} @declination($comment->getAuthorComment->comments_reply_count, 'ответ|ответа|ответов')</span>
				</div>
				<div class="comm">
					{!! $comment->description !!}
				</div>
				@if ($comment->getAuthorComment->signature)
					<p class="signature mb-10">
						{{$comment->getAuthorComment->signature}}
					</p>
				@endif
				@if (Auth::user())
					<div class="comment-instrument fx-row">
						<div>
							@if ((Auth::user()->id == $comment->getAuthorComment->id)or(in_array(Auth::user()->getGroup->id, [1,2])))
								<a id="edit-{{$comment->id}}" href="#">Редактировать</a>
							@endif
						</div>
						<div>
							@if (Auth::user()->id <> $comment->getAuthorComment->id)
<!--								<a id="quote-{{$comment->id}}" href="#">Цитировать</a>-->
								<a id="reply-{{$comment->id}}" onclick="textarea({{$comment->id}}, '{{$comment->getAuthorComment->login}}'); return false; {{$comment->parent = $comment->id}}" href="#">Ответить</a>
								<a id="complaint-{{$comment->getAuthorComment->id}}" href="#" data-toggle="modal" data-target="#complaint">Жалоба</a>
							@endif
						</div>
						<div>
							@if (in_array(Auth::user()->getGroup->id, [1,2]))
								<a id="spam-{{$comment->getAuthorComment->id}}" href="#">Спамер</a>
								<a href="{{route('delComments', [$comment->getAnime->id, $comment->id])}}">Удалить</a>
								<a href="{{route('delComments', [$comment->getAnime->id, $comment->id, true])}}">Удалить полностью</a>
							@endif
						</div>
					</div>
					<div id="edit_quote_reply_comment-{{$comment->id}}" style="display: none">
						<form action="{{route('addCommentAnime', $comment->getAnime->id)}}" method="POST">
							@csrf
							<textarea class="form-control ckeditor" name="description" id="description-{{$comment->id}}" cols="30" rows="10"></textarea>
							<input type="hidden" name="parent_comment_id" value="{{$comment->parent}}">
							<input name="anime_id" type="hidden" value="{{$comment->getAnime->id}}">
							<input name="author_id" type="hidden" value="{{Auth::user()->id}}">
							<input name="user_id" type="hidden" value="{{$comment->getAuthorComment->id}}">
							<button type="submit" class="btn btn-success">Ответить</button>
							<button type="button" class="btn btn-danger" onclick='textarea({{$comment->id}})'>Отменить</button>
						</form>
					</div>
				@endif
			</div>
		</div>
	</div>
	<!-- Рекурсивное подключение шаблона дочерних комментариев. -->
	<ul class="comments_list__children">
		@each('web.frontend.anime.comments.show', $comment->children->sort(), 'comment')
	</ul>
</li>
